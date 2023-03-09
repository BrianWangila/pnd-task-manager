<template>
  <main>
    <div class="heading">
      <div>
        <h2 v-if="time > 1 && time < 12" style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good morning,</span>  {{ user.name }}</h2>
        <!-- <h2 v-else-if="time > 12 && time < 16" style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good afternoon,</span>   {{ user_store.user.name }}</h2> --> 
        <!-- <h2 v-else style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">Good Evening,</span>  {{ user_store.user.name }}</h2> -->


        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Dashboard</span></P>
      </div>

      <div>
        <div className="btn-group">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-calendar"></i> Today
          </button>
          <ul className="dropdown-menu" >
            <li><DatePicker v-model="date" /></li>
          </ul>
        </div>

        <div className="btn-group" style="margin-left: 20px;">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-funnel"></i> Filter
          </button>
          <ul className="dropdown-menu" >
            <li><a class="dropdown-item" href="#">Upcoming</a></li>
            <li><a class="dropdown-item" href="#">Overdue</a></li>
            <li><a class="dropdown-item" href="#">Ongoing</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="content">
      <div style="display: flex; margin-right: 2vw;">
        <div class="departs">
          <div class="progress">
            <div class="inprogress"></div>
          </div>
          <div class="donut">
            <div class="donut-n">
              <p>Soft Dev</p>
              <AdminDonut class="d-1"/>
            </div>
            <div class="donut-n">
              <p>Web Design</p>
              <AdminDonut4 class="d-1" />
            </div>
            <div class="donut-n">
              <p>Creatives</p>
              <AdminDonut2 class="d-1"/>
            </div>
            <div class="donut-n">
              <p>Digital</p>
              <AdminDonut3 class="d-1"/>
            </div>
            <div class="donut-n">
              <p>BD & Strategy</p>
              <AdminDonut1 class="d-1"/>
            </div>
            
            
          </div>
        </div>
        <div class="head">
          <p style="text-align: left;">Project</p>
          <p>Stats</p>
          <div style="display: flex; justify-content: center;"><i style="transform: rotate(-30deg);" class="bi bi-flag-fill"></i><p style="margin-left: 10px;">Per</p></div>
          <p>DEPARTMENT</p>
        </div>
      </div>

      <div class="projects">
        <div class="ongoing">
          <div>
            <h4 style="text-align: center; font-size: 20px;">Ongoing Projects</h4>
            <div class="area-chart">
              <Ongoing />
            </div>
          </div>
        </div>

        <div class="overdue">
          <h4 style="text-align: center; font-size: 20px;">Overdue Tasks</h4>
          <div class="overdue-content">
            <ul class="title-list">
              <li style="margin-right: 5px; margin-left: 5px;">Overdue</li>
              <li style="padding-left: 5vw; padding-right: 5vw; margin-right: 5px;">Task</li>
              <li style="padding-right: 2.5vw; margin-right: 5px;">Deadline</li>
              <li>Employee</li>
            </ul>
            <div>
              <ul class="content-list">
                <li style="font-weight: 500;color: #FFA500;">1 Day</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li>Kelvin</li>
              </ul>

              <ul class="content-list">
                <li style="font-weight: 500;color: #FFA500;">2 Days</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li>Amani</li>
              </ul>

              <ul class="content-list">
                <!-- <li class="red-dot" style="background-color: #bb8282;"></li> -->
                <li style="font-weight: 500;color: #E11111;">5 Days</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li>Joline</li>
              </ul>

              <ul class="content-list">
                <li class="red-dot"></li>
                <li style="font-weight: 500;color: #E11111;">10 Days</li>
                <li>Unga Shop admin</li>
                <li>15/02/2023</li>
                <li>Risper</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="projects" style="margin-top: 20px;">
        <div class="workload ">
          <h4 style="text-align: center; font-size: 20px;">Workload</h4>
          <WorkLoad class="area-chart"/>
        </div>

        <div class="deadlines">
          <h4 style="text-align: center; font-size: 20px;">Upcoming Tasks</h4>
          <div style="margin-top: 20px;">
            <ul class="title-list">
              <li style="margin-right: 5px; margin-left: 5px;">Employee</li>
              <li style="padding-left: 5vw; padding-right: 5vw; margin-right: 5px;">Task</li>
              <li style="padding-right: 2.5vw; margin-right: 5px;">Deadline</li>
              <li>Workload</li>
            </ul>
            <div>
              <ul class="content-list">
                <li style="font-weight: 500;">Victor</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li class="load"><li class="load2" style="width: 30px;"></li></li>
              </ul>

              <ul class="content-list">
                <li style="font-weight: 500;">Maingi</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li class="load"><li class="load2" style="width: 20px;"></li></li>
              </ul>

              <ul class="content-list">
                <li style="font-weight: 500;">Nancy</li>
                <li>Update admin dashboard</li>
                <li>15/02/2023</li>
                <li class="load"><li class="load2" style="width: 35px;"></li></li>
              </ul>

              <ul class="content-list">
                <li style="font-weight: 500;">Brian</li>
                <li>Unga Shop admin</li>
                <li>15/02/2023</li>
                <li class="load">
                  <li class="load2" style="width: 20px;"></li>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      
      <hr class="footer-divider">

      <footer>
        <p> &copy; Copyright <span style="color:#2F5508; font-weight: 600;">Peak&Dale</span>. All Rights Reserved <br/>
            Designed by <span style="color: #81BE41">Peak&Dale</span></p>
      </footer>
    </div>
  </main>
