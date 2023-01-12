import React from 'react';
import {Image, ScrollView, TouchableOpacity} from 'react-native';
import {View, Text} from 'react-native-ui-lib';
import tailwind from 'twrnc';

export default function ({navigation}) {
  return (
    <View flex style={tailwind`p-4`}>
      <ScrollView style={{backgroundColor: '#EFEFEF', flex: 1}}>
        <TouchableOpacity
          onPress={() => navigation.navigate('form-tournament')}
          style={({pressed}) => [{borderRadius: 8}, pressed && {opacity: 0.8}]}>
          <View
            row
            style={[
              {backgroundColor: '#F8F8F8', borderRadius: 8},
              tailwind`px-4 py-8`,
            ]}>
            <View flex>
              <Text
                style={[tailwind`mb-2`, {fontFamily: 'SFNSDisplay-Regular'}]}>
                Tournament
              </Text>
              <Text
                style={[{fontFamily: 'SFNSDisplay-Black'}, tailwind`text-2xl`]}>
                Mobile Legend
              </Text>
              <Text>
                Tersisa{' '}
                <Text style={{fontFamily: 'SFNSDisplay-Bold'}}>5 Slot</Text>
              </Text>
            </View>
            <View
              style={{
                width: 96,
                height: 96,
                justifyContent: 'center',
                alignItems: 'center',
              }}>
              <Image
                source={{
                  uri: 'https://benditandayusaputra.github.io/assets/img/services/s4.png',
                }}
                style={{width: 56, height: 56}}
                resizeMode="contain"
              />
            </View>
          </View>
        </TouchableOpacity>
      </ScrollView>
    </View>
  );
}
