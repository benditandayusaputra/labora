import React, {useState, useEffect} from 'react';
import {View, Text, Button} from 'react-native-ui-lib';
import {
  TouchableOpacity,
  ScrollView,
  StyleSheet,
  Image,
  Alert,
} from 'react-native';
import LoadingOverlay from '../components/LoadingOverlay';
import Ionicons from 'react-native-vector-icons/Ionicons';
import tailwind from 'twrnc';
import GlobalStyles from '../constants/GlobalStyles';
import DocumentPicker, {types} from 'react-native-document-picker';
import {useDispatch, useSelector} from 'react-redux';
import {getItemsRekening, SET_ITEMS_REKENING} from '../store/slice/masterSlice';
import {reqItemsRekening} from '../utils/payment';
import {useIsFocused} from '@react-navigation/native';
import {
  getTransaction,
  SET_FORM_TOURNAMENT,
  SET_TRANSACTION,
} from '../store/slice/tournamentSlice';
import {serialize} from 'object-to-formdata';
import {reqSimpanUploadBuktiBayar} from '../utils/tournament';
import {showMessage} from 'react-native-flash-message';

const formatter = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
});

export default function ({navigation}) {
  const [isLoading, setIsLoading] = useState(false);
  const [fileBuktiPembayaran, setFileBuktiPembayaran] = useState(null);
  const itemsRekening = useSelector(getItemsRekening);
  const dispatch = useDispatch();
  const isFocussed = useIsFocused();
  const transaction = useSelector(getTransaction);

  const pickFileHandler = async () => {
    const response = await DocumentPicker.pick({
      presentationStyle: 'fullScreen',
      allowMultiSelection: false,
      type: [types.images],
    });

    if (response.length) {
      console.log(response);
      setFileBuktiPembayaran(response[0]);
    }
  };
  const uploadBuktiBayarHandler = async () => {
    try {
      setIsLoading(true);
      const {status, message} = await reqSimpanUploadBuktiBayar(
        serialize({
          order_id: transaction.order_id,
          proof_of_payment: fileBuktiPembayaran,
        }),
      );

      Alert.alert(
        'Perhatian',
        status
          ? transaction.email
            ? 'Upload berhasil, silahkan cek email anda'
            : 'Upload berhasil, silahkan tunggu konfirmasi admin'
          : message,
        [
          {
            text: 'OK',
            onPress: () => {
              if (status) {
                dispatch(SET_FORM_TOURNAMENT(null));
                dispatch(SET_TRANSACTION(null));
                navigation.navigate('daftar-tournament');
              }
            },
          },
        ],
      );

      if (status) {
      }
      setIsLoading(false);
    } catch (error) {
      console.error(error);
    }
  };

  useEffect(() => {
    // if (isFocussed) {
    //   if (!transaction) {
    //     navigation.navigate('daftar-tournament');
    //   } else {
    const loadItemsRekekning = async () => {
      setIsLoading(true);
      const {status, data} = await reqItemsRekening();
      if (status) {
        dispatch(SET_ITEMS_REKENING(data));
      }
      setIsLoading(false);
    };
    loadItemsRekekning();
    // }
    // }
  }, [dispatch, isFocussed, navigation, transaction]);

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
        <Text style={[GlobalStyles.fontBlack, tailwind`text-3xl mt-4`]}>
          Upload Bukti Transfer
        </Text>
      </View>
      <ScrollView
        style={[GlobalStyles.containerCard, tailwind`mt-4 p-4`]}
        showsVerticalScrollIndicator={false}>
        {transaction && (
          <View
            style={{
              borderBottomWidth: 1,
              borderBottomColor: '#acacac',
              paddingVertical: 16,
              marginBottom: 8,
            }}>
            <Text style={[tailwind`text-2xl`]}>
              <Text style={GlobalStyles.fontBlack}>Total Bayar: </Text>
              {formatter.format(transaction.price)}
            </Text>
          </View>
        )}
        {itemsRekening.map(res => (
          <View
            style={[tailwind`p-4 my-2 mb-4`, styles.cardNoRekening]}
            key={res.id}
            row
            centerV>
            <View
              style={{
                width: 96,
                height: 96,
                justifyContent: 'center',
                alignItems: 'center',
              }}>
              <Image
                source={
                  res.logo_url
                    ? {
                        uri: res.logo_url,
                      }
                    : require('../assets/images/labora.png')
                }
                style={{width: 56, height: 56}}
                resizeMode="contain"
              />
            </View>
            <View>
              <Text style={[tailwind`text-base`]}>
                {res.bank} - {res.name}
              </Text>
              <Text
                style={[GlobalStyles.fontBold, tailwind`text-xl mt-2`]}
                selectable={true}>
                {res.no_rek}
              </Text>
              <Text style={[tailwind`text-sm`]}></Text>
            </View>
          </View>
        ))}
        {itemsRekening.length === 0 && (
          <View center style={tailwind`my-4`}>
            <Text>Tidak ditemukan item rekening</Text>
          </View>
        )}
        <View center>
          {fileBuktiPembayaran ? (
            <Image
              source={{uri: fileBuktiPembayaran.uri}}
              style={styles.imagePreview}
            />
          ) : (
            <View style={styles.containerCardUpload} center>
              <Text style={{color: '#fca311'}}>
                Upload Gambar: png, jpg, jpeg
              </Text>
            </View>
          )}
          <Button
            onPress={pickFileHandler}
            label="Ambil File"
            style={[tailwind`mt-4`, {width: 300}]}
            size={Button.sizes.small}
            backgroundColor="#fca311"
            borderRadius={8}
          />
        </View>
        <View style={{height: 100}}></View>
      </ScrollView>
      <Button
        label="Upload Bukti Pembayaran"
        style={tailwind`mt-4`}
        onPress={() =>
          Alert.alert(
            'Perhatian',
            'apakah anda yakin ingin mengupload file ini ?',
            [
              {text: 'Kembali', style: 'destructive'},
              {
                text: 'Yakin',
                style: 'default',
                onPress: uploadBuktiBayarHandler,
              },
            ],
          )
        }
        size={Button.sizes.large}
        backgroundColor="#293241"
        borderRadius={8}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  imagePreview: {
    width: 300,
    height: 150,
    resizeMode: 'contain',
  },
  containerCardUpload: {
    paddingLeft: 10,
    height: 150,
    width: 300,
    marginBottom: 10,
    borderWidth: 4,
    flex: 1,
    borderStyle: 'dotted',
    borderRadius: 20,
    borderColor: '#fca311',
  },
  cardNoRekening: {backgroundColor: '#F2F2F2', borderRadius: 20},
});
