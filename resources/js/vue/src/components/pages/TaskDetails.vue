<template>
  <main>
      <div class="heading">
          <div>
              <h2 style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Briefs/Projects</h2>
              
              <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Projects</span></P>
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
          <div class="ml-8 mt-3 pb-3 p-3 mr-8 bg-white">
              <div class="add-project ">
                  <h4 class=" fw-bolder">{{ taskItem.task_title }} <span style="font-weight: 500; font-size: 20px;">()</span></h4>
                  <div>
                      <router-link to="/tasks"  style="color: black; font-weight: 500;"><button class="mr-3"><i class="bi bi-arrow-left-short"></i> Back to Tasks</button></router-link>
                      <button v-if="user.role != 'admin'"><span class="mr-1" data-bs-toggle="modal" data-bs-target="#subTaskForm" >Create Milestones</span><i class="bi bi-pencil-square"></i></button>
                  </div>
              </div>

              <!-- project update pop-up form -->
              <div class="modal fade" id="subTaskForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title text-dark" id="ModalLabel">Create Milestones/Subtasks for Tracking</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label  class="form-label">Title</label>
                                <input type="text" class="form-control" v-model="dataInput.title"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description (<span class="fs-7">Optional</span>)</label>
                                <textarea type="text" rows="5" class="form-control" v-model="dataInput.description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Due Date/Time</label>
                                <VueDatePicker style="width: 15rem;" v-model="dataInput.dueDate" :min-date="new Date()"  />
                            </div>
                            <button type="submit" class="btn btn2" data-bs-dismiss="modal">Submit</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="task-detail-content">
                <div class="pl-5 pt-3 h-300">
                  <div class="priority mb-2">
                      <p class="mr-10" style="font-weight: 600;">Project Title:</p> 
                      <p class="fw-bold" style=" color: black;">{{ project.project_title}}</p>

                  </div>
                  <div class="assigned mb-2">
                      <p style="margin-right: 30px; font-weight: 600;">Status:</p>
                      <ul>
                          <li>{{ taskItem.status }}</li>
                      </ul>

                  </div>
                  <div class="deadline mb-2">
                      <p style="margin-right: 4rem; font-weight: 600;">Deadline:</p> <p>{{ new Date(taskItem.deadline).toDateString() }}</p>
                  </div>
                  <div class="tags">
                      <p  style="margin-right: 3.7rem; font-weight: 600;">Tags:</p>
                      <ul>
                          <li style="background-color: rgba(255, 165, 0, 0.2); margin-right: 1rem;">UI Design</li>
                          <li style="background-color: rgba(128, 0, 128, 0.2); margin-right: 1rem;">Marketing</li>
                          <li style="background-color: rgba(165, 42, 42, 0.2);">Development</li>
                      </ul>
                  </div>
                </div>
                <div class="task-content-description">
                    <!-- <p class="fw-bold"><center>Description</center></p> -->
                    <p>{{ taskItem.description }}</p>
                </div>
              </div>
              
          </div>



          <div class="ml-8 mt-3 pb-3 p-3 mr-8 bg-white subtask-body">
              <div class="subtasks">
                  <div class="task-title d-flex">
                      <h4 class="fs-5 fw-bold">These are your sub-tasks</h4>
                      <div class="subtask-count">
                        <div>{{ subTaskStore.subTasks.length }} </div>
                        <div class="partition">
                            <div class="v-line"></div>
                            <button class="fs-6 mr-1" title="Create a subtask" data-bs-toggle="modal" data-bs-target="#subTaskForm">+</button>
                        </div>
                    </div>
                  </div>

                  <div class="task-content">
                    <div>
                        <MDBTable hover class="align-middle bg-white task-table">
                            <thead class="bg-light bg-red">
                                <tr>
                                    <th class="fw-bold"></th>
                                    <th class="fw-bold">Task</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Due Date</th>
                                    <th class="fw-bold"></th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr class="table-row" v-for="subTask in subTaskStore.subTasks" :key="subTask.id">
                                    <td style="width: 5rem;">
                                        <MDBBadge badge="info" class="d-inline">{{ subTask.status }}</MDBBadge>
                                    </td>
                                    <td class="table-title">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="mb-1" style="font-weight: 500;">{{ subTask.title }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-desc">
                                        <span class="fw-normal">{{ subTask.description }}</span>
                                    </td>
                                    <td class="table-due">{{ new Date(subTask.dueDate).toDateString() }}</td>
                                    <td class="subtask-dots" v-if="user.role != 'admin'">
                                        <MDBBtn pill size="sm" @click="showMenu = !showMenu"><i class="bi bi-three-dots"></i></MDBBtn>
                                        <div v-if="showMenu" class="actions">
                                            <ul>
                                                <li><a href="#">Edit</a></li>
                                                <li><a href="#">Delete</a></li>
                                                <li><a href="#">Share</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </MDBTable>
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
    import { useProjectStore } from '../../stores/projectStore';
    import { useTaskStore } from '../../stores/taskStore';
    import { useSubTaskStore } from '../../stores/subTaskStore';
    import { useEmployeeStore } from '../../stores/employeeStore';
    import { useDepartmentStore } from '../../stores/departmentStore';
    import axiosClient from '../../axios';
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';


    export default {
        components: {
        Calendar,
        DatePicker,
        MDBTable,
        MDBBtn,
        MDBBadge

        },
        
        data() {
            var userData = JSON.parse(localStorage.getItem('user'))
            return {
                date: new Date(),
                user: userData,
                projectStore: useProjectStore(),
                taskStore: useTaskStore(),
                subTaskStore: useSubTaskStore(),
                employeeStore: useEmployeeStore(),
                departmentStore: useDepartmentStore(),
                dptEmployee: [],
                taskItem: "",
                project: "",
                dataInput: {
                    title: "",
                    taskId: "",
                    dueDate: "",
                    description: "",
                },
                dptName: "",
                countTask: "",
                showMenu: false

            };
        },
        mounted(){

            var id = this.$route.params.id;
            this.singleTask(id)
            this.departmentStore.getDepartments()
            this.subTaskStore.getTasks()
        },

        methods: {

            async singleTask(id){
                try {
                    await axiosClient.get("/tasks/"+id)
                    .then((res) => {
                        this.taskItem = res.data
                        this.project = this.taskItem.project

                        console.log(this.taskItem )

                        // const taskCount = this.taskItem.tasks.length
                        // if(taskCount == 1){
                        //     return this.countTask = `${ taskCount } task`
                        //     } else if  (taskCount > 1){
                        //         return this.countTask = `${ taskCount } tasks`
                        //     } else {
                        //         return this.countTask = "No tasks"
                        //     }
                        
                        })
                        
                        // axiosClient.get("/employees/department/"+this.taskItem.department_id)
                        // .then((res) => {
                        //     this.dptEmployee = res.data
                        //     console.log(this.dptEmployee)
                        // })
                    
                } catch (error) {
                    console.log(error)
                }
            },

            submitForm(){
                // axiosClient.put("/subTasks/"+this.dataInput.id, this.dataInput, {headers: {"Content-Type":"application/json"}})

                this.dataInput.taskId = this.taskItem.id;

                this.subTaskStore.addSubTask(this.dataInput)

                this.dataInput = {
                    title: "",
                    taskId: "",
                    dueDate: "",
                    description: "",
                }

                this.subTaskStore.getTasks()
            },

            editProject(taskItem){
                console.log(taskItem)
                this.dataInput = taskItem

            },

            onSelectFile(event){
                const file = event.target.files[0];
                this.dataInput.file = file;
                
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

    .priority, 
    .assigned, 
    .tags, 
    .deadline, 
    .assigned ul,
    .tags ul {
        display: flex;
        align-items: center;
        list-style: none;
    }

    .tags li{
        border-radius: 5px;
        padding: 4px 20px;
    }

    .assigned li {
        background-color: rgba(217, 217, 217, 0.5);
        border-radius: 20px;
        padding: 4px 20px;
        margin-right: 1rem;
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

    .btn2 {
        border: 1px solid #81BE41;
    }

    .footer-divider {
        position: inherit;
    }

    footer p {
        text-align: center;
        color: #2F5508;
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

    .task-detail-content {
        display: flex;
        align-items: center;
    }

    .task-detail-content .task-content-description {
        border: 1px solid rgba(211, 211, 211, 0.479);
        height: 12rem;
        margin-left: 50px;
        padding: 20px;
        border-radius: 10px;
        width: 35rem;
    }

    .task-content .subtask-dots {
        /* position: relative;
        left: 100px; */
        width: 30px;
        visibility: hidden;
    }

    .table-row:hover .subtask-dots {
        visibility: visible;
    }

    .table-row .table-title{
        width: 20rem;
    }

    .table-row .table-desc{
        width: 25rem;
    }

    .table-row .table-due{
        width: 8.5rem;
    }

    .task-content .actions{
        position: absolute;
        border: 1px solid lightgray;
        border-radius: 5px;
        background-color: white;
        right: 70px;
        width: 100px;
        height: 100px;
        margin-top: 10px;
        padding: 10px 0;
    }

    .subtask-body {
        overflow-y: scroll;
        height: 37vh;
    }

    .subtask-count {
        border: 1px solid lightgray;
        padding: 3px;
        width: 50px;
        margin-left: 10px;
        text-align: center;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .subtask-count .partition {
        display: flex;
        align-items: center;
        
    }

    .subtask-count .v-line {
        width: 1px;
        height: 15px;
        background-color: lightgray;
        margin-right: 7px;
    }

</style>