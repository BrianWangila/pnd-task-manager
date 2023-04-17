import axios from "axios";
import { useAuthStore } from "./stores/authStore";



const axiosClient = axios.create({
    baseURL: 'http://127.0.0.1:8000/api'
    // baseURL: 'https://tms.peakanddale.co.ke/api'
    // baseURL: 'https://tms.unga-group.com/api'
    // baseURL: 'http://127.0.0.1:8000/api'
    // baseURL: 'https://taskmgmt-sandbox.up.railway.app/api'
    // baseURL: 'https://taskmgmt-development.up.railway.app/api'

});



axiosClient.interceptors.request.use(config => {

    const userStore = useAuthStore();
    const token = userStore.token;

    if (token) {
       config.headers.Authorization = `Bearer ${token}` 
       console.log(config.headers.Authorization);
    };

    return config;
});

export default axiosClient;

