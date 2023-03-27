<template>
    <main>
      <div class="heading">
        <div style="min-height: 8.5vh;">
          <h2 style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>Projects Schedule</h2>
          
          <P style="font-weight: 500;">Home / <span style="font-weight: 400;"></span>Calendar</P>
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
                        <h4 class=" fw-bolder fs-5 mt-2">Calendar Schedule</h4>
                    </div>

                    <div class="projects ">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            
    
            <div class="divider">
            <hr class="footer-divider">
    
            <footer>
                <p> &copy; Copyright <span style="color:#2F5508; font-weight: 600;">Peak&Dale</span>. All Rights Reserved <br/>
                    Designed by <span style="color: #81BE41">Peak&Dale</span>
                </p>
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
    // import calendar from '../../calendar/calendar';
  
  
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
      toggle(index) {
        this.isOpen = !this.isOpen
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
      margin-left: 25px;
      min-height: 55vh;
      max-height: 55vh;
      overflow-y: auto;
    }

    .projects h4 {
        font-size: 18px;
        font-weight: bolder;
        text-align: center;
        position: relative;
        top: 10vh;
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
      width: 64.5vw;
    }
  
    .add-project button {
      color: #2F5508;
      border: 1px solid lightgrey;
      padding: 0.5rem;
      border-radius: 5px;
      font-weight: 600;
    }
  
    .files-image {
        border: 1px solid lightgray;
        width: 16rem;
        height: 18rem;
        margin-top: 2vh;
        border-radius: 10px;
        background: white;
        margin-left: 1vw;
        margin-right: 0.5vw;
    }

    .file-image1 {
        text-align: center;
        position: relative;
        top: 4vh;
    }

    .file-image1 p {
        width: 10vw;
        margin: auto;
        margin-top: 1vh;
        margin-bottom: 2vh;
    }

    .file-image1 button {
        border: 1px solid #75c8215d;
        padding: 5px 30px;
        border-radius: 5px;
    }

    .empty-file {
        border: 1 px solid lightgray;
        /* background: white; */
        width: 20vw;
        margin: auto;
        padding: 2rem;
        border-radius: 10px;
        position: relative;
        top: 10vh;
    }

    .empty-file p {
        margin-top: 3vh;
        text-align: center;
        font-size: 15px;
    }
  
  
  </style>