<template>
  <main>
      <div class="heading">
          <div>
              <h2 style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>Active Project</h2>
              
              <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Projects / {{ projectItem.project_title }}</span></P>
          </div>
          <!-- <div>
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
          </div> -->
      </div>

      <div class="content">
          <div class="ml-8 mt-3 pb-3 p-3 mr-8 bg-white">
              <div class="add-project ">
                  <h4 class=" fw-bolder">{{ projectItem.project_title }} <span style="font-weight: 500; font-size: 20px;">({{ countTask }})</span></h4>
                  <div>
                      <router-link to="/projects"  style="color: black; font-weight: 500;"><button class="mr-3"><i class="bi bi-arrow-left-short"></i> Back to Projects</button></router-link>
                      <button  v-if="user.role == 'admin'"><span @click="editProject(projectItem)" class="mr-1" data-bs-toggle="modal" data-bs-target="#editProject" >Update Project</span>  <i class="bi bi-pencil-square"></i></button>
                  </div>
              </div>

              <!-- project update pop-up form -->
              <div class="modal fade" id="editProject" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title text-dark" id="ModalLabel">Update Project details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label class="form-label">Select Department</label>
                                <select class="form-select" v-model="dataInput.department_id">
                                    <option v-for="dpt in departmentStore.departments" :key="dpt.id" :value="dpt.id">{{ dpt.department_name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Project/Brief Title</label>
                                <input type="text" class="form-control" v-model="dataInput.project_title"/>
                                <div class="form-text">Write a short title of the project.</div>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Deadline</label>
                                <VueDatePicker v-model="dataInput.deadline" :min-date="new Date()" :enable-time-picker="false" />
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea type="text" rows="5" class="form-control" id="exampleInputPassword1" v-model="dataInput.description"></textarea>
                            </div>
                            <div class="mb-3">
                                  <label class="form-label">Priority</label>
                                  <select class="form-select" v-model="dataInput.priority">
                                      <option value="Normal">Normal</option>
                                      <option value="Urgent">Urgent</option>
                                  </select>
                              </div>
                            <button type="submit" class="btn btn2" data-bs-dismiss="modal">Save Changes</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                      </div>
                  </div>
                  </div>
              </div>

              <div class="pl-5 pt-3 h-300">
                  <div class="priority mb-2">
                      <p class="mr-20" style="font-weight: 600;">Priority:</p> 
                      <p v-if="projectItem.priority == 'Urgent'" class="priority-flag" style="background-color: orange"><i class="bi bi-flag pr-2"></i>{{ projectItem.priority }}</p>
                      <p v-else class="priority-flag"><i class="bi bi-flag pr-2" ></i>{{ projectItem.priority }}</p>

                  </div>
                  <div class="priority mb-2">
                      <p class="mr-12" style="font-weight: 600;">Department:</p> 
                      <p class="department">{{ dptName }}</p>

                  </div>
                  <div class="assigned mb-2">
                      <p style="margin-right: 30px; font-weight: 600;">Assignee:</p>
                      <ul v-if="assignees.length > 0" v-for="employee in assignees" :key="employee.id">
                          <li>{{ employee.user.name }}</li>
                          
                      </ul>
                      <ul v-else >
                          <li class="fw-bold">No one is assigned to this project</li>
                      </ul>

                  </div>
                  <div class="deadline mb-2">
                      <p style="margin-right: 4rem; font-weight: 600;">Deadline:</p> <p>{{ new Date(projectItem.deadline).toDateString() }}</p>
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
          </div>

          <div>
              <ProjectTasks v-if="dptEmployee.length > 0" :employee="dptEmployee" :user="user" style="position: inherit"/>
              <ProjectTasks v-else style="position: inherit"/>
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
    import { useEmployeeStore } from '../../stores/employeeStore';
    import { useDepartmentStore } from '../../stores/departmentStore';
    import axiosClient from '../../axios';
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';
    import ProjectTasks from './ProjectTasks.vue';


    export default {
        components: {
        ProjectTasks,
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
                employeeStore: useEmployeeStore(),
                departmentStore: useDepartmentStore(),
                dptEmployee: [],
                projectItem: "",
                dataInput: {
                    task_title: "",
                    department_id: "",
                    deadline: "",
                    description: "",
                    priority: "",
                },
                dptName: "",
                countTask: "",
                assignees: [],

            };
        },
        mounted(){

            var id = this.$route.params.id;
            this.singleProject(id)
            this.departmentStore.getDepartments()

        },

        methods: {

            async singleProject(id){
                try {
                    await axiosClient.get("/projects/"+id)
                    .then((res) => {
                        this.projectItem = res.data;
                        this.dptName = this.projectItem.department.department_name;
                        this.assignees = this.projectItem.assignees;

                        console.log(this.assignees );

                        const taskCount = this.projectItem.tasks.length;
                        if(taskCount == 1){
                            return this.countTask = `${ taskCount } task`;
                            } else if  (taskCount > 1){
                                return this.countTask = `${ taskCount } tasks`;
                            } else {
                                return this.countTask = "No tasks";
                            }
                        
                        })
                        
                        axiosClient.get("/employees/department/"+this.projectItem.department_id)
                        .then((res) => {
                            this.dptEmployee = res.data;
                            console.log(this.dptEmployee);
                        })
                    
                } catch (error) {
                    console.log(error)
                }
            },

            submitForm(){
                
                axiosClient.post("/projects/"+this.dataInput.id, this.dataInput, {headers: {"Content-Type":"multipart/form-data"}})  //edit
                // axiosClient.post("/projects/"+this.dataInput.id, this.dataInput, {headers: {"Content-Type":"application/json"}})  //edit

                this.dataInput = {
                    task_title: "",
                    department_id: "",
                    deadline: "",
                    description: "",
                    priority: "",
                }

                window.location.reload()

            },

            editProject(projectItem){
                console.log(projectItem)
                this.dataInput = projectItem

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

    
    .priority-flag {
        background: rgba(129, 190, 65, 0.7);
        font-weight: 500;
        padding: 3px 10px;
        color: white;
        border-radius: 4px;
    }

    .priority-flag-urgent{
        background: darkorange;
        font-weight: 500;
        padding: 3px 10px;
        color: white;
        border-radius: 4px;
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

    .department {
      font-weight: 500;
    }

    .btn2 {
        border: 1px solid #81BE41;
    }

    .footer-divider {
        position: inherit;
        margin-top: 5vh;
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

</style>