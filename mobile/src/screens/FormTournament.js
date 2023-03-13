import React, {useState, useEffect, useCallback} from 'react';
import {
  TouchableOpacity,
  ScrollView,
  StyleSheet,
  Alert,
  Pressable,
  Modal,
} from 'react-native';
import {View, Text, Button, Picker, Incubator} from 'react-native-ui-lib';
import tailwind from 'twrnc';
import Ionicons from 'react-native-vector-icons/Ionicons';
import {useSelector, useDispatch} from 'react-redux';
import LoadingOverlay from '../components/LoadingOverlay';
import {reqItemsClub, reqSimpanTournament} from '../utils/tournament';
import {SET_ITEMS_CLUB} from '../store/slice/masterSlice';
import {
  SET_VALUE_FORM_TOURNAMENT,
  getForm,
  SET_TRANSACTION,
  SET_FORM_TOURNAMENT,
} from '../store/slice/tournamentSlice';
import {useIsFocused} from '@react-navigation/native';

const {TextField} = Incubator;

export default function ({navigation, route}) {
  const [itemsInputanNama, setItemsInputanNama] = useState([]);
  const [modelTextNama, setModelTextNama] = useState(null);
  const [isLoading, setIsLoading] = useState(false);
  const isFocussed = useIsFocused();
  const dispatch = useDispatch();
  const form = useSelector(getForm);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [modelDivisi, setModelDivisi] = useState(null);

  const simpanTournamentHandler = async type => {
    setIsLoading(true);
    const payloadForm = {
      ...form,
      name: JSON.stringify(itemsInputanNama.map(res => res.nama)),
      division: JSON.stringify(itemsInputanNama.map(res => res.divisi)),
    };
    const {status, data} = await reqSimpanTournament(payloadForm);
    if (status) {
      if (type === 'waiting_list') {
        navigation.navigate('daftar-tournament');
      } else {
        dispatch(
          SET_TRANSACTION({
            transaction_details: data?.transaction_details || null,
            item_details: data?.item_details || null,
            order_id: data.id,
            price: data.gross_amount,
            email: form.email,
          }),
        );
        navigation.navigate('upload-bukti-transfer');
      }
    }
    setIsLoading(false);
  };
  const addAnggotaHandler = () => {
    if (modelTextNama && modelDivisi) {
      const max = quota > 5 ? 5 : quota
      if (itemsInputanNama.length < max) {
        setItemsInputanNama(prevState =>
          prevState.concat({nama: modelTextNama, divisi: modelDivisi}),
        );
        closeModalAnggotaHandler();
      } else {
        Alert.alert(
          'Gagal',
          'Jumlah nama yang didaftarkan tidak boleh lebih dari ' + max,
          ['Oke'],
        );
      }
    } else {
      Alert.alert('Gagal', 'Mohon check kembali form anda', ['Oke']);
    }
  };
  const deleteItemHandler = (nama, idx) => {
    Alert.alert('Konfirmasi', `Apakah anda yakin ingin menghapus ${nama}?`, [
      {text: 'Batal', style: 'cancel'},
      {
        text: 'Yakin',
        style: 'destructive',
        onPress: () => {
          setItemsInputanNama(prevState =>
            prevState.filter((item, index) => index !== idx),
          );
        },
      },
    ]);
  };
  const prosesDaftarHandler = () => {
    if (form.hp && form.club && itemsInputanNama.length) {
      Alert.alert('Perhatian', 'Mohon pilih jenis pendaftaran', [
        'Batal',
        {
          text: 'Waiting List',
          style: 'destructive',
          onPress: () => simpanTournamentHandler('waiting_list'),
        },
        {
          text: 'Daftar',
          style: 'default',
          onPress: () => simpanTournamentHandler('daftar'),
        },
      ]);
    } else {
      Alert.alert('Gagal', 'Mohon cek kembali form anda', ['Oke']);
    }
  };
  const loadItemsClub = useCallback(async () => {
    setIsLoading(true);
    const {status, data} = await reqItemsClub();
    if (status) {
      dispatch(SET_ITEMS_CLUB(data));
    }
    setIsLoading(false);
  }, [dispatch]);
  const {tournament_id, nama_tournament, division, description, quota} = route.params;

  useEffect(() => {
    loadItemsClub();

    if (isFocussed) {
      dispatch(SET_FORM_TOURNAMENT(null));
      dispatch(SET_TRANSACTION(null));
      setItemsInputanNama([]);
      dispatch(
        SET_VALUE_FORM_TOURNAMENT({value: tournament_id, key: 'tournament_id'}),
      );
    }
  }, [isFocussed, loadItemsClub, tournament_id, dispatch]);

  const openModalHandler = () => {
    setIsModalOpen(true);
  };
  const closeModalAnggotaHandler = () => {
    setIsModalOpen(false);
    setModelTextNama(null);
    setModelDivisi(null);
  };

  return (
    <View flex style={tailwind`p-4`}>
      {isLoading && <LoadingOverlay />}
      <Modal visible={isModalOpen} animationType="slide">
        <View flex style={tailwind`p-4`}>
          <View style={tailwind`mb-6`}>
            <Text
              style={[
                {fontFamily: 'SFNSDisplay-Black'},
                tailwind`text-3xl mt-4`,
              ]}>
              Form Peserta
            </Text>
          </View>
          <View style={tailwind`mb-4`}>
            <Text
              style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
              Nama <Text style={{color: 'red'}}>*</Text>
            </Text>
            <TextField
              value={modelTextNama}
              onChangeText={value => setModelTextNama(value)}
              placeholder="Input Nama"
              style={styles.underlineField}
            />
          </View>
          <View style={tailwind`mb-2`}>
            <Text
              style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
              Divisi <Text style={{color: 'red'}}>*</Text>
            </Text>
            {!isLoading && (
              <Picker
                showSearch
                placeholder={'Pilih Divisi'}
                style={styles.underlineField}
                migrateTextField
                topBarProps={{title: 'Divisi'}}
                onChange={item => setModelDivisi(item.value)}
                value={modelDivisi}>
                {division.map(item => (
                  <Picker.Item key={item} value={item} label={item} />
                ))}
              </Picker>
            )}
          </View>
        </View>

        <View center row style={tailwind`py-2`}>
          <Button
            label="Batal"
            onPress={closeModalAnggotaHandler}
            style={tailwind`mt-4 mx-2`}
            size={Button.sizes.large}
            backgroundColor="#EAEAEA"
            color="#acacac"
            borderRadius={8}
          />
          <Button
            label="Simpan"
            style={tailwind`mt-4 mx-2`}
            size={Button.sizes.large}
            backgroundColor="#293241"
            borderRadius={8}
            onPress={addAnggotaHandler}
          />
        </View>
      </Modal>
      <TouchableOpacity onPress={() => navigation.goBack()}>
        <Ionicons
          name="ios-arrow-back-circle-sharp"
          size={40}
          color="#293241"
        />
      </TouchableOpacity>
      <View>
        <Text
          style={[{fontFamily: 'SFNSDisplay-Black'}, tailwind`text-3xl mt-4`]}>
          {nama_tournament}
        </Text>
      </View>
      <ScrollView
        showsVerticalScrollIndicator={false}
        style={[
          {backgroundColor: '#F8F8F8', borderRadius: 8, flex: 1},
          tailwind`px-4 py-8 mt-4`,
        ]}>
        <View
          style={[
            {backgroundColor: '#98f5e1', borderRadius: 8},
            tailwind`p-4 mb-6`,
          ]}>
          <Text>{description}</Text>
        </View>
        <View style={tailwind`mb-4`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Club/PTM <Text style={{color: 'red'}}>*</Text>
          </Text>
          <TextField
            value={form.club}
            onChangeText={value =>
              dispatch(SET_VALUE_FORM_TOURNAMENT({value, key: 'club'}))
            }
            placeholder="Input Club"
            style={styles.underlineField}
          />
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Peserta (Max {quota > 5 ? '5' : quota}) <Text style={{color: 'red'}}>*</Text>
          </Text>
          <View row centerV style={tailwind`mb-2`}>
            <Pressable style={{flex: 1}} onPress={openModalHandler}>
              <View flexG pointerEvents="none">
                <TextField
                  value={modelTextNama}
                  editable={false}
                  on
                  placeholder="Input Peserta"
                  style={styles.underlineField}
                />
              </View>
            </Pressable>
          </View>
          {itemsInputanNama.map((item, idx) => (
            <View row key={idx}>
              <View
                style={[
                  {borderWidth: 1, borderRadius: 20, borderColor: '293241'},
                  tailwind`px-2 mb-2`,
                ]}
                row
                centerV>
                <Text style={{fontFamily: 'SFNSDisplay-Bold'}}>
                  {item.nama} | Divisi: {item.divisi}
                </Text>
                <TouchableOpacity
                  style={tailwind`ml-2`}
                  onPress={() => deleteItemHandler(item.nama, idx)}>
                  <Ionicons name="close-circle-sharp" color={'red'} size={24} />
                </TouchableOpacity>
              </View>
            </View>
          ))}
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Email
          </Text>
          <TextField
            value={form.email}
            onChangeText={value =>
              dispatch(SET_VALUE_FORM_TOURNAMENT({value, key: 'email'}))
            }
            placeholder="Input Email"
            style={[styles.underlineField, tailwind`mb-2`]}
          />
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Nomor Telepon <Text style={{color: 'red'}}>*</Text>
          </Text>
          <TextField
            value={form.hp}
            keyboardType="number-pad"
            onChangeText={value =>
              dispatch(SET_VALUE_FORM_TOURNAMENT({value, key: 'hp'}))
            }
            placeholder="Input Nomor Telepon"
            style={styles.underlineField}
          />
        </View>
        <View style={{height: 50}}></View>
      </ScrollView>
      <Button
        label="Daftar"
        onPress={prosesDaftarHandler}
        style={tailwind`mt-4`}
        size={Button.sizes.large}
        backgroundColor="#293241"
        borderRadius={8}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  underlineField: {borderBottomWidth: 1, borderBottomColor: '#293241'},
});
