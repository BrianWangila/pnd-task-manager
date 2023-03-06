import { createRouter, createWebHistory } from 'vue-router';

// path and routes
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
  {
    name: 'Profile',
    path: '/profile',
    component:  () => import('../components/pages/Profile.vue')
  },
  {
    name: 'Projects',
    path: '/projects',
    component:  () => import('../components/pages/Projects.vue')
  },
  {
    name: 'ProjectDetails',
    path: '/projects/project',
    component:  () => import('../components/pages/ProjectDetails.vue')
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;