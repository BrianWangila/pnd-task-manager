import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/authStore';

// path and routes
const routes = [

  {
    name: 'Login',
    path: '/',
    component: () => import('../components/Login.vue'),
    // meta: { hideNavigation: true }
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
    path: '/projects/:id',
    component:  () => import('../components/pages/ProjectDetails.vue')
  },
  {
    name: 'Tasks',
    path: '/tasks',
    component:  () => import('../components/pages/Tasks.vue')
  },
  {
    name: 'TaskDetails',
    path: '/tasks/:id',
    component:  () => import('../components/pages/TaskDetails.vue')
  },
  {
    name: 'Files',
    path: '/files',
    component:  () => import('../components/pages/Files.vue')
  },
  {
    name: 'Reports',
    path: '/reports',
    component:  () => import('../components/pages/Reports.vue')
  },
  {
    name: 'Teams',
    path: '/teams',
    component:  () => import('../components/pages/Teams.vue')
  },
  {
    name: 'EmployeeInfo',
    path: '/employees/:id',
    component:  () => import('../components/pages/EmployeeInfo.vue')
  },
  {
    name: 'Calendar',
    path: '/calendar',
    component:  () => import('../components/pages/Calendar.vue')
  },
  {
    name: 'Statistics',
    path: '/stats',
    component:  () => import('../components/pages/Statistics.vue')
  },
]



const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to) => {

  //redirect to login page if not logged in or invalid route/url
  const publicPages = ['/'];
  const authRequired = !publicPages.includes(to.path);
  const auth = useAuthStore();

  // load user 
  // auth.loadUser();

  if(authRequired && !auth.authUser) {
      auth.returnUrl = to.fullPath;
      return '/';
  }

});
export default router;