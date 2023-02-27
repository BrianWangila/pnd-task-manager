import { createRouter, createWebHistory } from 'vue-router';

//importing components
// import Login from '../components/Login.vue';
// import Dashboard from '../components/Dashboard.vue';
// import NotFound from '@/components/NotFound.vue';


// routes
const routes = [
  {
    name: 'Login',
    path: '/',
    component: () => import('../components/Login.vue'),
    meta: { hideNavigation: true }
  },
  {
    name: 'Dashboard',
    path: '/dashboard',
    component:  () => import('../components/Dashboard.vue')
  },
  
  // {
  //   path: '/:pathMatch(.*)*',
  //   component: NotFound
  // }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;