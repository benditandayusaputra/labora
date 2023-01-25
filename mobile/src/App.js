import React from 'react';
import {View, ThemeManager} from 'react-native-ui-lib';
import Container from './container';
import {Provider} from 'react-redux';
import store from './store';
import FlashMessage from 'react-native-flash-message';

ThemeManager.setComponentTheme('Text', {
  style: {
    fontFamily: 'SFNSDisplay-Regular',
    color: '#293241',
  },
});

ThemeManager.setComponentTheme('Button', {
  labelStyle: {
    fontFamily: 'SFNSDisplay-Regular',
  },
});

export default function () {
  return (
    <View flex>
      <Provider store={store}>
        <Container />
      </Provider>
      <FlashMessage floating={true} />
    </View>
  );
}
