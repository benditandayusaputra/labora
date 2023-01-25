import React, {useEffect} from 'react';
import {TouchableOpacity} from 'react-native';
import {View, Text, Image} from 'react-native-ui-lib';
import Ionicons from 'react-native-vector-icons/Ionicons';
import tailwind from 'twrnc';
import {useIsFocused} from '@react-navigation/native';

export default function ({navigation, route}) {
  const {url_qrcode} = route.params;
  const isFocussed = useIsFocused();
  useEffect(() => {
    if (isFocussed) {
      if (!url_qrcode) {
        navigation.navigate('daftar-tournament');
      }
    }
  }, [isFocussed, navigation, url_qrcode]);

  return (
    <View flex style={tailwind`p-4`}>
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
          Scan QRIS
        </Text>
      </View>
      <View
        flex
        center
        style={[{backgroundColor: '#FFF', borderRadius: 8}, tailwind`mt-4`]}>
        <Image
          source={{
            uri: url_qrcode,
          }}
          style={{width: 300, height: 300}}
        />
      </View>
    </View>
  );
}
