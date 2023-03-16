<template>
  <main>
    <div class="heading">
      <div style="min-height: 8.5vh;">
        <h2 style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>Team Members</h2>
        
        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">The Team</span></P>
      </div>
      <div>
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
      </div>
    </div>

    <div class="content">
        <div class="main-content">
            <div class="">
                <div class="card add-project ml-6 mt-3 mb-3">
                    <h4 class=" fw-bolder fs-5 mt-2">Project Team</h4>


                </div>

                <div class="projects ">
                    <MDBTable hover class="align-middle bg-white task-table">
                      <thead class="bg-light bg-red">
                          <tr>
                              <th class="fw-bold">Name and Email</th>
                              <th class="fw-bold">Job Title</th>
                              <th class="fw-bold">Department</th>
                              <!-- <th class="fw-bold">Current Project</th> -->
                              <th class="fw-bold">Ongoing Tasks</th>
                              <th class="fw-bold">Actions</th>
                          </tr>
                      </thead>
                      <tbody class="t-body" v-if="employeeStore.employees.length > 0">
                          <tr v-for="employee in employeeStore.employees" :key="employee.id">
                              <td>
                                  <div class="assignee">
                                      <img class="rounded-circle" src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" >
                                      <div class="ms-3" style="display: flex; flex-direction: column;">
                                          <span class="fw-bold mb-1">{{ employee.user_name }}</span>
                                          <span class="text-muted mb-0">{{ employee.user_email }}</span>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <span class="fw-normal">{{ employee.job_title }}</span>
                              </td>
                              <td>
                                  <MDBBadge badge="success" pill class="d-inline">{{ employee.department.department_name }}</MDBBadge>
                              </td>
                              <!-- <td>
                                  {{ employee.project.project_title }}
                              </td> -->
                              <td>
                                  {{ employee.tasks.title_title }}
                              </td>
                              <td>
                                  <MDBBtn color="link" size="sm" rounded>
                                      Edit
                                  </MDBBtn>
                                  <MDBBtn color="link" size="sm" rounded>
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
      return {
        date: new Date(),
        time: null,
        employeeStore: useEmployeeStore(),
        employees: []

      };
    },

    mounted(){
      const today = new Date()
      this.time = today.getHours()
      this.employeeStore.getEmployees()
      this.employees = this.employeeStore.employees
      console.log(this.employeeStore.employees)

    },

    methods: {
      
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


</style>