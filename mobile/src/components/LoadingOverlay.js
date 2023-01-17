import React from 'react';
import {ActivityIndicator, StyleSheet, Text, View, Modal} from 'react-native';

function LoadingOverlay({message}) {
  return (
    <Modal transparent={true} visible={true}>
      <View style={styles.rootContainer}>
        <ActivityIndicator size="large" color={'#293241'} />
        <Text style={styles.message}>{message}</Text>
      </View>
    </Modal>
  );
}

export default LoadingOverlay;

const styles = StyleSheet.create({
  rootContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 32,
    backgroundColor: 'rgba(255,255,255, 0.75)',
  },
  message: {
    fontSize: 12,
    marginBottom: 12,
    color: '#919191',
    marginTop: 16,
  },
});
