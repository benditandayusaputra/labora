import {createSlice} from '@reduxjs/toolkit';
import LogoGopay from '../../assets/images/logo/gopay-logo.png';
import LogoQRIS from '../../assets/images/logo/qris-logo.png';
// import LogoDana from '../../assets/images/logo/dana-pay-logo.png';
// import LogoOVO from '../../assets/images/logo/ovo-pay-logo.png';
// import LogoShopeePay from '../../assets/images/logo/shopee-pay-logo.png';

const masterSlice = createSlice({
  name: 'master',
  initialState: {
    itemsClub: [],
    itemsTournament: [],
    itemsRekening: [],
    itemsMetodePembayaran: [
      {
        name: 'GoPay',
        logo: LogoGopay,
        value: 'gopay',
        description: 'Bayar menggunakan gopay',
      },
      {
        name: 'QRIS',
        logo: LogoQRIS,
        value: 'qris',
        description:
          'Pengguna Dana, OVO dan yang lainnya, bisa menggunaan QRIS sebagai metode pembayaran',
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
    SET_ITEMS_REKENING(state, {payload}) {
      state.itemsRekening = payload;
    },
  },
});

export const {SET_ITEMS_TOURNAMENT, SET_ITEMS_CLUB, SET_ITEMS_REKENING} =
  masterSlice.actions;

export const getItemsClub = state => state.master.itemsClub;
export const getItemsMetodePembayaran = state =>
  state.master.itemsMetodePembayaran;
export const getItemsTournament = state => state.master.itemsTournament;
export const getItemsRekening = state => state.master.itemsRekening;

export default masterSlice.reducer;