</template>


<script>
  import { Calendar, DatePicker } from 'v-calendar';
  import AdminDonut from './charts/donuts/AdminDonut.vue';
  import AdminDonut1 from './charts/donuts/AdminDonut1.vue';
  import AdminDonut2 from './charts/donuts/AdminDonut2.vue';
  import AdminDonut3 from './charts/donuts/AdminDonut3.vue';
  import AdminDonut4 from './charts/donuts/AdminDonut4.vue';
  import Ongoing from './charts/Ongoing.vue';
  import WorkLoad from './charts/WorkLoad.vue';
  import { useAuthStore } from '../stores/authStore';

  
  export default {
    components: {
      Calendar,
      DatePicker,
      AdminDonut, AdminDonut1, AdminDonut2, AdminDonut3, AdminDonut4,
      Ongoing,
      WorkLoad,
    },
    
    data() {
      return {
        date: new Date(),
        time: null,
        user_store: useAuthStore(),
        user: null
      };
    },

    mounted(){
      const today = new Date()
      this.time = today.getHours()
      this.user = this.user_store.user
      console.log(this.user)
      
    }
  }
</script>

<style scoped>

  main {
    position: absolute;
    top: 10.5vh;
    left: 13.6vw;
    width: 68.4vw;

  }

  .title-list {
    position: relative;
    text-align: left;
    display: flex;
    font-weight: 600;
  }

  .title-list li {
    background-color: rgba(217, 217, 217, 0.7);
    padding: 3px 5px;
  }

  .content-list {
    position: relative;
    margin-left: -20px;
    text-align: left;
    display: flex;
    justify-content: space-around;
    font-size: 15px;
  }

  .footer-divider {
    position: inherit;
    margin-top: 5vh;
  }

  footer p {
    text-align: center;
    color: #2F5508;
  }


  .load {
    width: 40px;
    height: 8px;
    border-radius: 15px;
    background-color: rgba(217, 217, 217, 0.4);
  }

  .load2 {
    position: absolute;
    left: 500px;
    height: 8px;
    border-radius: 15px;
    background-color: #81BE41;
  }

  .red-dot {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: #E11111;
    margin: 5px -45px;
  }

  .progress {
    height: 10px;
    width: 52vw;
    background-color: rgba(217, 217, 217, 0.4);
    margin: auto;
    margin-top: 10px;
    border-radius: 25px;
  }

  .donut {
    position: inherit;
    margin-top: 20px;
    width: 12vw;
    display: flex;
    padding-left: 20px;
  }

  .donut .d-1 {
    position: inherit;
    margin-right: 6vw;
    height: 11vh;
  }

  .donut-n p {
    margin-bottom: -5px;
    margin-top: -10px;
    margin-left: 20px;
    font-size: 15px;
  }

  .projects {
    display: flex;
    justify-content: center;
    margin: auto;
    margin-top: 4vh;
    width: 64vw;
    height: 30vh;
  }

  .projects .ongoing {
    background-color: #ffff;
    width: 32vw;
    margin-right: 1vw;
    padding: 2vh;
  }

  .projects .overdue {
    background-color: #ffff;
    width: 32vw;
    padding: 2vh;
  }

  .overdue > .overdue-content {
    margin-top: 2vh;

  }

  .projects .workload {
    background-color: #ffff;
    width: 32vw;
    margin-right: 1vw;
    padding: 2vh;
  }

  .projects .deadlines {
    background-color: #ffff;
    width: 32vw;
    padding: 2vh;
  }

  .inprogress {
    position: absolute;
    height: 10px;
    width: 20vw;
    background-color: #81BE41;
    border-radius: 25px;
  }

  .area-chart {
    margin-top: 1vh;
    height: 22vh;
  }

  .content {
    background-color: #d9d9d966;
    margin-top: 0.5vh;
    overflow-y: auto;
    height: 80.3vh;
  }

  .departs {
    position: relative;
    height: 17.5vh;
    background-color: white;
    width: 55vw;
    top: 20px;
    left: 2vw;
    margin-right: 20px;
  }

  /* .v-line {
    position: relative;
    height: 13vh;
    width: 3px;
    background-color: red;
    left: 8vw;
  } */

  .head {
    position: relative;
    height: 17.5vh;
    color: #2F5508;
    width: 8vw;
    top: 20px;
    left: 2vw;
    padding: 10px;
    text-align: center;
    font-weight: 500;
    background-color: rgba(129, 190, 65, 0.43);
  }

  .heading {
    padding-left: 2vw;
    padding-right: 3vw;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .btn-white {
    border: 1px solid #b0adad9d;
  }

  .btn-white:hover {
    background-color: rgba(221, 240, 210, 0.875);
    border: 1px solid rgb(183, 181, 181);
  }

  

  .btn-white i {
    margin-right: 10px;
  }
</style>