import axios from "axios";
import {useAuthStore} from "./stores/authStore";



const axiosClient = axios.create({
    // baseURL: 'http://192.168.1.91:8000/api'
    // baseURL: 'http://127.0.0.1:8000/api'
    baseURL: 'https://taskmgmt-development.up.railway.app/api'
})

axiosClient.interceptors.request.use(config => {
    const userStore = useAuthStore()
    config.headers.Authorization = `Bearer ${userStore.token}`
    console.log(config.headers.Authorization)
    return config;
})

export default axiosClient ; 

