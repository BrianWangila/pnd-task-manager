<template>
  <div>
    <router-view />
    <Header v-if="!$route.meta.hideNavigation"/>
    <SideMenu v-if="!$route.meta.hideNavigation"/>
    <SideCalendar v-if="!$route.meta.hideNavigation"/>
  </div>
</template>


<script>
  import SideMenu from './src/components/SideMenu.vue';
  import Header from './src/components/Header.vue';
  import SideCalendar from './src/components/SideCalendar.vue';


  export default {
    name: "app",
    components: {
      SideMenu,
      Header,
      SideCalendar
    }
   
  }
</script>


<style scoped>
 
</style>


