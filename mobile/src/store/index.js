import {configureStore} from '@reduxjs/toolkit';
import masterSlice from './slice/masterSlice';

export default configureStore({
  reducer: {
    master: masterSlice,
  },
});
