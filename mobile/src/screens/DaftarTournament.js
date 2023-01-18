import React, {useEffect, useState, useCallback} from 'react';
import {Image, FlatList, TouchableOpacity, RefreshControl} from 'react-native';
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
    <View flex style={tailwind`p-4`}>
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
        keyExtractor={(_, idx) => idx}
        style={{backgroundColor: '#EFEFEF', flex: 1}}
        renderItem={({item}) => (
          <TouchableOpacity
            onPress={() =>
              navigation.navigate('form-tournament', {
                tournament_id: item.id,
                nama_tournament: item.name,
              })
            }
            style={({pressed}) => [
              {borderRadius: 8},
              pressed && {opacity: 0.8},
            ]}>
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
                  source={{
                    uri: 'https://benditandayusaputra.github.io/assets/img/services/s4.png',
                  }}
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
