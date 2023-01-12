import React, {useState} from 'react';
import {TouchableOpacity, ScrollView, StyleSheet} from 'react-native';
import {View, Text, Button, Picker, Incubator} from 'react-native-ui-lib';
import tailwind from 'twrnc';
import Ionicons from 'react-native-vector-icons/Ionicons';

const {TextField} = Incubator;
const options = [
  {label: 'Req Regum Qeon', value: 'rrq'},
  {label: 'Evos', value: 'evos'},
  {label: 'Louvre', value: 'louvre'},
  {label: 'Geek Fam', value: 'geek'},
];
export default function ({navigation}) {
  const [clubModel, setClubModel] = useState(null);
  const [itemsInputanNama, setItemsInputanNama] = useState([
    'Ibnu',
    'Bendi',
    'Fauzi',
    'Teguh',
    'Mamat',
  ]);

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
          Mobile Legend Championship
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
          <Picker
            showSearch
            placeholder={'Pilih Club'}
            style={styles.underlineField}
            migrateTextField
            topBarProps={{title: 'Daftar Club'}}
            onChange={value => setClubModel(value.value)}
            value={clubModel}>
            {options.map(option => (
              <Picker.Item
                key={option.value}
                value={option.value}
                label={option.label}
                disabled={option.disabled}
              />
            ))}
          </Picker>
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Nama
          </Text>
          <View row centerV style={tailwind`mb-2`}>
            <View flexG>
              <TextField
                placeholder="Input Nama"
                style={styles.underlineField}
              />
            </View>
            <TouchableOpacity style={tailwind`ml-2`}>
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
                <TouchableOpacity style={tailwind`ml-2`}>
                  <Ionicons name="close-circle-sharp" color={'red'} size={24} />
                </TouchableOpacity>
              </View>
            </View>
          ))}
        </View>
        <View style={tailwind`mb-2`}>
          <Text style={[{fontFamily: 'SFNSDisplay-Bold'}, tailwind`text-base`]}>
            Nomor Telepon
          </Text>
          <TextField
            keyboardType="number-pad"
            placeholder="Input Nomor Telepon"
            style={styles.underlineField}
          />
        </View>
        <View style={{height: 50}}></View>
      </ScrollView>
      <Button
        label="Daftar"
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
