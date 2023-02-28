// import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import App from './vue/App.vue'
import 'mdb-vue-ui-kit/css/mdb.min.css';
import router from './vue/src/router'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import 'v-calendar/dist/style.css';
import VCalendar, { SetupCalendar } from 'v-calendar';
// import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';






const spa = createApp(App);

spa.use(router)
   .use(VCalendar, {})
   .use(SetupCalendar, {})
   .use(VueTailwindDatepicker)
   .mount('#app');

// spa.component('Calendar', Calendar)
// spa.component('DatePicker', DatePicker)
   
