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
// import VCalendar, { SetupCalendar } from 'v-calendar';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
// import DataTable from 'datatables.net-vue3';
// // import DataTablesLib from 'datatables.net';
// import DataTablesLib from 'datatables.net-bs5';
// import 'datatables.net-select-bs5'; // module




const spa = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
   store.router = markRaw(router)
});

const options = {
   confirmButtonColor: '#41b882',
   cancelButtonColor: '#ff7674',
 };

// DataTable.use(DataTablesLib);

spa.component('VueDatePicker', VueDatePicker);

spa.use(router)
   // .use(VCalendar, {})
   // .use(SetupCalendar, {})
   .use(Toast)
   .use(VueSweetalert2, options)
   .use(VueTailwindDatepicker)
   .use(pinia)
   .mount('#app');