import axios from "axios";
import {useAuthStore} from "./stores/authStore";

// const user_store = useAuthStore()

const axiosClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
})

axiosClient.interceptors.request.use(config => {

  config.headers.Authorization = `Bearer ${useAuthStore().token}`
  console.log(config.headers.Authorization)
  return config;
})

export default axiosClient;