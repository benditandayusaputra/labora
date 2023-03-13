import React, {useEffect, useState, useCallback} from 'react';
import {Image, FlatList, TouchableOpacity, RefreshControl, Alert} from 'react-native';
import {View, Text} from 'react-native-ui-lib';
import tailwind from 'twrnc';
import {useSelector, useDispatch} from 'react-redux';
import {
  getItemsTournament,
  SET_ITEMS_TOURNAMENT,
} from '../store/slice/masterSlice';
import {useIsFocused} from '@react-navigation/native';
import {reqItemsTournament} from '../utils/tournament';

export default function ({navigation}) {
  const itemsTournament = useSelector(getItemsTournament);
  const isFocussed = useIsFocused();
  const [isLoading, setIsLoading] = useState(false);
  const dispatch = useDispatch();

  const clickTournamentHandler = (item) => {
    if (item.quota > 0) {
      navigation.navigate('form-tournament', {
        tournament_id: item.id,
        nama_tournament: item.name,
        division: item.division ? JSON.parse(item.division) : null,
        description: item.description,
        quota: item.quota,
      })
    } else {
      Alert.alert('Gagal', 'Slot Turnamen Telah Habis!', ['Oke']);
    }
  };

  const loadItemsTournamentHandler = useCallback(async () => {
    setIsLoading(true);
    const {status, data} = await reqItemsTournament();
    if (status) {
      dispatch(SET_ITEMS_TOURNAMENT(data));
    }
    setIsLoading(false);
  }, [dispatch]);

  useEffect(() => {
    if (isFocussed) {
      loadItemsTournamentHandler();
    }
  }, [isFocussed, loadItemsTournamentHandler]);

  return (
    <View flex>
      {itemsTournament.length === 0 && (
        <Text>Tidak ditemukan data tournament</Text>
      )}
      <FlatList
        refreshControl={
          <RefreshControl
            refreshing={isLoading}
            onRefresh={loadItemsTournamentHandler}
          />
        }
        data={itemsTournament}
        showsVerticalScrollIndicator={false}
        keyExtractor={(_, idx) => idx}
        style={[{backgroundColor: '#EBF0F4', flex: 1}, tailwind`p-4`]}
        renderItem={({item, index}) => (
          <TouchableOpacity
            onPress={() =>
              clickTournamentHandler(item)
            }
            style={({pressed}) => [pressed && {opacity: 0.8}]}>
            <View
              row
              style={[
                {
                  backgroundColor: '#FFF',
                  elevation: 4,
                },
                tailwind`px-4 py-8 mb-4`,
              ]}>
              <View flex>
                <Text
                  style={[tailwind`mb-2`, {fontFamily: 'SFNSDisplay-Regular'}]}>
                  Tournament
                </Text>
                <Text
                  style={[
                    {fontFamily: 'SFNSDisplay-Black'},
                    tailwind`text-2xl`,
                  ]}>
                  {item.name}
                </Text>
                <Text>
                  Tersisa{' '}
                  <Text style={{fontFamily: 'SFNSDisplay-Bold'}}>
                    {item.quota} Slot
                  </Text>
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
                  source={
                    item.logo_url
                      ? {
                          uri: item.logo_url,
                        }
                      : require('../assets/images/labora.png')
                  }
                  style={{width: 56, height: 56}}
                  resizeMode="contain"
                />
              </View>
            </View>
          </TouchableOpacity>
        )}
      />
    </View>
  );
}
