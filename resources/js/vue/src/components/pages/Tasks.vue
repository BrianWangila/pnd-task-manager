<template>
    <main>
      <div class="heading">
        <div>
          <h2 style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Tasks</h2>
          
          <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Tasks</span></P>
        </div>
        <div>
          <div className="btn-group">
            <button style="border: 1px solid lightgray;" type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-calendar"></i> Today
            </button>
            <ul className="dropdown-menu" >
              <li><DatePicker v-model="date" /></li>
            </ul>
          </div>
  
          <div className="btn-group" style="margin-left: 20px;">
            <button style="border: 1px solid lightgray;" type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
        <div class="add-project  ml-8 mt-3 mb-2 mr-8">
          <h4 class=" fw-bolder">Upcoming Deadlines</h4>
        </div>

        <div class="projects row" v-if="user.role == 'admin'">
          <div class="card"  style="width: 25rem;" v-for="task in taskStore.tasks" :key="task.id" >
            <div class="card-body">
              <div class="title">
                <router-link class="card-title" :to="`/tasks/${task.id}`">Front-end Development</router-link>
                <div
                    @mouseenter="toggle('display-action'+task.id)" 
                    @mouseleave="toggleOff('display-action'+task.id)" >

                  <i type="button" class="bi bi-three-dots"></i>
                  <div class="delete-edit" :id="'display-action'+task.id" style="display:none">
                    <i class="fas fa-edit mb-2" style="color: skyblue;" type="button"></i>
                    <i @click="taskStore.deleteTask(task.id)" class="fas fa-trash" style="color: darkorange;" type="button"></i>
                  </div>

                </div>
              </div>
              <p class="card-text mt-3 fw-bold">{{ task.task_title }}</p>
              <div>
                <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(task.deadline ).toDateString() }}</span>
              </div>
                <div class="progress mt-5" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar"  style="background-color:#81BE41; border-radius: 5px; width: 50%;"></div>
                </div>
            </div>
          </div>
        </div>

        <div class="projects row" v-else>
          <div class="card"  style="width: 25rem;" v-for="task in tasks" :key="task.id" >
            <div class="card-body">
              <div class="title">
                <router-link class="card-title" :to="`/tasks/${task.id}`">Front-end Development</router-link>
                <div
                    @mouseenter="toggle('display-action'+task.id)" 
                    @mouseleave="toggleOff('display-action'+task.id)" >

                  <i type="button" class="bi bi-three-dots"></i>
                  <div class="delete-edit" :id="'display-action'+task.id" style="display:none">
                    <i class="fas fa-edit mb-2" style="color: skyblue;" type="button"></i>
                    <i @click="taskStore.deleteTask(task.id)" class="fas fa-trash" style="color: darkorange;" type="button"></i>
                  </div>

                </div>
              </div>
              <p class="card-text mt-3 fw-bold">{{ task.task_title }}</p>
              <div>
                <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(task.deadline ).toDateString() }}</span>
              </div>
                <div class="progress mt-5" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar"  style="background-color:#81BE41; border-radius: 5px; width: 50%;"></div>
                </div>
            </div>
          </div>
        </div>
  
        <div class="divider">
          <hr class="footer-divider">
  
          <footer>
            <p> &copy; Copyright <span style="color:#2F5508; font-weight: 600;">Peak&Dale</span>. All Rights Reserved <br/>
                Designed by <span style="color: #81BE41">Peak&Dale</span></p>
          </footer>
        </div>
   
      </div>
    </main>
  </template>
  
  <script>
    import { Calendar, DatePicker } from 'v-calendar';
    import { useTaskStore } from '../../stores/taskStore';
    import axiosClient from '../../axios';
  
  
  export default {
    components: {
      Calendar,
      DatePicker,
  
    },
    
    data() {
        var userData = JSON.parse(localStorage.getItem('user'))

        return {
            user: userData,
            date: new Date(),
            time: null,
            taskStore: useTaskStore(),
            isOpen: false,
            tasks: []
        };
    },
  
    mounted(){
      const today = new Date()
      this.time = today.getHours()
      this.taskStore.getTasks()
      this.getEmployeeTasks(this.user.id)
  
    },
  
    methods: {

        async getEmployeeTasks(id){
            try {
                await axiosClient.get("/employees/"+id)

                .then((res) => {
                    this.tasks = res.data.tasks
                    console.log(this.tasks)
                })

            } catch (error) {
                console.log(error)
            }


        },
      
        toggle(id) {
            var id = id;
            var id_name  = $('#'+id).attr('id');
            if(id == id_name){
                $('#'+id).css('display', 'block') 
            } 
        },
        
        toggleOff(id) {
            var id = id;
            var id_name  = $('#'+id).attr('id');
            if(id == id_name){
                $('#'+id).css('display', 'none') 
            } 
        },
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
  
    .delete-edit {
      position: absolute;
      left: 18vw;
      display: flex;
      flex-direction: column;
    }

    .delete-edit i {
      margin: 1px 3px;
      font-size: 17px;
      padding: 2px 5px;
    }

    .delete-edit i:hover {
      font-size: 25px;
    }
    .heading {
      padding-left: 2vw;
      padding-right: 3vw;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  
    .content {
      background-color: #d9d9d966;
      margin-top: 0.5vh;
      overflow-y: auto;
      height: 80.3vh;
    }
  
    .projects {
      flex:1; 
      margin-left: 25px;
      /* display: flex;
      flex-direction: row; */
    }
  
    .footer-divider {
      position: inherit;
      margin-top: 5vh;
    }
  
    footer p {
      text-align: center;
      color: #2F5508;
    }
  
    .card-body .title {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  
    .card-title {
      background-color: rgba(255, 165, 0, 0.12);
      color: #FFA500;
      padding: 10px;
      border-radius: 15px;
      font-weight: 600;
    }
  
    .add-project {
      display: flex;
      justify-content:space-between ;
      align-items: center;
    }
  
    .add-project button {
      color: #2F5508;
      border: 1px solid lightgrey;
      padding: 0.5rem;
      border-radius: 5px;
      font-weight: 600;
    }
  
    .btn2 {
      border: 1px solid #81BE41;
    }
  
  
  </style>