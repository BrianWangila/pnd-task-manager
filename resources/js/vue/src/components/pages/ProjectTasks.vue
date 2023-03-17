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
                        <button class="nav-header-btn"><span class="mr-1" data-bs-toggle="modal" data-bs-target="#addTaskForm">Create Task</span>  <i class="bi bi-pencil-square"></i></button> 
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
                            <h4 class="mb-1">Tasks Related to this Project</h4>
                            <MDBTable hover class="align-middle bg-white task-table">
                                <thead class="bg-light bg-red">
                                    <tr>
                                        <th class="fw-bold">Project Title</th>
                                        <th class="fw-bold">Description</th>
                                        <th class="fw-bold">Status</th>
                                        <th class="fw-bold">Date Assigned</th>
                                        <th class="fw-bold">Assignee</th>
                                        <th class="fw-bold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                    <tr  v-for="task in projectTasks" :key="task.id">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <span class="mb-1" style="font-weight: 500;">{{ task.task_title }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-normal">{{ task.description }}</span>
                                        </td>
                                        <td>
                                            <MDBBadge badge="success" pill class="d-inline">In Progress</MDBBadge>
                                        </td>
                                        <td>{{ new Date(task.deadline).toDateString() }}</td>
                                        <td>
                                            <div class="assignee">
                                                <img class="rounded-circle" src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" >
                                                <div class="ms-3" style="display: flex; flex-direction: column;">
                                                    <span class="fw-bold mb-1">John Doe</span>
                                                    <span class="text-muted mb-0">john.doe@gmail.com</span>
                                                </div>
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
                    <input type="text" class="form-control" v-model="data_input.project_id" disabled/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input type="text" class="form-control" v-model="data_input.task_title"/>
                    <div class="form-text">Write a short title of the task.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" class="form-control" v-model="data_input.deadline"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" rows="5" class="form-control" v-model="data_input.description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Assign To</label>
                    <select class="form-select" v-model="data_input.employee_id">
                        <option v-for="name in employee" :key="name.id" :value="name.id"> {{ name.user.name }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn2" v-if="data_input.task_title">Submit</button>
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


export default {
    name: "ProjectTask",

    components: {
        MDBTable,
        MDBBtn,
        MDBBadge

    },

    props: ["employee"],

    data() {
        return {
            date: new Date(),
            projectStore: useProjectStore(),
            taskStore: useTaskStore(),
            employeeStore: useEmployeeStore(),
            departmentStore: useDepartmentStore(),
            projectItem: "",
            projectTasks: "",
            data_input: {
                project_id: "",
                employee_id: "",
                task_title: "",
                deadline: "",
                description: "",
            },

        };
    },
    mounted(){
        var id = this.$route.params.id;
        
        this.singleProject(id)
        this.employeeStore.getEmployees()
        this.dptEmployees()

    },

    methods: {
        singleProject(id){
            try {
                axiosClient.get("/projects/"+id)
                .then((res) => {
                    this.projectItem = res.data
                    this.data_input.project_id = this.projectItem.id
                    this.projectTasks = this.projectItem.tasks

                    console.log(this.projectItem.department_id)
                })
            } catch (error) {
                console.log(error)
            }
        },
        addTask(){
            this.taskStore.addTask(this.data_input)

            this.data_input = {
                task_title: "",
                deadline: "",
                description: "",
            }

            window.location.reload()

        },
        dptEmployees(){
            this.employeeStore.getEmployeesByDpt(this.projectItem.department_id)
        }
    },
    computed: {
        // selectedTitle(){
        //     const p_title = this.projectItem.find((project) => {
        //         project.project_id === this.data_input.project_id
        //     })
        //     return p_title ? p_title.project_title : "";
        // }
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