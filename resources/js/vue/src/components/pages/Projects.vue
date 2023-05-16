<template>
  <main>
    <div class="heading">
      <div style="min-height: 8.5vh;">
        <h2 v-if="user.role == 'admin'" style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Briefs / Projects</h2>
        <h2 v-else style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span> {{ department.department_name }} Department Briefs / Projects</h2>
        
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
                          <div class=" nav-color" id="nav-tab" >
                              <button @click="filter = 'all'" class="nav-link" >All</button>
                              <button v-if="user.role == 'admin'" @click="filter = 'progress'" class="nav-link " style="color: orange;">In Progress</button>
                              <button v-if="user.role == 'admin'"  @click="filter = 'overdue'" class="nav-link" style="color: darkorange;" >Overdue</button>
                              <button v-if="user.role == 'admin'"  @click="filter = 'finished'" class="nav-link" style="color: #81BE41;">Finished</button>
                          </div>
                      </div>
                  </nav>
                  <button  data-bs-toggle="modal" data-bs-target="#addProjectForm" @click="isEditing = false" class="card-btn" v-if="user.role == 'admin'"><span class="mr-1">New Project</span>  <i class="bi bi-folder-plus"></i></button>
                </div>

                <!-- Add project pop-up form -->
                <div class="modal fade" id="addProjectForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="ModalLabel">Add New Project</h5>
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
                                  <!-- <input type="Date" class="form-control" v-model="dataInput.deadline"/> -->
                                  <VueDatePicker v-model="dataInput.deadline" :min-date="new Date()" :enable-time-picker="false" />
                                  
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea type="text" rows="5" class="form-control" id="exampleInputPassword1" v-model="dataInput.description"></textarea>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Attach File</label>
                                  <input type="file" ref="fileInput" rows="5" class="form-control" @change="onSelectFile" />
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Priority</label>
                                  <select class="form-select" v-model="dataInput.priority">
                                      <option value="Normal">Normal</option>
                                      <option value="Urgent">Urgent</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn2" data-bs-dismiss="modal">Add Project</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class=" tab-content">
                  <center class="loader" v-if="projectStore.loading"><img src="../../assets/loaders/159.svg" alt="loader" /> </center>
                  <div class="projects" v-else>

                    <!-- All projects -->
                      <div>
                        <div v-if="filter === 'all' && user.role == 'admin' || user.role == 'hod' " class="row">
                            <div class="card mb-3" style="width: 25rem;" v-for="project in projectStore.projects" :key="project.id">
                                <div class="card-body">
                                    <i v-if="project.priority == 'Urgent'" class="bi bi-flag-fill priority" title="Urgent"  type="button"></i>
                                    <div class="title">
                                        <router-link class="card-title" :to="`/projects/${project.id}`">{{ project.project_title }}</router-link>
                                        
                                        <div  
                                            v-if="user.role == 'admin'"
                                            @mouseenter="toggle('display-action'+project.id)" 
                                            @mouseleave="toggleOff('display-action'+project.id)" 
                                            >

                                        <i type="button" class="bi bi-three-dots dots-btn"></i>
                                        <div class="delete-edit" :id="'display-action'+project.id" style="display:none">
                                            <i @click="projectStore.deleteProject(project.id)" class="fas fa-trash" title="Delete" style="color: darkorange;" type="button"></i>
                                        </div>

                                        </div>
                                    </div>
                                    <p class="card-text mt-3">{{ project.description.slice(0, 50) }}...</p>
                                    <div>
                                        <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                    </div>
                                    <div class="assignee-image">
                                        <div v-for="(assignee, index) in project.assignees" :key="index" class="assignee-wrapper">
                                            <img v-if="!assignee.image_url" src="../../assets/images/defaultprofile.webp" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                            <img v-else :src="assignee.image_url" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                        </div>
                                    </div>
                                    
                                    <div class="progress mt-5" :title="project.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                        <div v-if="project.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: project.progress+'%'}"></div> 
                                        <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                        <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    </div>
                                </div>
                            </div>  
                        </div>


                        <div v-if="filter === 'all' && user.role != 'admin'" class="row">
                            <div class="card mb-3" style="width: 25rem;" v-for="project in projectStore.projectsByDpt" :key="project.id">
                                <div class="card-body">
                                    <!-- <i @click="togglePriority(project.id)" :class="{active: project.priority}" class="bi bi-flag-fill priority" title="{ priority }"  type="button"></i> -->
                                    <i v-if="project.priority == 'urgent'" class="bi bi-flag-fill priority" title="Urgent"  type="button"></i>
                                    <div class="title">
                                        <router-link class="card-title" :to="`/projects/${project.id}`">{{ project.project_title }}</router-link>
                                    </div>
                                    <p class="card-text mt-3">{{ project.description.slice(0, 50) }}...</p>
                                    <div>
                                        <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                    </div>
                                    <div class="assignee-image">
                                      <div v-for="(assignee, index) in project.assignees" :key="assignee.id" class="assignee-wrapper">
                                        <img v-if="!assignee.image_url" src="../../assets/images/defaultprofile.webp" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                        <img v-else :src="assignee.image_url" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                      </div>
                                    </div>
                                    <div class="progress mt-5"  :title="project.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                      <div v-if="project.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                      <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                      <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                      </div>
                      
                      
                      <!-- Projects that are in progress -->
                      <div v-if="filter === 'progress' && user.role == 'admin'" class="row">
                          <div v-if="projectStore.inProgress.length == 0"><center class="mt-5"><h4>No Ongoing Project</h4></center></div>
                          <div v-else class="card mb-3" style="width: 25rem;" v-for="(project, index) in projectStore.inProgress" :key="index">
                              <div class="card-body">
                                  <div class="title">
                                    <router-link class="card-title" style="background-color: #ffa60078; color: white;" :to="`/projects/${project.id}`">{{ project.project_title }}</router-link>
                                    <div
                                        @mouseenter="toggle('display-action'+project.id)" 
                                        @mouseleave="toggleOff('display-action'+project.id)" >

                                      <i type="button" class="bi bi-three-dots dots-btn"></i>
                                      <div class="delete-edit" :id="'display-action'+project.id" style="display:none">
                                        <i @click="projectStore.deleteProject(project.id)" class="fas fa-trash" title="Delete" style="color: darkorange;" type="button"></i>
                                      </div>

                                    </div>
                                  </div>
                                  <p class="card-text mt-3">{{ project.description.slice(0, 50) }}...</p>
                                  <div>
                                    <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                  </div>
                                  <div class="assignee-image">
                                    <div v-for="(assignee, index) in project.assignees" :key="index" class="assignee-wrapper">
                                        <img v-if="!assignee.image_url" src="../../assets/images/defaultprofile.webp" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                        <img v-else :src="assignee.image_url" :alt="assignee.user.name" :title="assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                    </div>
                                  </div>
                                  <div class="progress mt-5" :title="project.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div v-if="project.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                  </div>
                              </div>
                          </div>  
                      </div>

                      <!-- Projects that are overdue -->
                      <div v-if="filter === 'overdue' && user.role == 'admin'" class="row">
                          <div v-if="projectStore.overdue.length == 0"><center class="mt-5"><h4>No Overdue Project</h4></center></div>
                          <div v-else class="card mb-3" style="width: 25rem;" v-for="(project, index) in projectStore.overdue" :key="index">
                              <div class="card-body">
                                  <div class="title">
                                    <router-link class="card-title" style="background-color: darkorange; color: white;" :to="`/projects/${project.id}`">{{ project.project_title }}</router-link>
                                    <div
                                        @mouseenter="toggle('display-action'+project.id)" 
                                        @mouseleave="toggleOff('display-action'+project.id)" >

                                      <i type="button" class="bi bi-three-dots dots-btn"></i>
                                      <div class="delete-edit" :id="'display-action'+project.id" style="display:none">
                                        <i @click="projectStore.deleteProject(project.id)" class="fas fa-trash" title="Delete" style="color: darkorange;" type="button"></i>
                                      </div>

                                    </div>
                                  </div>
                                  <p class="card-text mt-3">{{ project.description.slice(0, 50) }}...</p>
                                  <div>
                                    <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                  </div>
                                  <div class="assignee-image">
                                    <div v-for="(assignee, index) in project.assignees" :key="index" class="assignee-wrapper">
                                        <img v-if="!assignee.image_url" src="../../assets/images/defaultprofile.webp" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                        <img v-else :src="assignee.image_url" :alt="assignee.user.name" :title="assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                    </div>
                                  </div>
                                  <div class="progress mt-5" :title="project.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div v-if="project.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div>                                  
                                  </div>
                              </div>
                          </div>  
                      </div>

                       <!-- Projects that are completed -->
                       <div v-if="filter === 'finished' && user.role == 'admin'" class="row">
                          <div v-if="projectStore.finished.length == 0"><center class="mt-5"><h4>No Finished Project</h4></center></div>
                          <div v-else class="card mb-3" style="width: 25rem;" v-for="(project, index) in projectStore.finished" :key="index">
                              <div class="card-body">
                                  <div class="title">
                                    <router-link class="card-title" style="background-color: #81BE41; color: white;"  :to="`/projects/${project.id}`">{{ project.project_title }}</router-link>
                                    <div
                                        @mouseenter="toggle('display-action'+project.id)" 
                                        @mouseleave="toggleOff('display-action'+project.id)" >

                                      <i type="button" class="bi bi-three-dots dots-btn"></i>
                                      <div class="delete-edit" :id="'display-action'+project.id" style="display:none">
                                        <i @click="projectStore.deleteProject(project.id)" class="fas fa-trash" title="Delete" style="color: darkorange;" type="button"></i>
                                      </div>

                                    </div>
                                  </div>
                                  <p class="card-text mt-3">{{ project.description.slice(0, 50) }}...</p>
                                  <div>
                                    <i class="bi bi-calendar-event fs-5 mr-2"></i> Due on <span class="fw-bold" style="color: #2F5508;">{{ new Date(project.deadline).toDateString() }}</span>
                                  </div>
                                  <div class="assignee-image">
                                      <div v-for="assignee in project.assignees" :key="assignee.id">
                                        <img v-if="!assignee.image_url" src="../../assets/images/defaultprofile.webp" :alt="assignee.user.name" :title="assignee.user.name == user.user.name ? 'Me' : assignee.user.name" class="assignee-image" :style="{ top: 0, left: index * -15 + 'px' }"/>
                                        <img v-else :src="assignee.image_url" alt="..." :title="assignee.user.name"/>
                                      </div>
                                    </div>
                                  <div class="progress mt-5" :title="project.progress + '% Complete'" style="height: 10px; color: green; border-radius: 5px;" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div v-if="project.progress > 80" class="progress-bar"  :style="{backgroundColor:'#81BE41', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress >= 50" class="progress-bar"  :style="{backgroundColor:'orange', borderRadius: 5+'px', width: project.progress+'%'}"></div>
                                    <div v-else-if="project.progress > 5" class="progress-bar"  :style="{backgroundColor:'darkgray', borderRadius: 5+'px', width: project.progress+'%'}"></div>                                           
                                  </div>
                              </div>
                          </div>  
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
    import { useDepartmentStore } from '../../stores/departmentStore';
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';
    import {useFileStore} from '../../stores/fileStore'
    // import donut from '../charts/adminDonut'


    export default {
    components: {
        Calendar,
        DatePicker,
        MDBTable,
        MDBBtn,
        MDBBadge,
        // donut,

    },

    
    data() {
        var userData = JSON.parse(localStorage.getItem('user'))
        return {
            date: new Date(),
            user: userData,
            time: null,
            projectStore: useProjectStore(),
            departmentStore: useDepartmentStore(),
            fileStore: useFileStore(),
            dataInput: {
                project_title: "",
                department_id: "",
                deadline: "",
                description: "",
                priority: "",
                file: ""
            },
            isOpen: false,
            filter: "all",
            isEditing: false,
            fileName: "",
            department: "",


        };
    },

    mounted(){
        const today = new Date();
        const id = this.user.department_id;

        console.log(id)

        this.time = today.getHours();
        this.projectStore.getProjects();
        this.departmentStore.getDepartments();
        this.projectStore.inProgress;
        this.projectStore.projectsByDpt;
        this.getDepartment(id);

        console.log(this.projectStore.projectsByDpt)

        // console.log(this.departmentStore.dptByEmployee)

        // console.log(this.projectStore.projectsByDpt);


    },

    methods: {
            submitForm(){

            this.projectStore.addProject(this.dataInput);
            // this.fileStore.addFile(this.dataInput);
            
            this.dataInput = {
                project_title: "",
                department_id: "",
                deadline: "",
                description: "",
                priority: "",
                file: ""
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

            togglePriority(id){

                const project = this.projectStore.projects.find((item) => {
                    return item.id === id;
                    
                })
            },

            onSelectFile(event){
                const file = event.target.files[0];

                this.dataInput.file = file;
            },


            showAlert(id) {
                this.$swal.fire({
                    title: 'Confirm Delete',
                    text: 'Are you sure you want to delete?',
                    icon: 'info',
                    confirmButtonText: 'Cool'
                });
            },


            getDepartment(id){

                 this.departmentStore.departments.filter((dpt) => {

                    this.department = dpt.id == id;
                });

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

    .delete-edit {
      position: absolute;
      right: 0;
      top: 40px;
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
      /* color: #ffa60078; */
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
    margin-left: 35px;
    width: 65.5vw;
    height: 56vh;
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

  .card-body .dots-btn {
    position: relative;
    right: -30px;
    top: -20px;
  }

  .card-body .priority {
    position: absolute;
    top: 10px;
    left: 10px;
    color: darkorange;
  }

  .card-body i {
  margin-right: 15px;
  color:#839470 ;
  cursor: pointer;
}


.assignee-image  {
  position: relative;
  display: flex;
  justify-content: flex-start;
  /* overflow: hidden; */
}

.assignee-image img {
  z-index: 1;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  margin-top: 10px;
  margin-bottom: -30px;
  /* border: 4px solid white; */
  box-shadow: 0 0 0 5px white;
}

.assignee-wrapper {
  position: relative;
  display: inline-block;
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
    padding: 5px 15px;
    border-radius: 15px;
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

  .loader{
    position: relative;
    top: 20vh;
  }

  .nav-color {
    display: flex;
    align-items: center;
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

