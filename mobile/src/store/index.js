import {configureStore} from '@reduxjs/toolkit';
import masterSlice from './slice/masterSlice';
import tournamentSlice from './slice/tournamentSlice';

export default configureStore({
  reducer: {
    master: masterSlice,
    tournament: tournamentSlice,
  },
});
