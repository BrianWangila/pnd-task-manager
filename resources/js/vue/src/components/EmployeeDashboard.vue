<template>
    <main>
        <div class="heading">
            <div style="min-height: 8.5vh;">
            
                <h2 style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;">{{ dashboard_title }} </span> {{ firstName[0] }}</h2>
                
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
            <div class="dashboard">
                <div class="dashboard-top">
                    <div class="dash-top-left">
                        <div class="title">
                            <h5>TODO List</h5>
                        </div>

                        <div class="to-do-list">
                            <div>
                                <img src="../assets/images/to-do-image.png" alt="to-do-image" >
                            </div>

                            <div style="width: 200px; margin-top: 10px; color: black;">
                                <p>You have nothing planned out at the moment</p>
                                <p>You can create a to-do list below</p>
                            </div>

                            <div class="to-do-btn">
                                <button data-bs-toggle="modal" data-bs-target="#addTodoForm"><i class="bi bi-plus-lg mr-2" ></i>CREATE A TO-DO</button>
                            </div>

                            <!-- popup todo form  -->
                            <div class="modal fade" id="addTodoForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="ModalLabel">Add a ToDo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label class="form-label">To-do Task</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Date / Time</label>
                                                    <VueDatePicker :min-date="new Date()" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Reminder</label>
                                                    <input type="" class="form-control" />
                                                </div>
                                                <button type="submit" class="btn btn2" data-bs-dismiss="modal">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="dash-top-right">
                        <div class="title">
                            <h5>Task Summary</h5>
                        </div>

                        <div class="summary-content">
                            <div class="tasks">
                                <div class="my-tasks mb-3">
                                    <p>My Tasks</p>
                                    <div class="tasks-stats">
                                        <div style="margin-top: -15px;"><CompletionRate/></div>
                                        <div>
                                            <div class="contents">
                                                <p class="stats-dot"></p>
                                                <p>KCA December Report KCA December Report </p>
                                            </div>
                                            <div class="contents">
                                                <p class="stats-dot" style="background-color: orange;"></p> 
                                                <p>KCA December Report</p>
                                            </div>
                                            <div class="contents">
                                                <p class="stats-dot" style="background-color: orangered;"></p> 
                                                <p>KCA December Report</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="team-tasks">
                                    <p>Team Tasks</p>
                                    <div class="tasks-stats">
                                        <div style="margin-top: -15px;"><CompletionRate/></div>
                                        <div>
                                            <div class="contents">
                                                <p class="stats-dot"></p>
                                                <p>KCA December Report KCA December Report</p>
                                            </div>
                                            <div class="contents">
                                                <p class="stats-dot" style="background-color: orange;"></p> 
                                                <p>KCA December Report</p>
                                            </div>
                                            <div class="contents">
                                                <p class="stats-dot" style="background-color: orangered;"></p> 
                                                <p>KCA December Report</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="team-members">
                                <div class="team">
                                    <p class="fw-bold"> <i class="bi bi-microsoft-teams mr-2 "></i>My team</p>
                                    <p>Team Members</p>
                                    <div class="team-profiles">
                                        <div class="profile">
                                            <img src="../assets/images/avatar.png" alt="team" style="position: relative; top: 0; left: 0">
                                            <img src="../assets/images/avatar.png" alt="team" style="position: relative; top: 0; left: -20px; ">
                                            <img src="../assets/images/avatar.png" alt="team" style="position: relative; top: 0; left: -40px; ">
                                            <div class="toggle-profiles" @click="showAll = !showAll" style="position: relative; top: 0; left: -60px; ">
                                                <i :class="showAll ? 'bi bi-dash' : 'bi bi-plus'"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="completion-rate">
                                    <p>Project Completion Rate</p>
                                    <!-- <CompletionRate class=""/> -->
                                </div>

                                <div class="go-to-team">
                                    <p>Go to <router-link style="color: #2F5508; font-weight: 600; cursor:pointer ;" to="/teams">My Team <i class="bi bi-arrow-right ml-2"></i></router-link></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-bottom">
                    <div>
                        <div class="tasks-card-title">
                            <h5>Active Tasks</h5>
                            <p type="button" style="font-size: 15px;">See All Tasks <i class="bi bi-chevron-right"></i></p>
                        </div>
                        <div class="tasks-card">
                            <div class="play"><i class="bi bi-play-circle-fill ml-2"></i></div>
                            <div class="assigned">
                                <h5>Assigned</h5>
                                <div class="assigned-time">
                                    <i class="bi bi-calendar3 mr-3"></i>
                                    <div>
                                        <div id="date">17/02/2023</div>
                                        <div id="date">10.30 a.m</div>
                                    </div>
                                </div>
                            </div>
                            <div class="task-title">
                                <h5>Create a database for XYZ</h5>
                                <div style="font-size: 10px;">
                                    <i class="bi bi-paperclip"></i> <span>4</span> Files
                                    <i class="bi bi-list-task ml-2"></i> <span>4</span> Subtasks 
                                </div>
                            </div>
                            <div>
                                <h5>25% Complete</h5>
                                <div class="progress" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar"  style="background-color: orange; border-radius: 5px; width: 25%;"></div>
                                </div>
                            </div>
                            <div>
                                <button><i class="bi bi-alarm mr-2"></i> Reminder</button>

                            </div>
                        </div>

                        <div class="tasks-card">
                            <div class="play"><i class="bi bi-play-circle-fill ml-2"></i></div>
                            <div class="assigned">
                                <h5>Assigned</h5>
                                <div class="assigned-time">
                                    <i class="bi bi-calendar3 mr-3"></i>
                                    <div>
                                        <div id="date">17/02/2023</div>
                                        <div id="date">10.30 a.m</div>
                                    </div>
                                </div>
                            </div>
                            <div class="task-title">
                                <h5>Create a database for XYZ</h5>
                                <div style="font-size: 10px;">
                                    <i class="bi bi-paperclip"></i> <span>4</span> Files
                                    <i class="bi bi-list-task ml-2"></i> <span>4</span> Subtasks 
                                </div>
                            </div>
                            <div>
                                <h5>50% Complete</h5>
                                <div class="progress" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar"  style="background-color: darkorange; border-radius: 5px; width: 50%;"></div>
                                </div>
                            </div>
                            <div>
                                <button><i class="bi bi-alarm mr-2"></i> Reminder</button>

                            </div>
                        </div>

                        <div class="tasks-card">
                            <div class="play"><i class="bi bi-play-circle-fill ml-2"></i></div>
                            <div class="assigned">
                                <h5>Assigned</h5>
                                <div class="assigned-time">
                                    <i class="bi bi-calendar3 mr-3"></i>
                                    <div>
                                        <div id="date">17/02/2023</div>
                                        <div id="date">10.30 a.m</div>
                                    </div>
                                </div>
                            </div>
                            <div class="task-title">
                                <h5>Create a database for XYZ</h5>
                                <div style="font-size: 10px;">
                                    <i class="bi bi-paperclip"></i> <span>4</span> Files
                                    <i class="bi bi-list-task ml-2"></i> <span>4</span> Subtasks 
                                </div>
                            </div>
                            <div>
                                <h5>75% Complete</h5>
                                <div class="progress" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar"  style="background-color:#81BE41; border-radius: 5px; width: 75%;"></div>
                                </div>
                            </div>
                            <div>
                                <button><i class="bi bi-alarm mr-2"></i> Reminder</button>

                            </div>
                        </div>
                    </div>
                    <div class="top-priority-card">
                        <div class="red-dot">
                            <h5>Top-priority Tasks</h5> 
                            <div class="top-priority-dot"></div>
                        </div>
                        <div class="top-priority">
                            <div class="top-priority-dets">
                                <div class="priority-title">Organize KCA Meeting</div>
                                <div class="priority-due">Thur March 2023</div>
                            </div>
                            <div class="top-priority-dets">
                                <div class="priority-title">Organize KCA Meeting</div>
                                <div class="priority-due">Thur March 2023</div>
                            </div>
                            <div class="top-priority-dets">
                                <div class="priority-title">Organize KCA Meeting</div>
                                <div class="priority-due">Thur March 2023</div>
                            </div>
                            <div class="top-priority-dets">
                                <div class="priority-title">Organize KCA Meeting</div>
                                <div class="priority-due">Thur March 2023</div>
                            </div>
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
    import CompletionRate from './charts/donuts/CompletionRate.vue'

  
    export default {

        components: {
            Calendar,
            DatePicker,
            CompletionRate,
        },
        
        data() {
            return {
                date: new Date(),
                time: null,
                user: JSON.parse(localStorage.getItem('user')),
                dashboard_title: "",
                firstName: "",
                showAll: false,
            };
        },

        mounted(){

            this.greeting();
            this.splitName();
            
        }, 
        methods: {
            greeting(){

                const today = new Date()
                let time = today.getHours()

                if(time > 1 && time < 12) {

                    this.dashboard_title = "Good morning,";       
                } else if (time >= 12 && time < 16) {
                
                    this.dashboard_title = "Good afternoon,";
                } else {

                    this.dashboard_title = "Good evening,";
                }
            },

            splitName(){
                const name = this.user.user.name;
                this.firstName = name.split(" ");
                console.log(this.firstName)
            },

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

  .footer-divider {
    position: inherit;
    margin-top: 5vh;
  }

  footer p {
    text-align: center;
    color: #2F5508;
  }


  .content {
    background-color: #d9d9d966;
    margin-top: 0.5vh;
    overflow-y: auto;
    height: 80.3vh;
  }

  .content .dashboard {
      padding: 1.5rem 4rem;
  }

  .content .dashboard h5 {
      font-size: 15px;
      font-weight: 600;
  }

  .heading {
    padding-left: 2vw;
    padding-right: 3vw;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .dashboard-top {
    display: flex;
    align-items: center;


  }

  .dashboard-top .dash-top-right {
    margin-left: 4rem;
  }

  .dashboard-top .summary-content {
    border: 1px solid #d9d9d966;
    background-color: white;
    padding: 20px;
    width: 800px;
    height: 380px;
    border-radius: 20px;
    display: flex;
    align-items: center;
  }


  .summary-content .tasks-stats {
    display: flex;
    /* align-items: center; */
    justify-content: space-between;
    padding: 1px 20px;
    /* border: solid red; */
  }

  .summary-content .tasks-stats .contents {
    display: flex;
    align-items: center;

  }

  .summary-content .tasks-stats .contents p {
    font-size: 10px;

  }

  .summary-content .tasks-stats .contents .stats-dot{
    background-color: rgba(129, 190, 65, 0.6);
    height: 10px;
    width: 10px;
    border-radius: 50%;
    margin-right: 10px;
    
  }

  .summary-content .tasks-stats .content {
    display: flex;
    align-items: center;
  }


  .summary-content .my-tasks, .summary-content .team-tasks {
    border: 1px solid #d9d9d966;
    background-color: white;
    height: 160px;
    padding: 10px;
    border-radius: 10px;
    width: 500px;

  }

  .dashboard .to-do-list {
    border: 1px solid #d9d9d966;
    background-color: white;
    width: 300px;
    height: 380px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background-color: rgba(129, 190, 65, 0.43);
    border-radius: 20px;

  }

  .dashboard .to-do-list img {
    margin-bottom: 20px;

  }

  .to-do-list .to-do-btn button {
    border: 1px solid rgba(130, 190, 65, 0.329);
    background-color: white;
    padding: 10px 15px;
    border-radius: 10px;
    margin-top: 10px;
    font-size: 15px;
    font-weight: 500;
    color: black;

  }


  .to-do-list .to-do-btn button:hover {
    background-color: #81BE41;
    font-weight: 700;
    color: white;

  }


  .dash-top-right .team-members {
    margin-left: 2rem;
    display: flex;
    flex-direction: column;
    text-align: center;

  }


  .dash-top-right .team-members .team-profiles {
    display: flex;
  }


  .dash-top-right .team-members .team-profiles .profile {
    display: flex;
    justify-content: center;
    margin-left: 20px;
  }

  .dash-top-right .team-members .team {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
  }


  .dash-top-right .team-members .team-profiles img {
    height: 50px;
    width: 50px;
  }

  .dash-top-right .team-members .team-profiles .toggle-profiles {
    /* border: 1px solid red; */
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background-color: rgb(37, 37, 37);
    position: relative;
  }

  .dash-top-right .team-members .team-profiles .toggle-profiles i {
    color: white;
    font-weight: 700;
    font-size: 30px;

  }


  .dash-top-right .team-members .completion-rate {
    border: 1px solid #d9d9d966;
    margin-top: 25px;
    height: 120px;
    padding: 10px;
    width: 200px;
    border-radius: 10px;
  }


  .dash-top-right .team-members .go-to-team {
    margin-top: 20px;
    margin-bottom: -20px;
  }

  .dashboard-bottom {
    margin-top: 20px;
    margin-bottom: -70px;
    display: flex;
    /* align-items: center; */
  }


  .dashboard-bottom .top-priority-card {
    margin-top: 10px;
  }


  .dashboard-bottom .tasks-card {
    display: flex;
    align-items: center;
    background-color: white;
    padding: 10px 20px;
    border-radius: 20px;
    justify-content: space-between;
    width: 760px;
    margin-bottom: 10px;
    margin-right: 40px;
    
  }

  .dashboard-bottom .tasks-card-title {
    display: flex;
    width: 760px;
    justify-content: space-between;
    align-items: center;

  }

  .dashboard-bottom .assigned .assigned-time {
    display: flex;
    align-items: center;
  }


  .dashboard-bottom .tasks-card .play {
    font-size: 30px;
    color: #2F5508;
  }

  .dashboard-bottom .tasks-card #date {
    font-size: 10px;
  }


  .dashboard-bottom button {
    background-color: #5ca70b1a;
    color: #81BE41;
    padding: 5px 8px;
    border-radius: 5px;
    font-weight: bold;
  }

  .dashboard-bottom button:hover {
    background-color: #5ca70b9f;
    color: white;
  }

  .dashboard-bottom .top-priority-dot {
    height: 5px;
    width: 5px;
    border-radius: 50%;
    background-color: orangered;
  }

  .dashboard-bottom .top-priority {
    height: 250px;
    padding: 30px 20px 10px;
    background-color: white;
    border-radius: 20px;
    width: 360px;
    overflow-y: auto;
  }


  .dashboard-bottom .top-priority-dets {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
  }


  .dashboard-bottom .top-priority-dets .priority-title {
    background-color: #ff00001c;
    padding: 3px 10px;
    border-radius: 5px;
    color: #920c0c83;
    cursor: pointer;
  }

  .dashboard-bottom .top-priority-dets .priority-due {
    color: #300d0d85;
    padding: 3px ;

  }


  .top-priority-card .red-dot {
    display: flex;
    margin-bottom: 6px;
  }












</style>