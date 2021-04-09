import axios from 'axios'
import router from '../router/index'

const api = axios.create({
  baseURL: 'http://localhost:801/SacntumAuth/api/v1/',
  headers: {
    'Content-Type': 'application/json',
    'accept': 'application/json'
  }
});

api.defaults.withCredentials = true;

api.interceptors.response.use(
  res => res.data,
  err => {
    if (err.response.status === 401) {
      if (err.response.request.responseURL !== 'http://localhost:801/SacntumAuth/api/v1/user')
        {
           router.push({name: 'signin'})
        }
    } 
    if (err.response.status === 419) {
      router.push({name: 'badRequest'})
    }
    return Promise.reject(err.response);
  }
);

export default api