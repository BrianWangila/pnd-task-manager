<template>
    <main>
    <div class="heading">
        <div style="min-height: 8.5vh;">
        
        <h2 style="font-size: 30px; font-weight: 600;" v-if="user.role == 'admin'"><span style="font-size: 25px; font-weight: 500;">{{ dashboard_title }} </span> {{ user.role }}</h2>
        <h2 style="font-size: 30px; font-weight: 600;" v-else><span style="font-size: 25px; font-weight: 500;">{{ dashboard_title }} </span> {{ firstName }}</h2>
        
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
                <div class="progress progress1 mt-3" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: 30+'%'}"></div>
                    <!-- <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                    <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div> -->
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
                    <p>Creatives & Digital</p>
                    <AdminDonut2 class="d-1"/>
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
                <h4 style="text-align: center; font-size: 20px;">Overdue Deadlines</h4>
                <div class="table-editor" id="table_1" data-entries="5" data-entries-options="[5, 10, 15]">
                    <MDBTable class="table" hover borderless>
                        <thead>
                            <tr style="font-weight: bolder;">
                                <th>Overdue</th>
                                <th>Task</th>
                                <th>Deadline</th>
                                <th>Employee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in overdue" :key="task.id">
                                <div>
                                    <td style="color: #FFA500;">{{ this.date.getDate() - new Date(task.deadline).getDate() }} Days</td>
                                </div>
                                <td>{{ task.task_title }}</td>
                                <td>{{ formatDate(task.deadline) }}</td>
                                <td>{{ (task.name).split(" ")[0] }}</td>
                            </tr>
                        </tbody>
                    </MDBTable>
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
            <div>
                <MDBTable class="table" hover borderless responsive="true">
                    <thead>
                        <tr style="font-weight: bolder;">
                            <th>Employee</th>
                            <th>Task</th>
                            <th>Deadline</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in upcoming" :key="task.id">
                            <td>{{ task.employee.name.split(" ")[0] }}</td>
                            <td>{{ task.task_title }}</td>
                            <td>{{ formatDate(task.deadline) }}</td>
                            <td>
                                <div class="progress mt-1" :title="task.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div v-if="task.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: task.progress+'%'}"></div> 
                                    <div v-else-if="task.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: task.progress+'%'}"></div>
                                    <div v-else-if="task.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: task.progress+'%'}"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </MDBTable>
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
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';
    import WorkLoad from './charts/WorkLoad.vue';
    import axiosClient from '../axios';

  
    export default {

        components: {
            Calendar,
            DatePicker,
            AdminDonut, AdminDonut1, AdminDonut2, AdminDonut3, AdminDonut4,
            Ongoing,
            WorkLoad,
            MDBTable, MDBBtn, MDBBadge,
        },
        
        data() {
            return {
                date: new Date(),
                time: null,
                user: JSON.parse(localStorage.getItem('user')),
                dashboard_title: "",
                firstName: "",
                // taskStore: useTaskStore(),
                overdue: [],
                upcoming: []
            };
        },

        mounted(){

            this.greeting();
            this.splitName();
            this.overdueTasks();
            this.upcomingTasks();
        }, 


        methods: {
            greeting(){

                const today = new Date()
                let time = today.getHours()

                if(time > 1 && time < 12) {

                    this.dashboard_title = "Good morning,";       
                }
                else if (time >= 12 && time < 16) {
                
                    this.dashboard_title = "Good afternoon,";
                }
                else {

                    this.dashboard_title = "Good evening,";
                }
            },

            splitName(){
                const name = this.user.user.name;
                this.firstName = name.split(" ")[0];
            },


            async overdueTasks(){

                await axiosClient.get('/overdue')

                .then(res => {
                    this.overdue = res.data.slice(0, 3).reverse();
                    
                    console.log(this.overdue);
                })
                
            },

            async upcomingTasks(){
                
                await axiosClient.get('/tasks')
                .then(res => {
                    const tasks = res.data;

                    this.upcoming = tasks.filter(task => task.deadline > this.formatDateOnly(this.date));

                    console.log(this.upcoming);
                })
            },


            formatDate(date) {
                const options = { month: 'short', day: 'numeric', year: 'numeric' };
                return new Date(date).toLocaleDateString('en-US', options);
            },


            formatDateOnly(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            }

        },
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
    background-color: #d9d9d9b3;
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

  .progress1 {
    width: 52vw;
    margin: auto;
  }


  .donut {
    position: inherit;
    margin-top: 20px;
    width: 12vw;
    display: flex;
    padding-left: 50px;
  }

  .donut .d-1 {
    position: inherit;
    margin-right: 9vw;
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

  .projects th {
    background-color: #d9d9d9b3;
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
    left: 1.8vw;
    margin-right: 20px;
  }

  .head {
    position: relative;
    height: 17.5vh;
    color: #2F5508;
    width: 8vw;
    top: 20px;
    left: 1.8vw;
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


  .projects ul {
    list-style: none;
  }

</style>