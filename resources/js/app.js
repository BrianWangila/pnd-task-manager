// import './bootstrap';
import '../css/app.css';
import { createApp, markRaw } from 'vue';
import { createPinia } from "pinia";


import App from './vue/App.vue'
import 'mdb-vue-ui-kit/css/mdb.min.css';
import 'mdb-ui-kit/css/mdb.min.css';
import router from './vue/src/router'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import 'v-calendar/dist/style.css';
import VCalendar, { SetupCalendar } from 'v-calendar';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import * as mdb from 'mdb-ui-kit'; // lib
import { Input } from 'mdb-ui-kit'; // module




const spa = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
   store.router = markRaw(router)
});



spa.use(router)
   .use(VCalendar, {})
   .use(SetupCalendar, {})
   .use(Toast)
   .use(VueTailwindDatepicker)
   .use(pinia)
   .mount('#app');