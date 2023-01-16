import React from 'react';
import {NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';
import DaftarTournament from '../screens/DaftarTournament';
import FormTournament from '../screens/FormTournament';
import BayarTournament from '../screens/BayarTournament';

const Stack = createNativeStackNavigator();

export default function () {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="daftar-tournament">
        <Stack.Screen
          name="daftar-tournament"
          component={DaftarTournament}
          options={{
            title: 'LABORA',
            headerTitleAlign: 'center',
            headerTitleStyle: {
              fontFamily: 'SFNSDisplay-Bold',
              color: '#293241',
              fontSize: 14,
            },
            headerShadowVisible: false,
          }}
        />
        <Stack.Screen
          name="form-tournament"
          component={FormTournament}
          options={{headerShown: false}}
        />
        <Stack.Screen
          name="bayar-tournament"
          component={BayarTournament}
          options={{headerShown: false}}
        />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
