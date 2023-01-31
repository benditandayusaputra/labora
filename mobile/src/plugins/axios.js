import axios from 'axios';
import {BASE_URL} from '../config';

const instance = axios.create({
  baseURL: BASE_URL,
});

instance.interceptors.request.use(
  req => {
    return req;
  },
  err => {
    return Promise.reject(err);
  },
);

export default instance;
