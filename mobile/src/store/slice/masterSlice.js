import {createSlice} from '@reduxjs/toolkit';
import LogoGopay from '../../assets/images/logo/gopay-logo.png';
// import LogoDana from '../../assets/images/logo/dana-pay-logo.png';
// import LogoOVO from '../../assets/images/logo/ovo-pay-logo.png';
// import LogoShopeePay from '../../assets/images/logo/shopee-pay-logo.png';

const masterSlice = createSlice({
  name: 'master',
  initialState: {
    itemsClub: [],
    itemsTournament: [],
    itemsMetodePembayaran: [
      {
        name: 'GoPay',
        logo: LogoGopay,
        value: 'gopay',
      },
    ],
  },
  reducers: {
    SET_ITEMS_TOURNAMENT(state, {payload}) {
      state.itemsTournament = payload;
    },
    SET_ITEMS_CLUB(state, {payload}) {
      state.itemsClub = payload;
    },
  },
});

export const {SET_ITEMS_TOURNAMENT, SET_ITEMS_CLUB} = masterSlice.actions;

export const getItemsClub = state => state.master.itemsClub;
export const getItemsMetodePembayaran = state =>
  state.master.itemsMetodePembayaran;
export const getItemsTournament = state => state.master.itemsTournament;

export default masterSlice.reducer;
