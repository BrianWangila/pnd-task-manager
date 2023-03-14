<template>
  <main>
    <div class="heading">
      <div style="min-height: 8.5vh;">
        <h2 style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Briefs / Projects</h2>
        
        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Projects</span></P>
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
            <div>
                <div class="card add-project ml-6 mt-3 mb-3">
                  <nav class="row ">
                      <div class="nav-header">
                          <div class="nav nav-tabs nav-color" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="projects" data-bs-toggle="tab" data-bs-target="#all-projects" type="button" role="tab" aria-controls="nav-all" aria-selected="true">All Projects</button>
                              <button class="nav-link " id="progress" data-bs-toggle="tab" data-bs-target="#in-progress" type="button" role="tab" aria-controls="nav-progress" aria-selected="false">In Progress</button>
                              <button class="nav-link" style="color: orange;" id="overdue" data-bs-toggle="tab" data-bs-target="#overdue" type="button" role="tab" aria-controls="nav-overdue" aria-selected="false">Overdue</button>
                              <button class="nav-link" id="complete" data-bs-toggle="tab" data-bs-target="#finished" type="button" role="tab" aria-controls="nav-finished" aria-selected="false">Finished</button>
                          </div>
                      </div>
                  </nav>
                  <button class="card-btn"><span class="mr-1" data-bs-toggle="modal" data-bs-target="#addProjectForm">New Project</span>  <i class="bi bi-folder-plus"></i></button>
                </div>

                <!-- pop-up form -->
                <div class="modal fade" id="addProjectForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="ModalLabel">Add New Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="addProject">
                            <div class="mb-3">
                                    <label for="department" class="form-label">Select Department</label>
                                    <select class="form-select" v-model="data_input.department_id">
                                        <option v-for="dpt in departmentStore.departments" :key="dpt.id" :value="dpt.id">{{ dpt.department_name }}</option>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="projectTitle" class="form-label">Project/Brief Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data_input.project_title"/>
                                <div id="emailHelp" class="form-text">Write a short title of the project.</div>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="Date" class="form-control" id="exampleInputPassword1" v-model="data_input.deadline"/>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" rows="5" class="form-control" id="exampleInputPassword1" v-model="data_input.description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="files" class="form-label">Attach File</label>
                                <input type="file" rows="5" class="form-control" id="file" />
                            </div>
                            <div  class="mb-3">
                                <input type="checkbox" data-toggle="toggle" data-onlabel="Ready" data-offlabel="Not Ready" data-onstyle="success" data-offstyle="danger">
                                <label class="form-label ml-2 fw-bold">Urgent</label>
                            </div>
                            <button type="submit" class="btn btn2">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class=" tab-content">
                  <div class="projects ">
                      <div class="tab-pane fade show row active" aria-labelledby="nav-all" tabindex="0" id="all-projects">
                        <div class="card mb-3" style="width: 25rem;" v-for="(project, index) in projectStore.projects" :key="index">
                            <div class="card-body">
                                <div class="title">
                                  <router-link class="card-title" :to="`/projects/${project.id}`">Front-end Development</router-link>
                                  <div
                                      @mouseenter="toggle('display-action'+project.id)" 
                                      @mouseleave="toggleOff('display-action'+project.id)" >

                                    <i type="button" class="bi bi-three-dots"></i>
                                    <div class="delete-edit" :id="'display-action'+project.id" style="display:none">
                                      <i class="fas fa-edit mb-2" style="color: skyblue;" type="button"></i>
                                      <i @click="projectStore.deleteProject(project.id)" class="fas fa-trash" style="color: darkorange;" type="button"></i>
                                    </div>

                                  </div>
                                </div>
                                <p class="card-text mt-3 fw-bold">{{ project.project_title }}</p>
                                <div>
                                <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                </div>
                                <div class="progress mt-5" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar"  style="background-color:#81BE41; border-radius: 5px; width: 50%;"></div>
                                </div>
                            </div>
                        </div>  
                    </div>
                  </div>
                </div>
            </div>
