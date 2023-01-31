import React, {useState, useEffect} from 'react';
import {TouchableOpacity, ScrollView, Image, Linking} from 'react-native';
import tailwind from 'twrnc';
import {View, Text} from 'react-native-ui-lib';
import Ionicons from 'react-native-vector-icons/Ionicons';
import {getItemsMetodePembayaran} from '../store/slice/masterSlice';
import {useSelector, useDispatch} from 'react-redux';
import {requestCharge} from '../utils/payment';
import LoadingOverlay from '../components/LoadingOverlay';
import {
  getTransaction,
  getForm,
  SET_FORM_TOURNAMENT,
  SET_TRANSACTION,
} from '../store/slice/tournamentSlice';
import {BASE_URL} from '../config';
import {useIsFocused} from '@react-navigation/native';
import {showMessage} from 'react-native-flash-message';
import GlobalStyles from '../constants/GlobalStyles';

export default function ({navigation}) {
  const itemsPembayaran = useSelector(getItemsMetodePembayaran);
  const transaction = useSelector(getTransaction);
  const form = useSelector(getForm);
  const dispatch = useDispatch();
  const isFocussed = useIsFocused();
  const [isLoading, setIsLoading] = useState(false);

  const paymentHandler = async method => {
    setIsLoading(true);
    const response = await requestCharge({
      payment_type: method,
      transaction_details: transaction.transaction_details,
      item_details: transaction.item_details,
      customer_details: {
        first_name: form.name,
        phone: form.hp,
        email: form.email,
      },
      gopay: {
        enable_callback: true,
        callback_url: `${BASE_URL}register_tournament/update/${transaction.transaction_details.order_id}`,
      },
    });

    if (method === 'gopay') {
      if (response.status) {
        const supported = await Linking.canOpenURL(response.link);

        if (supported) {
          dispatch(SET_FORM_TOURNAMENT(null));
          dispatch(SET_TRANSACTION(null));
          await Linking.openURL(response.link);
        } else {
          showMessage({
            type: 'danger',
            message: 'URL Tidak Valid',
          });
        }
      }
    } else if (response?.link) {
      navigation.navigate('qris-payment', {url_qrcode: response.link});
    } else {
      showMessage({
        type: 'danger',
        message: response.message,
      });
    }

    setIsLoading(false);
  };

  useEffect(() => {
    if (isFocussed) {
      if (!transaction) {
        navigation.navigate('daftar-tournament');
      }
    }
  }, [isFocussed, navigation, transaction]);

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
          Metode Bayar
        </Text>
      </View>
      <ScrollView style={[GlobalStyles.containerCard, tailwind`mt-4 h-full`]}>
        {itemsPembayaran.map((item, idx) => (
          <TouchableOpacity
            key={idx}
            // onPress={() => paymentHandler(item.value)}
            style={({pressed}) => pressed && {opacity: 0.6}}>
            <View
              style={[tailwind`px-4 py-8`, GlobalStyles.cardItemPembayaran]}
              row
              centerV>
              <Image
                source={item.logo}
                style={GlobalStyles.styleImageLogoMetodePembayaran}
              />
              <View style={tailwind`ml-4`}>
                <Text
                  style={[tailwind`text-base`, GlobalStyles.fontBold]}
                  flexG>
                  {item.name}
                </Text>
                <Text>{item.description}.</Text>
              </View>
            </View>
          </TouchableOpacity>
        ))}
        <TouchableOpacity
          style={({pressed}) => pressed && {opacity: 0.6}}
          onPress={() => navigation.navigate('upload-bukti-transfer')}>
          <View
            style={[tailwind`px-4 py-8`, GlobalStyles.cardItemPembayaran]}
            row
            centerV>
            <Ionicons name="card" size={20} color="#293241" />
            <View style={tailwind`ml-4`}>
              <Text style={[tailwind`text-base`, GlobalStyles.fontBold]} flexG>
                Transfer Bank
              </Text>
              <Text>Transfer dan upload bukti transfer bank.</Text>
            </View>
          </View>
        </TouchableOpacity>
      </ScrollView>
    </View>
  );
}
