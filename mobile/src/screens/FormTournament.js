import React, {useState, useEffect, useCallback} from 'react';
import {TouchableOpacity, ScrollView, StyleSheet, Alert} from 'react-native';
import {View, Text, Button, Picker, Incubator} from 'react-native-ui-lib';
import tailwind from 'twrnc';
import Ionicons from 'react-native-vector-icons/Ionicons';
import {useSelector, useDispatch} from 'react-redux';
import {getItemsClub} from '../store/slice/masterSlice';
import LoadingOverlay from '../components/LoadingOverlay';
import {reqItemsClub, reqSimpanTournament} from '../utils/tournament';
import {SET_ITEMS_CLUB} from '../store/slice/masterSlice';
import {
  SET_VALUE_FORM_TOURNAMENT,
  getForm,
  SET_TRANSACTION,
} from '../store/slice/tournamentSlice';
import {useIsFocused} from '@react-navigation/native';

const {TextField} = Incubator;

export default function ({navigation, route}) {
  const [itemsInputanNama, setItemsInputanNama] = useState([]);
  const [modelTextNama, setModelTextNama] = useState(null);
  const itemsClub = useSelector(getItemsClub);
  const [isLoading, setIsLoading] = useState(false);
  const isFocussed = useIsFocused();
  const dispatch = useDispatch();
  const form = useSelector(getForm);

  const simpanTournamentHandler = async type => {
    setIsLoading(true);
    const {status, data} = await reqSimpanTournament(form);
    if (status) {
      if (type === 'waiting_list') {
        navigation.navigate('daftar-tournament');
      } else {
        dispatch(
          SET_TRANSACTION({
            transaction_details: data.transaction_details,
            item_details: data.item_details,
          }),
        );
        navigation.navigate('bayar-tournament');
      }
    }
    setIsLoading(false);
  };
  const addPersonHandler = () => {
    if (modelTextNama) {
      if (itemsInputanNama.length < 5) {
        setItemsInputanNama(prevState => {
          const items = prevState.concat(modelTextNama);
          if (items.length === 1) {
            dispatch(
              SET_VALUE_FORM_TOURNAMENT({
                value: modelTextNama,
                key: 'name',
              }),
            );
          } else if (items.length > 1) {
            dispatch(
              SET_VALUE_FORM_TOURNAMENT({
                value: JSON.stringify(items),
                key: 'name',
              }),
            );
          }
          return items;
        });
        setModelTextNama(null);
      } else {
        Alert.alert(
          'Gagal',
          'Jumlah nama yang didaftarkan tidak boleh lebih dari 5',
          ['Oke'],
        );
      }
    } else {
      Alert.alert('Gagal', 'Nama masih kosong', ['Oke']);
    }
  };
  const deleteItemHandler = nama => {
    Alert.alert('Konfirmasi', `Apakah anda yakin ingin menghapus ${nama}?`, [
      {text: 'Batal', style: 'cancel'},
      {
        text: 'Yakin',
        style: 'destructive',
        onPress: () => {
          setItemsInputanNama(prevState => {
            const items = prevState.filter(item => item !== nama);
            if (items.length === 1) {
              dispatch(
                SET_VALUE_FORM_TOURNAMENT({
                  value: items[0],
                  key: 'name',
                }),
              );
            } else if (items.length > 1) {
              dispatch(
                SET_VALUE_FORM_TOURNAMENT({
                  value: JSON.stringify(items),
                  key: 'name',
                }),
              );
            } else {
              dispatch(
                SET_VALUE_FORM_TOURNAMENT({
                  value: null,
                  key: 'name',
                }),
              );
            }
            return items;
          });
        },
      },
    ]);
  };
  const prosesDaftarHandler = () => {
    if (form.hp && form.club_id && itemsInputanNama.length) {
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
  const {tournament_id, nama_tournament} = route.params;

  useEffect(() => {
    if (isFocussed) {
      dispatch(
        SET_VALUE_FORM_TOURNAMENT({value: tournament_id, key: 'tournament_id'}),
      );
      loadItemsClub();
      setItemsInputanNama([]);
    }
  }, [isFocussed, loadItemsClub, tournament_id, dispatch]);

  return (
    <View flex style={tailwind`p-4`}>
      {isLoading && <LoadingOverlay />}
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
        style={[
          {backgroundColor: '#F8F8F8', borderRadius: 8, flex: 1},
          tailwind`px-4 py-8 mt-4`,
        ]}>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Club
          </Text>
          {!isLoading && (
            <Picker
              showSearch
              placeholder={'Pilih Club'}
              style={styles.underlineField}
              migrateTextField
              topBarProps={{title: 'Daftar Club'}}
              onChange={item =>
                dispatch(
                  SET_VALUE_FORM_TOURNAMENT({
                    value: item.value,
                    key: 'club_id',
                  }),
                )
              }
              value={form.club_id}>
              {itemsClub.map(item => (
                <Picker.Item
                  key={item.id}
                  value={item.id}
                  label={item.name}
                  disabled={item.disabled}
                />
              ))}
            </Picker>
          )}
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Nama
          </Text>
          <View row centerV style={tailwind`mb-2`}>
            <View flexG>
              <TextField
                value={modelTextNama}
                onChangeText={value => setModelTextNama(value)}
                placeholder="Input Nama"
                style={styles.underlineField}
              />
            </View>
            <TouchableOpacity style={tailwind`ml-2`} onPress={addPersonHandler}>
              <Ionicons name="add-circle" size={32} color={'#293241'} />
            </TouchableOpacity>
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
                <Text style={{fontFamily: 'SFNSDisplay-Bold'}}>{item}</Text>
                <TouchableOpacity
                  style={tailwind`ml-2`}
                  onPress={() => deleteItemHandler(item)}>
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
            Nomor Telepon
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
