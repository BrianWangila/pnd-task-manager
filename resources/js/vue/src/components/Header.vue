<template>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
          <i @click="toggleSideMenu" class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search for anything" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
              </a>
            </li><!-- End Search Icon-->

            <li class="nav-item notification dropdown">

              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-warning badge-number">4</span>
              </a><!-- End Notification Icon -->

              <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                  You have 4 new notifications
                  <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                  <i class="bi bi-exclamation-circle text-warning"></i>
                  <div>
                    <h4>Lorem Ipsum</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>30 min. ago</p>
                  </div>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                  <i class="bi bi-x-circle text-danger"></i>
                  <div>
                    <h4>Atque rerum nesciunt</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>1 hr. ago</p>
                  </div>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                  <i class="bi bi-check-circle text-success"></i>
                  <div>
                    <h4>Sit rerum fuga</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>2 hrs. ago</p>
                  </div>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                  <i class="bi bi-info-circle text-primary"></i>
                  <div>
                    <h4>Dicta reprehenderit</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>4 hrs. ago</p>
                  </div>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                  <a href="#">Show all notifications</a>
                </li>

              </ul> -->

            </li>

            <li class="nav-item notification dropdown">

              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number">3</span>
              </a>

              <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header">
                  You have 3 new messages
                  <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                  <a href="#">
                    <img src="../assets/images/messages-1.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>Ken Walibora</h4>
                      <p>Message</p>
                      <p>4 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                  <a href="#">
                    <img src="../assets/images/messages-2.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>Mathew Ndegwa</h4>
                      <p>Message</p>
                      <p>6 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                  <a href="#">
                    <img src="../assets/images/messages-3.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>Brian Wangila</h4>
                      <p>Message</p>
                      <p>8 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li class="dropdown-footer">
                  <a href="#">Show all messages</a>
                </li>

              </ul> -->

            </li>

            <div v-if="user">
              <li class="nav-item dropdown pe-3">

              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="../assets/images/avatar.png" alt="Profile" class="rounded-circle">
                <span v-if="user.role == 'admin'" class="d-none d-md-block dropdown-toggle ps-2">{{ user.role }}</span>
                <span v-else class="d-none d-md-block dropdown-toggle ps-2">{{ firstName[0] }}</span>

              </a><!-- End Profile Image Icon -->

              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <h6>{{ user.user.name }}</h6>
                  <span>{{ user.job_title }}</span>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <router-link class="dropdown-item d-flex align-items-center" to="/profile">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                  </router-link>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <router-link class="dropdown-item d-flex align-items-center" to="/profile">
                    <i class="bi bi-gear"></i>
                    <span>Account Settings</span>
                  </router-link>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <router-link class="dropdown-item d-flex align-items-center" to="#">
                    <i class="bi bi-question-circle"></i>
                    <span>Need Help?</span>
                  </router-link>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <button @click="user_store.signOut" class="dropdown-item d-flex align-items-center" >
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                  </button>
                </li>

              </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

            </div>

          </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
</template>


<script>
    import { useAuthStore } from '../stores/authStore';

    export default {
        name: "Header",
        components: {

        },

        data() {
            return {
                user_store: useAuthStore(),
                user: JSON.parse(localStorage.getItem('user')),
                firstName: ""
            }
        },

        props: [
            "toggleSideMenu"
        ],

        mounted(){
            this.splitName();
        },

        methods: {
            splitName(){
                const name = this.user?.user.name;
                this.firstName = name?.split(" ");
                console.log(this.firstName)
            },
        },

        computed: {
          isLogin() {

              return this.$route.name == "Login";
          }

      }
    }

</script>

<style scoped>

</style>