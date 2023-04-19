<template>

        <!-- <Header  v-if="!$route.meta.hideNavigation" :toggleSideMenu="toggleSideMenu"/> -->
        <!-- <Header  v-if="!isLogin" :toggleSideMenu="toggleSideMenu"/> -->

        <Header  v-if="!isLogin" :toggleSideMenu="toggleSideMenu"/>
        <SideMenu v-if="!isLogin && isMenuOpen"/>
        <SideMenuSmall v-if="!isLogin && isMenu2Open"/>
        <SideCalendar v-if="!isLogin" />

        <router-view />


    
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
              isMenu2Open: false,

          }        
      },

      methods: {
            toggleSideMenu() {
                this.isMenuOpen = !this.isMenuOpen
                this.isMenu2Open = !this.isMenu2Open
            },
      },

      computed: {
        isLogin() {
            return this.$route.name == "Login";
        }
    },
    
    }
</script>


<style scoped>

</style>


