<template>
    <div>
        <router-view />
        <Header v-if="!$route.meta.hideNavigation" :toggleSideMenu="toggleSideMenu"/>
        <SideMenu v-if="!$route.meta.hideNavigation && isMenuOpen" />
        <SideMenuSmall v-else-if="!$route.meta.hideNavigation && isMenu2Open"/>
        <SideCalendar v-if="!$route.meta.hideNavigation"/>
    </div>
</template>


<script>
    import SideMenu from './src/components/SideMenu.vue';
    import Header from './src/components/Header.vue';
    import SideCalendar from './src/components/SideCalendar.vue';
    import SideMenuSmall from './src/components/SideMenuSmall.vue';


    export default {
      name: "app",

      components: { 
          SideMenu,
          Header,
          SideCalendar,
          SideMenuSmall
      },

      data(){
          return{
              isMenuOpen: true,
              isMenu2Open: false
          }        
      },

      methods: {
          toggleSideMenu() {
              this.isMenuOpen = !this.isMenuOpen
              this.isMenu2Open = !this.isMenu2Open
          },
      }
    
    }
</script>


<style scoped>

</style>


