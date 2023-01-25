import React, {useState} from 'react';
import {View, Text, Button} from 'react-native-ui-lib';
import {TouchableOpacity, ScrollView, StyleSheet, Image} from 'react-native';
import LoadingOverlay from '../components/LoadingOverlay';
import Ionicons from 'react-native-vector-icons/Ionicons';
import tailwind from 'twrnc';
import GlobalStyles from '../constants/GlobalStyles';
import DocumentPicker, {types} from 'react-native-document-picker';

export default function ({navigation}) {
  const [isLoading, setIsLoading] = useState(false);
  const [fileBuktiPembayaran, setFileBuktiPembayaran] = useState(null);

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
        style={[GlobalStyles.containerCard, tailwind`mt-4 p-4 h-full`]}>
        <View style={[tailwind`p-4 my-2`, styles.cardNoRekening]}>
          <Text style={[tailwind`text-base`]}>Bank Jago</Text>
          <Text style={[GlobalStyles.fontBold, tailwind`text-xl mt-2`]}>
            102158903826
          </Text>
          <Text style={[tailwind`text-sm`]}>Ibnu Shevayanto</Text>
        </View>

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
      </ScrollView>
      <Button
        label="Upload Bukti Pembayaran"
        style={tailwind`mt-4`}
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
    borderStyle: 'dotted',
    borderRadius: 20,
    borderColor: '#fca311',
  },
  cardNoRekening: {backgroundColor: '#F2F2F2', borderRadius: 20},
});
