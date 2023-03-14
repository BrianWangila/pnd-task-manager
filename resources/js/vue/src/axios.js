import axios from "axios";
import {useAuthStore} from "./stores/authStore";



const axiosClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
  // baseURL: 'https://taskmgmt-development.up.railway.app/api'
})

axiosClient.interceptors.request.use(config => {
  const user_store = useAuthStore()
  config.headers.Authorization = `Bearer ${user_store.token}`
  console.log(config.headers.Authorization)
  return config;
})

export default axiosClient;