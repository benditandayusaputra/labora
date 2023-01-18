import {createSlice} from '@reduxjs/toolkit';

const tournamentSlice = createSlice({
  name: 'tournament',
  initialState: {
    form: {
      tournament_id: null,
      club_id: null,
      name: null,
      hp: null,
      status: 0,
    },
  },
  reducers: {
    SET_VALUE_FORM_TOURNAMENT(state, {payload}) {
      state.form[payload.key] = payload.value;
    },
  },
});

export const getForm = state => state.tournament.form;

export const {SET_VALUE_FORM_TOURNAMENT} = tournamentSlice.actions;
export default tournamentSlice.reducer;
