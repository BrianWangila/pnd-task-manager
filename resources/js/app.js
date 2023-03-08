// import './bootstrap';
import '../css/app.css';
import { createApp, markRaw } from 'vue';
import { createPinia } from "pinia";


import App from './vue/App.vue'
import 'mdb-vue-ui-kit/css/mdb.min.css';
import router from './vue/src/router'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import 'v-calendar/dist/style.css';
import VCalendar, { SetupCalendar } from 'v-calendar';
// import lv-progressbar from 'lightvue/progressbar';





const spa = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
   store.router = markRaw(router)
});


spa.use(router)
   .use(VCalendar, {})
   .use(SetupCalendar, {})
   .use(VueTailwindDatepicker)
   .use(pinia)
   .mount('#app');