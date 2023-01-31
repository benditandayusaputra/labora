import {createSlice} from '@reduxjs/toolkit';

const tournamentSlice = createSlice({
  name: 'tournament',
  initialState: {
    form: {
      tournament_id: null,
      club_id: null,
      name: null,
      hp: null,
      email: null,
      status: 0,
      division: null,
    },
    transaction: null,
  },
  reducers: {
    SET_VALUE_FORM_TOURNAMENT(state, {payload}) {
      state.form[payload.key] = payload.value;
    },
    SET_TRANSACTION(state, {payload}) {
      state.transaction = payload;
    },
    SET_FORM_TOURNAMENT(state, {payload}) {
      state.form = payload || {
        tournament_id: null,
        club_id: null,
        name: null,
        hp: null,
        email: null,
        status: 0,
      };
    },
  },
});

export const getForm = state => state.tournament.form;
export const getTransaction = state => state.tournament.transaction;

export const {SET_VALUE_FORM_TOURNAMENT, SET_TRANSACTION, SET_FORM_TOURNAMENT} =
  tournamentSlice.actions;
export default tournamentSlice.reducer;
