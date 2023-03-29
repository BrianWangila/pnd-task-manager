<template>
  <main class="side-menu"> 
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <img src="../assets/images/logo-small.png" alt="logo" />
        <div class="h-line"></div>
        <li class="nav-item">
          <router-link class="nav-link " to="/dashboard">
            <i class="bi bi-grid"></i>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link " to="/projects">
            <i class="bi bi-briefcase"></i>
          </router-link>
        </li>

        <li class="nav-item" v-if="role == 'admin'">
          <router-link class="nav-link " to="/calendar">
            <i class="bi bi-calendar-check"></i>
          </router-link>
        </li>

        <div class="h-line"></div>
        <li class="nav-item">
          <router-link class="nav-link " to="/tasks">
            <i class="bi bi-list-task"></i>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link " to="/teams">
            <i class="bi bi-microsoft-teams"></i>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link " to="/files">
            <i class="bi bi-files"></i>
          </router-link>
        </li>

        <div class="h-line"></div>
        <li class="nav-item" v-if="role == 'admin'">
          <router-link class="nav-link " to="/reports">
            <i class="bi bi-file-text"></i>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to="/stats">
            <i class="bi bi-bar-chart"></i>
          </router-link>
        </li>

        <div class="h-line"></div>
        <li class="nav-item">
          <router-link class="nav-link " to="/profile">
            <i class="bi bi-sliders"></i>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="#" v-slot="{navigate}" @click="user_store.signOut" class="nav-link" >
            <i class="bi bi-escape"></i>
          </router-link>
        </li>
      </ul>
    </aside>
  </main>
</template>

<script>
  import { useAuthStore } from '../stores/authStore';

  export default {
    components: {

    },
    data(){
      return{
        user_store: useAuthStore()
      }
    },
  }
</script>

<style scoped>
  .h-line {
    width: 4.7rem;
    background-color: rgba(128, 128, 128, 0.397);
    height: 1px;
    margin-bottom: 8px;
    position: relative;
    left: 0px;
  }

  .sidebar-nav img {
    width: 4rem;
    margin-bottom: 3rem;

  }

  .side-menu .sidebar {
    width: 5vw;
  }

  .side-menu .sidebar .nav-item {
    margin-top: 18px;
  }
</style>