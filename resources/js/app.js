// import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import App from './vue/App.vue'
import 'mdb-vue-ui-kit/css/mdb.min.css';
import router from './vue/src/router'



const spa = createApp(App);

spa.use(router)
   .mount('#app');
   
