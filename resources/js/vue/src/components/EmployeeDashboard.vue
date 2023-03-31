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
                            <h5>TO-DO LIST</h5>
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
                                <button><i class="bi bi-plus-lg mr-2"></i>CREATE A TO-DO</button>
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
                                </div>

                                <div class="team-tasks">
                                    <p>Team Tasks</p>
                                </div>
                            </div>

                            <div class="team-members">
                                <div class="team">
                                    <p class="fw-bold"><i class="bi bi-microsoft-teams mr-2 "></i>My team</p>
                                    <p>Team Members</p>
                                    <div class="team-profiles">
                                        <img src="../assets/images/avatar.png" alt="team">
                                        <img src="../assets/images/avatar.png" alt="team">
                                        <img src="../assets/images/avatar.png" alt="team">
                                    </div>
                                </div>

                                <div class="completion-rate">
                                    <p>Project Completion Rate</p>
                                </div>

                                <div class="go-to-team">
                                    <p>Go to <span style="color: #2F5508; font-weight: 600; cursor:pointer ;">My Team</span><i class="bi bi-arrow-right ml-2"></i></p>
                                </div>
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

  
    export default {

        components: {
            Calendar,
            DatePicker,
        },
        
        data() {
            return {
                date: new Date(),
                time: null,
                user: JSON.parse(localStorage.getItem('user')),
                dashboard_title: "",
                firstName: ""
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
    border: 1px solid rgba(129, 190, 65, 0.43);
    background-color: white;
    padding: 10px 15px;
    border-radius: 10px;
    margin-top: 10px;
    font-size: 15px;
    font-weight: 500;
    color: black;

  }


  .to-do-list .to-do-btn button:hover {
    background-color: rgba(130, 190, 65, 0.082);
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


  .dash-top-right .team-members .completion-rate {
    border: 1px solid #d9d9d966;
    margin-top: 25px;
    height: 120px;
    padding: 10px;
    width: 200px;
  }


  .dash-top-right .team-members .go-to-team {
    margin-top: 20px;
    margin-bottom: -20px;
  }


</style>