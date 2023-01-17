import axios from 'axios';
import {MIDTRANS_APIKEY, MIDTRANS_BASEURL} from '@env';

const instance = axios.create({
  baseURL: 'https://api.midtrans.com/v2/',
  headers: {
    'Content-Type': 'application/json; charset=utf-8',
    // Authorization: `Basic ${MIDTRANS_APIKEY}`,
    Authorization: `Basic TWlkLXNlcnZlci1VXzR2ejFlcjV5MVlHZ3pDZ0xhd0xJaXU6`,
  },
});

export default instance;
