<template>
  <main class="side-menu"> 
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <img src="../assets/images/pnd-logo.png" alt="logo" />

        <div class="h-line"></div>
        General
        <li class="nav-item">
        <router-link class="nav-link " to="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </router-link>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <router-link class="nav-link " to="/projects">
          <i class="bi bi-briefcase"></i>
          <span>Projects</span>
        </router-link>
      </li> <!-- End projects Nav -->

      <li class="nav-item">
        <router-link class="nav-link " to="/calendar">
          <i class="bi bi-calendar-check"></i>
          <span>Calendar</span>
        </router-link>
      </li> <!-- End calendar Nav -->

      <div class="h-line"></div>
      Projects Info
      <li class="nav-item">
        <router-link class="nav-link " to="/tasks">
          <i class="bi bi-list-task"></i>
          <span>Tasks</span>
        </router-link>
      </li><!-- End tasks Nav -->

      <li class="nav-item">
        <router-link class="nav-link " to="/teams">
          <i class="bi bi-microsoft-teams"></i>
          <span>The Team</span>
        </router-link>
      </li> <!-- End teams Nav -->

      <li class="nav-item">
        <router-link class="nav-link " to="/files">
          <i class="bi bi-files"></i>
          <span>Files</span>
        </router-link>
      </li> <!-- End files Nav -->

      <div class="h-line"></div>
      Reporting
      <li class="nav-item">
        <router-link class="nav-link " to="/reports">
          <i class="bi bi-file-text"></i>
          <span>Reports</span>
        </router-link>
      </li><!-- End reports Nav -->

      <li class="nav-item">
        <router-link class="nav-link" to="/stats">
          <i class="bi bi-bar-chart"></i>
          <span>Statistics</span>
        </router-link>
      </li><!-- End stats Nav -->

      <div class="h-line"></div>
      System
      <li class="nav-item">
        <router-link class="nav-link " to="/profile">
          <i class="bi bi-sliders"></i>
          <span>Settings</span>
        </router-link>
      </li><!-- End settings Nav -->

      <li class="nav-item">
        <router-link to="#" v-slot="{navigate}" @click="user_store.signOut" class="nav-link" >
          <i class="bi bi-escape"></i>
          <span>Logout</span>
        </router-link>
      </li><!-- End logout Nav -->

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
    width: 15rem;
    background-color: rgba(128, 128, 128, 0.397);
    height: 1px;
    margin-bottom: 8px;
    position: relative;
    left: 0px;
  }

  .sidebar-nav img {
    width: 10rem;
    margin-left: 2rem;
    margin-bottom: 3rem;

  }
</style>