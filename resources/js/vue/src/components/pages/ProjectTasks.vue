<template>
    <main>
        <div class="main-content  mt-3 p-3 bg-white">
            <div class="project-description">
                <nav class="row mb-4">
                    <div class="nav-header">
                        <div class="nav nav-tabs nav-color" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="true">Project Details</button>
                            <button class="nav-link" id="nav-tasks-tab" data-bs-toggle="tab" data-bs-target="#nav-tasks" type="button" role="tab" aria-controls="nav-tasks" aria-selected="false">Project Tasks</button>
                            <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files" type="button" role="tab" aria-controls="nav-files" aria-selected="false">Project Files</button>
                        </div>
                        <button class="nav-header-btn"  v-if="user.role == 'admin'"><span class="mr-1" data-bs-toggle="modal" data-bs-target="#addTaskForm" >Create Task</span>  <i class="bi bi-pencil-square"></i></button> 
                    </div>
                    <hr/>
                </nav>

                <div class="tab-content ml-5 project-details" id="nav-tabContent">
                    
                    <!-- Project Description -->
                    <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab" tabindex="0">
                        <div>
                            <h4>Project Description</h4>
                            <p>{{ projectItem.description }}</p>
                        </div>
                    </div>
                    
                    <!-- Project Tasks -->
                    <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab" tabindex="0">
                        <div class="project-tasks">
                            <h4 class="mb-1">Tasks Related to this Project</h4>

                            <div v-if="projectTasks.length == 0">
                                <center class="mt-5"><h4>No Tasks Created</h4></center>
                            </div>
                            <div v-else>
                                <MDBTable hover class="align-middle bg-white task-table">
                                    <thead class="bg-light bg-red">
                                        <tr>
                                            <th class="fw-bold">Task</th>
                                            <th class="fw-bold">Description</th>
                                            <th class="fw-bold">Status</th>
                                            <th class="fw-bold">Date Assigned</th>
                                            <th class="fw-bold">Assignee</th>
                                            <th  v-if="user.role == 'admin'" class="fw-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="t-body">
                                        <tr  v-for="task in projectTasks" :key="task.id">
                                            <td style="width: 15vw;">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="mb-1" style="font-weight: 500;">{{ task.task_title }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 35vw;">
                                                <span class="fw-normal">{{ task.description }}</span>
                                            </td>
                                            <td>
                                                <MDBBadge :badge="task.status == 'Completed' ? 'success' : 'warning'" pill class="d-inline">{{ task.status }}</MDBBadge>
                                            </td>
                                            <td>{{ new Date(task.deadline).toDateString() }}</td>
                                            <td>
                                                <div class="assignee">
                                                    <img v-if="!task.assignee.image_url" class="rounded-circle" src="../../assets/images/defaultprofile.webp" alt="" style="width: 45px; height: 45px" >
                                                    <img v-else class="rounded-circle" :src="task.assignee.image_url" alt="" style="width: 45px; height: 45px" >
                                                    <div class="ms-3" style="display: flex; flex-direction: column;">
                                                        <span class="fw-bold mb-1">{{ task.assignee.user.name }}<span v-if="task.assignee.user.email == user.user.email" style="font-weight: 400;"> (Me)</span></span>
                                                        <span class="text-muted mb-0">{{ task.assignee.user.email }}</span>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            <td v-if="user.role == 'admin'">
                                                <MDBBtn @click="editTask(task)" data-bs-toggle="modal" data-bs-target="#addTaskForm" color="link" size="sm" rounded>
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


                    <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab" tabindex="0">
                        <div>
                            <h4>Project Files</h4>
                        </div>

                        <div class="project-files">
                            <div class="upload-btn"  v-if="user.role == 'admin'">
                                <button  data-bs-toggle="modal" data-bs-target="#job_file_modal"><i class="bi bi-upload mr-2"></i> Upload File</button>
                            </div>
                            <!-- Popup file upload Modal -->
                            <div id="job_file_modal" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span style="font-weight: 600;">{{ projectItem.project_title }}</span></h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form @submit.prevent="submitFileForm" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" v-model="dataInput.project_id" disabled style="display: none;">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>File Name<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" v-model="dataInput.file_name">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>File </label>
                                                    <input class="form-control" @change="onSelectFile" type="file">
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn mt-3" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Files card -->
                            <div class="project-files-body">
                                <div class="row"  v-if="projectItem.files">
                                    <div class="card files" v-for="file in projectItem.files" :key="file.id">
                                        <div class="list-btn" type="button" data-bs-toggle="modal" data-bs-target="#file-actions"><i class="bi bi-three-dots-vertical"></i></div>
                                        <div class="title">
                                            <img src="../../assets/images/files.png" :alt="file.file_name" />
                                            <span>{{ file.file_name }}</span>
                                        </div>
                                        <button @click="openFile(file.file)">Open</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <!-- pop-up form -->
      <div class="modal fade" id="addTaskForm" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title text-dark" id="ModalLabel">Add New Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form @submit.prevent="addTask">
                <div class="mb-3">
                    <label class="form-label">Project</label>
                    <input type="text" class="form-control" v-model="dataInput.project_id" disabled style="display: none;"/>
                    <input type="text" class="form-control" :value="projectItem.project_title" disabled />
                </div>
                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input type="text" class="form-control" v-model="dataInput.task_title"/>
                    <div class="form-text">Write a short title of the task.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <VueDatePicker v-model="dataInput.deadline" :min-date="new Date()" :enable-time-picker="false" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" rows="5" class="form-control" v-model="dataInput.description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Assign To</label>
                    <select class="form-select" v-model="dataInput.employee_id">
                        <option v-for="name in employee" :key="name.id" :value="name.id"> {{ name.user.name }}</option>
                        
                    </select>
                </div>
                <button type="submit" class="btn btn2" v-if="dataInput.task_title" data-bs-dismiss="modal">{{ isEditing ? 'Save Changes' : 'Add Task' }}</button>
              </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
              </div>
          </div>
        </div>
      </div>
    </main>
</template>



<script>
    import { useProjectStore } from '../../stores/projectStore';
    import { useTaskStore } from '../../stores/taskStore';
    import { useDepartmentStore } from '../../stores/departmentStore';
    import { useEmployeeStore } from '../../stores/employeeStore';
    import axiosClient from '../../axios';
    import { MDBTable, MDBBtn, MDBBadge } from 'mdb-vue-ui-kit';
    import { useFileStore } from '../../stores/fileStore';
    import { useToast } from 'vue-toastification'


    export default {
        name: "ProjectTask",

        components: {
            MDBTable,
            MDBBtn,
            MDBBadge

        },

        props: ["employee"],

        data() {
            var userData = JSON.parse(localStorage.getItem('user'))

            return {
                date: new Date(),
                user: userData,
                projectStore: useProjectStore(),
                taskStore: useTaskStore(),
                employeeStore: useEmployeeStore(),
                departmentStore: useDepartmentStore(),
                fileStore: useFileStore(),
                toast: useToast(),
                projectItem: "",
                projectTasks: "",
                dataInput: {
                    project_id: "",
                    employee_id: "",
                    task_title: "",
                    deadline: "",
                    description: "",
                    file_name: "",
                    file: ""
                },
                fileUrl: "",
                isEditing: false

            };
        },
        mounted(){
            var id = this.$route.params.id;
            
            this.singleProject(id)
            this.employeeStore.getEmployees()
            this.dptEmployees()
            

            this.assignedEmp(id)

           
            


        },

        methods: {
            singleProject(id){
                try {
                    axiosClient.get("/projects/"+id)
                    .then((res) => {
                        this.projectItem = res.data
                        this.dataInput.project_id = this.projectItem.id
                        this.projectTasks = this.projectItem.tasks

                        console.log(this.projectTasks)
                    })

                } catch (error) {
                    console.log(error)
                }
                
            },

            

            addTask(){
                // this.isEditing = !this.isEditing
                this.isEditing ? axiosClient.post("/tasks/"+this.dataInput.id, this.dataInput, {headers: {"Content-Type":"multipart/form-data"}})  : this.taskStore.addTask(this.dataInput)
                console.log(this.dataInput)
                this.dataInput = {
                    task_title: "",
                    deadline: "",
                    description: "",
                }

                this.isEditing ? this.toast.success("Task Updated", {timeout: 2000}) : null

                window.location.reload()

            },


            editTask(task){
                this.dataInput = task
                this.isEditing = true
            },

            
            dptEmployees(){
                this.employeeStore.getEmployeesByDpt(this.projectItem.department_id)
            },


            assignedEmp(id){
                this.taskStore.getTasks()
                this.taskStore.tasks.find((item) => {
                    console.log(item.employee)
                })
            },


            submitFileForm(){
                this.fileStore.addFile(this.dataInput)
                
                // .then(()=>{
                //     window.location.reload()
                // })

                
            },


            onSelectFile(event){
                const file = event.target.files[0];

                this.dataInput.file = file;
            },


            openFile(file) {
                if(file) {
                    let url = this.projectItem.file;
                    url = new URL('../../../../../../public' + file, import.meta.url).href;
                    window.open(url);
                }
            },
        },
        computed: {
            
        }
    }
</script>


<style scoped>

    .main-content {
        margin: 2rem;
        margin-right: 3rem;
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

    }

    .nav-color button:hover {
        color: #81BE41;
        background-color: #82be411c;
        padding: 15px;
        margin: 0 15px;
    }

    .project-description {
      min-height: 33vh;
    }

    .project-files .upload-btn button {
        border: 1px solid #7dc530;
        padding: 2px 15px;
        border-radius: 5px;
    }

    .project-files .files {
        border: 1px solid #366208ec;
        width: 13rem;
        height: 15rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        border-radius: 10px;
        margin: 20px 10px;
    }

    /* .project-files-body .custom-modal{
        position: relative;
        border: 1px solid red;
        width: 100px;
    } */

    .project-files .files .list-btn {
        position: absolute;
        right: 10px;
        top: 10px;
    }

    .project-files .files .title {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;

    }

    .project-files .files button {
        border: 1px solid #4f8d0d;
        margin-top: 1rem;
        padding: 2px 13px;
        border-radius: 5px;

    }

    .project-files button:hover {
        background-color: #7dc53031;
        
    }

    .project-files .files img {
        width: 80px;
        margin-bottom: 10px;
    }

    .project-description hr {
        width: 64vw;
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #939191;
        margin: 0 auto;
        padding: 0;
    }

    .nav-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-header-btn {
       color: #2F5508;
        font-weight: 600;
        font-size: 15px;
        padding: 10px;
        margin: 0 15px ;
        border-left: 1px solid lightgray;
        border-top: 1px solid lightgray;
        border-right: 1px solid lightgray;
    }

    .project-details h4 {
        font-weight: 600;
        font-size: 20px;
    }

    .project-details p {
        width: 50vw;
    }

    .task-table {
      margin: auto;
    }

    form button {
        color: #2F5508;
        border: 1px solid #2e55089e;
        padding: 0.5rem;
        border-radius: 5px;
        font-weight: 600;
    }

    .assignee {
        display: flex;
        align-items: center;

    }
</style>