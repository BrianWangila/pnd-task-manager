<template>
  <main>
    <div class="heading">
      <div style="min-height: 8.5vh;">
        <h2 style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>Team Members</h2>
        
        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">The Team</span></P>
      </div>
      <!-- <div>
        <div className="btn-group">
          <button style="border: 1px solid lightgray;" type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-calendar mr-3"></i> Today
          </button>
          <ul className="dropdown-menu" >
            <li><DatePicker v-model="date" /></li>
          </ul>
        </div>

        <div className="btn-group" style="margin-left: 20px;">
          <button style="border: 1px solid lightgray;" type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-funnel mr-3"></i> Filter
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
        <div class="main-content">
            <div class="">
                <div>
                    <div class="card add-project ml-6 mt-3 mb-3">
                        <h4 class="fw-light fs-5 mt-2"><span class="fw-bold">{{ user.role == 'admin' ? 'All Members': 'Department Members' }}</span> </h4>
                        <h4  v-if="user.role == 'admin'" class="fw-bolder fs-5 mt-2 add-member-btn" data-bs-toggle="modal" data-bs-target="#addUserForm" type="button">Add Member<i class="bi bi-plus fs-4"></i></h4>
                    </div>
                    

                    <!-- pop-up modal to add user -->
                <div class="modal fade" id="addUserForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="ModalLabel">Add a New Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="addEmployeeForm">
                                
                                    <div class="mb-3">
                                        <label class="form-label">Full Names</label>
                                        <input type="text" class="form-control" v-model="dataInput.name"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" v-model="dataInput.email"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Department</label>
                                        <select class="form-select" v-model="dataInput.departmentId">
                                            <option v-for="dpt in departmentStore.departments" :key="dpt.id" :value="dpt.id">{{ dpt.department_name }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" class="form-control" v-model="dataInput.jobTitle"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" v-model="dataInput.role">
                                            <option value="hod">H.O.D</option>
                                            <option value="employee">Employee</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn2" data-bs-dismiss="modal">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                </div>

                <div class="projects ">
                    <MDBTable  hover class="table align-middle bg-white task-table ">
                      <thead class="bg-light bg-red">
                          <tr>
                              <th class="fw-bold">Name and Email</th>
                              <th class="fw-bold">Job Title</th>
                              <th v-if="user.role == 'admin'" class="fw-bold">Department</th>
                              <th class="fw-bold">Ongoing Tasks</th>
                              <th v-if="user.role == 'admin'" class="fw-bold">Actions</th>
                          </tr>
                      </thead>

                      <tbody class="t-body"  v-if="employeeData.length > 0">
                            <tr v-for="employee in employeeData" :key="employee.id">
                                <td  style="cursor: pointer" @click="routerLink(employee.id)">
                                    <div class="assignee">
                                        <!-- <img class="rounded-circle" src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" > -->
                                        <img v-if="!employee.image_url" class="rounded-circle" src="../../assets/images/defaultprofile.webp" alt="employee.user.name" style="width: 45px; height: 45px" >
                                        <img v-else class="rounded-circle" :src="employee.image_url" alt="employee.user.name" style="width: 45px; height: 45px" >
                                        <div class="ms-3" style="display: flex; flex-direction: column;">
                                            <span class="fw-bold mb-1">{{ employee.user.name }}<span v-if="employee.user.email == user.user.email" style="font-weight: 400;"> (Me)</span></span>
                                            <span class="text-muted mb-0">{{ employee.user.email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-normal">{{ employee.job_title }}</span>
                                </td>
                                <td  v-if="user.role == 'admin'">
                                    <MDBBadge badge="success" pill class="d-inline">{{ employee.department.department_name }}</MDBBadge>
                                </td>
                                <td>
                                    <div v-if="employee.tasks.length > 0">
                                        <button data-bs-toggle="modal" :data-bs-target="'#tasksList'+employee.id"  class="task-btn" type="button">{{ employee.tasks.length > 1 ? `${employee.tasks.length} Tasks` : `${employee.tasks.length} Task`  }} </button>
                                    </div>
                                    
                                    <div v-else>
                                        <p>No Task</p>
                                    </div>
                                    

                                    <!-- Tasks pop up form -->
                                    <div class="modal fade" :id="'tasksList'+employee.id" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="ModalLabel">Active Tasks</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <MDBTable hover class="align-middle bg-white task-table">
                                                        <thead class="bg-light bg-red">
                                                            <tr>
                                                                <th class="fw-bold">Task</th>
                                                                <th class="fw-bold">Description</th>
                                                                <th class="fw-bold">Status</th>
                                                                <th class="fw-bold">Due Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="t-body" v-if="employee.tasks.length > 0">
                                                            <tr v-for="task in employee.tasks" :key="task.id">
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <span class="mb-1" style="font-weight: 500;">{{ task.task_title }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="width: 700px;">
                                                                    <span class="fw-normal">{{ task.description }}</span>
                                                                </td>
                                                                <td>
                                                                    <MDBBadge badge="success" pill class="d-inline">In Progress</MDBBadge>
                                                                </td>
                                                                <td>{{ new Date(task.deadline).toDateString() }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </MDBTable>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td v-if="user.role == 'admin'" >
                                    <MDBBtn color="link" size="sm" rounded v-if="employee.role != 'admin'" @click="deleteMember(employee.id)">
                                        Delete
                                    </MDBBtn>
                                </td>
                            </tr>
                      </tbody>
                  </MDBTable>
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
    import { useEmployeeStore } from '../../stores/employeeStore';
    import { useAuthStore } from '../../stores/authStore';
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';
    import { useDepartmentStore } from '../../stores/departmentStore';
    import axiosClient from '../../axios';
    import DataTable from 'datatables.net-vue3';
    import DataTablesCore from 'datatables.net';
    import DataTablesLib from 'datatables.net-bs5';
    import 'datatables.net-select-bs5';

    DataTable.use(DataTablesCore);
    DataTable.use(DataTablesLib);

    

    export default {
        components: {
            Calendar,
            DatePicker,
            MDBTable,
            MDBBtn,
            MDBBadge,
            DataTable,

        },
        
        data() {
            var userData = JSON.parse(localStorage.getItem('user'))
            return {
                user: userData,
                date: new Date(),
                time: null,
                employeeStore: useEmployeeStore(),
                userStore: useAuthStore(),
                departmentStore: useDepartmentStore(),
                employees: [],
                employeeData: [],
                dataInput: {
                    name: "",
                    email: "",
                    departmentId: "",
                    jobTitle: "",
                    role: ""
                },
                loading: false,

            };
        },
        

        mounted(){
            const today = new Date()
            this.time = today.getHours()
            this.employeeStore.getEmployees()
            this.employees = this.employeeStore.employees
            this.departmentStore.getDepartments()
            this.employeeStore.getEmployeesByDpt(this.user.department_id)
            this.getEmployees(this.user.department_id)

        },


        methods: {
            addEmployeeForm(){
                this.userStore.register(this.dataInput)
                // this.employeeStore.addEmployee(this.dataInput)

                this.dataInput = {
                    name: "",
                    email: "",
                    userId: "",
                    departmentId: "",
                    jobTitle: "",
                    role: ""
                };

                this.getEmployees();
            },

            
            async getEmployees(id){
                this.loading = true;

                try {
                    if(this.user.role == 'admin'){
                        await axiosClient.get("/employees")
                        .then((res) => {
                            this.employeeData = res.data;
                            console.log(this.employeeData);
                        })

                    } else {
                        await axiosClient.get("/employees/department/"+id)
                        .then((res) => {
                            this.employeeData = res.data;
                            console.log(this.employeeData);
                        })
                    };
                    

                } catch (error) {
                    console.log(error)
                }

                this.loading = false
            },

            
            routerLink(id){
                this.user.role == 'admin' ? this.$router.push('/employees/'+id) : null; 
            },


            deleteMember(id){
                this.employeeStore.deleteEmployee(id)
                this.getEmployees()
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
    height: 80.3vh;
    overflow-y: auto;
  }


  .projects {
    flex:1; 
    position: inherit;
    margin-left: 25px;
    min-height: 55vh;
    max-height: 55vh;
    overflow-y: auto;
    background-color: white;
    width: 65.5vw;
    padding: 1rem;
  }

  .projects h4 {
      font-size: 18px;
      font-weight: bolder;
      text-align: center;
      position: relative;
      top: 10vh;
  }

  .projects .assignee {
    display: flex;
    align-items: center;
  }

  .footer-divider {
    position: inherit;
    margin-top: 5vh;
  }

  footer p {
    text-align: center;
    color: #2F5508;
  }

  .add-member-btn{
    padding: 5px;
    color: #2F5508;
  }

  .add-project {
    display: flex;
    flex-direction: row;
    justify-content:space-between ;
    align-items: center;
    padding: 10px 20px;
    border-radius: 5px;
    width: 65.5vw;
  }

  .add-project button {
    color: #2F5508;
    border: 1px solid lightgrey;
    padding: 0.5rem;
    border-radius: 5px;
    font-weight: 600;
  }

  .task-btn {
    background: lightgray;
    padding: 5px 15px;
    border-radius: 5px;
  }


</style>