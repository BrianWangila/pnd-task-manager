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
          <h4 class=" fw-bolder">{{ projectItem.project_title }}</h4>
          <div>
              <button class="mr-3"><router-link to="/projects"  style="color: black; font-weight: 500;"><i class="bi bi-arrow-left-short"></i> Back to Projects</router-link></button>
              <button><span class="mr-1" data-bs-toggle="modal" data-bs-target="#addProjectForm">Update Project</span>  <i class="bi bi-pencil-square"></i></button>
          </div>
        </div>

        <div class="pl-5 pt-3 h-300">
            <div class="priority mb-2">
                <p class="mr-20" style="font-weight: 600;">Priority:</p> <p class="priority-flag"><i class="bi bi-flag"></i> Normal</p>
            </div>
            <div class="assigned mb-2">
                <p style="margin-right: 5px; font-weight: 600;">Assigned To:</p>
                <ul>
                    <li>Brian Wangila</li>
                    <li>Laura Cherop</li>
                    <li>Kevin Maingi</li>
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
      <ProjectTasks :projectItem="projectItem" style="position: inherit"/>

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
    return {
      date: new Date(),
      projectStore: useProjectStore(),
      taskStore: useTaskStore(),
      projectItem: "",
      projectTasks: "",
      input_data: {
        task_title: "",
        deadline: "",
        description: ""
      },

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

          console.log(this.projectItem)


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

</style>