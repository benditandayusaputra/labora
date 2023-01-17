import React, {useState} from 'react';
import {
  TouchableOpacity,
  ScrollView,
  Image,
  Linking,
  Alert,
} from 'react-native';
import tailwind from 'twrnc';
import {View, Text} from 'react-native-ui-lib';
import Ionicons from 'react-native-vector-icons/Ionicons';
import {getItemsMetodePembayaran} from '../store/slice/masterSlice';
import {useSelector} from 'react-redux';
import {requestCharge} from '../utils/payment';
import LoadingOverlay from '../components/LoadingOverlay';

export default function ({navigation}) {
  const itemsPembayaran = useSelector(getItemsMetodePembayaran);
  const [isLoading, setIsLoading] = useState(false);
  const paymentHandler = async method => {
    setIsLoading(true);
    const response = await requestCharge({
      payment_type: 'gopay',
      transaction_details: {
        order_id: '1673872498125',
        gross_amount: 20000,
      },
      item_details: [
        {
          id: '1',
          price: 20000,
          quantity: 1,
          name: 'Baju',
        },
      ],
      customer_details: {
        first_name: 'Ibnu',
        last_name: 'Shevayanto',
        email: 'ibnushevayanto@gmail.com',
        phone: '081386909757',
      },
      gopay: {
        enable_callback: true,
        callback_url: 'someapps://callback',
      },
    });

    if (response.status) {
      const supported = await Linking.canOpenURL(response.link);

      if (supported) {
        await Linking.openURL(response.link);
      } else {
        Alert.alert(`Don't know how to open this URL: ${response.link}`);
      }
    }
    setIsLoading(false);
  };

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
          Bayar
        </Text>
      </View>
      <ScrollView
        style={[
          {backgroundColor: '#F8F8F8', borderRadius: 8, flex: 1},
          tailwind`mt-4`,
        ]}>
        {itemsPembayaran.map((item, idx) => (
          <TouchableOpacity
            key={idx}
            onPress={() => paymentHandler('gopay')}
            style={({pressed}) => pressed && {opacity: 0.6}}>
            <View
              style={[
                tailwind`px-4 py-8`,
                {borderBottomWidth: 1, borderBottomColor: '#ddd'},
              ]}
              row
              centerV>
              <Image
                source={item.logo}
                style={{width: 20, height: 20, borderRadius: 4}}
              />
              <Text
                style={[
                  tailwind`text-base ml-4`,
                  {fontFamily: 'SFNSDisplay-Bold'},
                ]}
                flexG>
                {item.name}
              </Text>
            </View>
          </TouchableOpacity>
        ))}
      </ScrollView>
    </View>
  );
}
