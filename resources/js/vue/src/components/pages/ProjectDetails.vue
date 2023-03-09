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
      <div class="add-project  ml-8 mt-3 mb-2 mr-8">
        <h4 class=" fw-bolder">{{ projectItem.project_title }}</h4>
        <div>
            <button class="mr-3"><router-link to="/projects"  style="color: black; font-weight: 500;"><i class="bi bi-arrow-left-short"></i> Back to Projects</router-link></button>
            <button><span class="mr-1" data-bs-toggle="modal" data-bs-target="#addProjectForm">Update Project</span>  <i class="bi bi-pencil-square"></i></button>
        </div>
      </div>

      <!-- pop-up form -->
      <!-- <div class="modal fade" id="addProjectForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-dark" id="ModalLabel">Add New Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form @submit.prevent="addProject">
              <div class="mb-3">
                  <label for="projectTitle" class="form-label">Project/Brief Title</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data_input.project_title"/>
                  <div id="emailHelp" class="form-text">Write a short title of the project.</div>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Deadline</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" v-model="data_input.deadline"/>
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Description</label>
                  <textarea type="text" rows="5" class="form-control" id="exampleInputPassword1" v-model="data_input.description"></textarea>
              </div>
              <button type="submit" class="btn btn2">Submit</button>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
      </div>
      </div> -->

      <div class="main-content">
        <div class="ml-5">
            <div class="priority">
                <p class="mr-20" style="font-weight: 600;">Priority:</p> <p class="priority-flag"><i class="bi bi-flag"></i> Normal</p>
            </div>
            <div class="assigned">
                <p style="margin-right: 5px; font-weight: 600;">Assigned To:</p>
                <ul>
                    <li>Brian Wangila</li>
                    <li>Laura Cherop</li>
                    <li>Kevin Maingi</li>
                </ul>
            </div>
            <div class="deadline">
                <p style="margin-right: 4rem; font-weight: 600;">Deadline:</p> <p>{{ projectItem.deadline }}</p>
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

        <div class="project-description mt-5">
            <nav class="row mb-5">
                <div class="nav nav-tabs nav-color" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="true">Project Details</button>
                    <button class="nav-link" id="nav-tasks-tab" data-bs-toggle="tab" data-bs-target="#nav-tasks" type="button" role="tab" aria-controls="nav-tasks" aria-selected="false">Project Tasks</button>
                    <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files" type="button" role="tab" aria-controls="nav-files" aria-selected="false">Project Files</button>
                </div>                    
                <hr/>
            </nav>
            <div class="tab-content ml-5 project-details" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab" tabindex="0">
                    <div>
                        <h4>Project Description</h4>
                        <p>{{ projectItem.description }}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab" tabindex="0">
                    <div class="project-tasks">
                        <h4>Tasks Related to this Project</h4>
                        <MDBTable class="align-middle bg-white task-table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Project Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date Assigned</th>
                                    <th>Assignee</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr  v-for="task in projectTasks" :key="task.id">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3" >
                                                <span class="fw-bold mb-1">{{ task.task_title }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-normal">{{ task.description }}</span>
                                    </td>
                                    <td>
                                        <MDBBadge badge="success" pill class="d-inline">Active</MDBBadge>
                                    </td>
                                    <td>{{ task.deadline }}</td>
                                    <td class="d-flex align-items-center">
                                        <img class="rounded-circle" src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" >
                                        <div class="ms-3" style="display: flex; flex-direction: column;">
                                            <span class="fw-bold mb-1">John Doe</span>
                                            <span class="text-muted mb-0">john.doe@gmail.com</span>
                                        </div>
                                    </td>
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
                <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab" tabindex="0">
                    <div>
                        <h4>Project Files</h4>
                    </div>
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
    return {
      date: new Date(),
      projectStore: useProjectStore(),
      projectItem: "",
      projectTasks: ""

    };
  },
  mounted(){

    var id = this.$route.params.id;

    // this.projectStore.singleProject(id)
    // this.projectItem = this.projectStore.projectItem

    this.singleProject(id)

  },

  methods: {
    async singleProject(id){
      try {
        await axiosClient.get("/projects/"+id)
        .then((res) => {
          this.projectItem = res.data
          this.projectTasks = this.projectItem.tasks
          console.log(this.projectItem.tasks)

        })
      } catch (error) {
        console.log(error)
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

    .priority, 
    .assigned, 
    .tags, 
    .deadline, 
    .assigned ul,
    .tags ul {
        display: flex;
        align-items: center;
    }

    .priority-flag {
        background: rgba(129, 190, 65, 0.7);
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


    .main-content {
        margin: 2rem;
    }

    .nav-color button {
        color: #2F5508;
        font-weight: 600;
        font-size: 15px;
    }

    .nav-color button.active {
        color: whitesmoke;
        background-color: #82be4191;
        border-bottom: 3px solid #7dc530;

    }

    .nav-color button:hover {
        color: whitesmoke;
        background-color: #82be411c;

    }

    .project-description hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #939191;
        margin: 0 0;
        padding: 0;
    }

    .project-details h4 {
        font-weight: 600;
        font-size: 20px;
    }

    .project-details p {
        width: 50vw;
    }

    

    



</style>