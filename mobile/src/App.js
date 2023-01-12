import React from 'react';
import {View, ThemeManager} from 'react-native-ui-lib';
import Container from './container';

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
      <Container />
    </View>
  );
}
