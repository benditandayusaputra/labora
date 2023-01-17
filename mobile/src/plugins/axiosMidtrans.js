import axios from 'axios';
import {MIDTRANS_APIKEY, MIDTRANS_BASEURL} from '@env';

const instance = axios.create({
  baseURL: MIDTRANS_BASEURL,
  headers: {
    'Content-Type': 'application/json; charset=utf-8',
    // Authorization: `Basic ${MIDTRANS_APIKEY}`,
    Authorization: `Basic ${MIDTRANS_APIKEY}`,
  },
});

export default instance;
