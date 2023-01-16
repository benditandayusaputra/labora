import {createSlice} from '@reduxjs/toolkit';
import LogoGopay from '../../assets/images/logo/gopay-logo.png';
// import LogoDana from '../../assets/images/logo/dana-pay-logo.png';
// import LogoOVO from '../../assets/images/logo/ovo-pay-logo.png';
// import LogoShopeePay from '../../assets/images/logo/shopee-pay-logo.png';

const masterSlice = createSlice({
  name: 'master',
  initialState: {
    itemsClub: [
      {label: 'Req Regum Qeon', value: 'rrq'},
      {label: 'Evos', value: 'evos'},
      {label: 'Louvre', value: 'louvre'},
      {label: 'Geek Fam', value: 'geek'},
    ],
    itemsMetodePembayaran: [
      {
        name: 'GoPay',
        logo: LogoGopay,
        value: 'gopay',
      },
    ],
  },
});

export const getItemsClub = state => state.master.itemsClub;
export const getItemsMetodePembayaran = state =>
  state.master.itemsMetodePembayaran;

export default masterSlice.reducer;
