import React from 'react';
import {NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';
import DaftarTournament from '../screens/DaftarTournament';
import FormTournament from '../screens/FormTournament';
import BayarTournament from '../screens/BayarTournament';
import QRISPayment from '../screens/QRISPayment';
import UploadBuktiTransfer from '../screens/UploadBuktiTransfer';

const Stack = createNativeStackNavigator();

export default function () {
  return (
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen
          name="daftar-tournament"
          component={DaftarTournament}
          options={{
            title: 'PT. Labora Menyelenggarakan',
            headerTitleAlign: 'center',
            headerTitleStyle: {
              fontFamily: 'SFNSDisplay-Bold',
              color: '#293241',
              fontSize: 14,
            },
          }}
        />
        <Stack.Screen
          name="form-tournament"
          component={FormTournament}
          options={{headerShown: false}}
        />

        <Stack.Screen
          name="qris-payment"
          component={QRISPayment}
          options={{headerShown: false}}
        />
        <Stack.Screen
          name="bayar-tournament"
          component={BayarTournament}
          options={{headerShown: false}}
        />
        <Stack.Screen
          name="upload-bukti-transfer"
          component={UploadBuktiTransfer}
          options={{headerShown: false}}
        />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