<!--             
            <div class="lower-main mt-3 pt-4 pb-4 ml-6 mr-5 bg-light">
                <nav class="row mb-4">
                    <div class="nav-header">
                        <div class="nav nav-tabs nav-color" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#assigned-projects" type="button" role="tab" aria-controls="nav-details" aria-selected="true">Overdue</button>
                            <button class="nav-link" id="nav-tasks-tab" data-bs-toggle="tab" data-bs-target="#in-progress" type="button" role="tab" aria-controls="nav-tasks" aria-selected="false">In Progress</button>
                            <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#finished" type="button" role="tab" aria-controls="nav-files" aria-selected="false">Finished</button>
                        </div>
                    </div>
                    <hr/>
                </nav>

                <div class="tab-content">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-details-tab" tabindex="0" id="assigned-projects">
                        <h4>Assigned Projects</h4>
                        <MDBTable hover class="align-middle bg-white task-table">
                            <thead class="bg-light bg-red">
                                <tr>
                                    <th class="fw-bold">Project Title</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold">Deadline</th>
                                    <th class="fw-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="mb-1" style="font-weight: 500;">Title</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-normal">Description</span>
                                    </td>
                                    <td>
                                        <MDBBadge badge="success" pill class="d-inline">Completed</MDBBadge>
                                    </td>
                                    <td>Deadline</td>
                                    <td>
                                        <MDBBtn color="link" size="sm" rounded>
                                            Edit
                                        </MDBBtn>
                                    </td>
                                </tr>
                            </tbody>
                        </MDBTable>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="nav-tasks-tab" tabindex="0" id="in-progress">
                        <h4>Projects that are in-Progress</h4>
                        <MDBTable hover class="align-middle bg-white task-table">
                            <thead class="bg-light bg-red">
                                <tr>
                                    <th class="fw-bold">Project Title</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold">Deadline</th>
                                    <th class="fw-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="mb-1" style="font-weight: 500;">Title</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-normal">Description</span>
                                    </td>
                                    <td>
                                        <MDBBadge badge="success" pill class="d-inline">Completed</MDBBadge>
                                    </td>
                                    <td>Deadline</td>
                                    <td>
                                        <MDBBtn color="link" size="sm" rounded>
                                            Edit
                                        </MDBBtn>
                                    </td>
                                </tr>
                            </tbody>
                        </MDBTable>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="nav-files-tab" tabindex="0" id="finished">
                        <h4>Past Due Projects</h4>
                        <MDBTable hover class="align-middle bg-white task-table">
                            <thead class="bg-light bg-red">
                                <tr>
                                    <th class="fw-bold">Project Title</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold">Deadline</th>
                                    <th class="fw-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="mb-1" style="font-weight: 500;">Title</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-normal">Description</span>
                                    </td>
                                    <td>
                                        <MDBBadge badge="success" pill class="d-inline">Completed</MDBBadge>
                                    </td>
                                    <td>Deadline</td>
                                    
                                    <td>
                                        <MDBBtn color="link" size="sm" rounded>
                                            Edit
                                        </MDBBtn>
                                    </td>
                                </tr>
                            </tbody>
                        </MDBTable>
                    </div>
                </div>
            </div> -->
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
  import { useDepartmentStore } from '../../stores/departmentStore';
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
      projectStore: useProjectStore(),
      departmentStore: useDepartmentStore(),
      data_input: {
        project_title: "",
        department_id: "",
        deadline: "",
        description: ""
      },
      isOpen: false,

    };
  },
  // props: ['project', 'index'],

  mounted(){
    const today = new Date()
    this.time = today.getHours()
    this.projectStore.getProjects()
    this.departmentStore.getDepartments()

  },

  methods: {
    addProject(){
      if(this.data_input.project_title){
        this.projectStore.addProject(this.data_input)

        this.data_input = {
          project_title: "",
          deadline: "",
          description: ""
        }
      }

    this.projectStore.getProjects()
      
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
      height: 80.3vh;
      overflow-y: auto;
    }


  .projects {
    flex:1; 
    position: inherit;
    margin: auto;
    margin-left: 25px;
    width: 65.5vw;
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

  .bi-calendar-event {
    color:#2F5508;
  }

  .text-dark {
    text-align: center;
    color: red;
  }
  .card-title {
    background-color: rgba(255, 165, 0, 0.12);
    color: #FFA500;
    padding: 10px;
    border-radius: 25px;
    font-weight: 600;
  }

  .add-project {
    display: flex;
    flex-direction: row;
    justify-content:space-between ;
    align-items: center;
    padding: 10px 20px;
    border-radius: 5px;
    width: 64.5vw;
  }

  .add-project .card-btn {
    color: #2F5508;
    border: 1px solid lightgrey;
    padding: 0.5rem;
    border-radius: 5px;
    font-weight: 600;
  }

  .add-project .card-btn:hover {
    background-color: #82be411c;
  }

  .btn2 {
    border: 1px solid #81BE41;
  }


    .nav-color button {
        color: #2F5508;
        font-weight: 600;
        font-size: 15px;
        padding: 15px;
        margin: 0 15px;
    }

    .nav-color button.active {
        color: whitesmoke;
        background-color: #82be4191;
        border-bottom: 3px solid #7dc530;
        padding: 15px;
        margin: 0 15px;
        border: none;

    }

    .nav-color button:hover {
        color: #81BE41;
        background-color: #82be411c;
        padding: 15px;
        margin: 0 15px;
    }




</style>

