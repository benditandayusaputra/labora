import axios from 'axios';
import {BASE_URL} from '@env';

const instance = axios.create({
  baseURL: BASE_URL,
});

instance.interceptors.request.use(
  req => {
    req.headers['Content-Type'] = 'application/json';
    return req;
  },
  err => {
    return Promise.reject(err);
  },
);

export default instance;
