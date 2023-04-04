<template>
    <main>
      <div class="heading">
        <div style="min-height: 8.5vh;">
          <h2 style="font-size:25px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Files</h2>
          
          <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Files</span></P>
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
                  <div class="card add-project ml-6 mt-3 mb-3">
                      <h4 class=" fw-bolder fs-5 mt-2">Project Files</h4>
                  </div>
 
                  <div class="projects project-files">
                      <div class="ml-2">
                        <div class="row col-12" v-if="fileStore.files.length > 0">
                          <div class="card files" v-if="user.role == 'admin'" v-for="file in fileStore.files" :key="file.id" :title="file.project.project_title">
                              <div class="list-btn" type="button" data-bs-toggle="modal" data-bs-target="#file-actions"><i class="bi bi-three-dots-vertical"></i></div>
                              <div class="title">
                                  <img src="../../assets/images/files.png" :alt="file.file_name" />
                                  <span>{{ file.file_name }}</span>
                              </div>
                              <button @click="openFile(file.file)">Open</button>
                          </div>
                          
                          <div class="card files" v-else v-for="file1 in projectStore.projectsByDpt" :key="file1.id" :title="file1.project_title">
                              <div class="list-btn" type="button" data-bs-toggle="modal" data-bs-target="#file-actions"><i class="bi bi-three-dots-vertical"></i></div>
                              <div style="display: flex; flex-direction: column; justify-content: center;" v-for="file in file1.files" :key="file.id">
                                <div class="title">
                                    <img src="../../assets/images/files.png" :alt="file.file_name" />
                                    <span>{{ file.file_name }}</span>
                                </div>
                                <button @click="openFile(file.file)">Open</button> 
                              </div>
                          </div>
                        </div>

                        <div v-else>
                            <h4>ThERE ARE NO FILES ADDED!</h4>
                            <div class="empty-file">
                                <div class="empty-file-image1">
                                    <center><img src="../../assets/images/empty-file.png" alt="empty files" /></center>
                                    <p> All the files and documents for the projects <br/> and tasks will appear here. </p>
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
    import { useFileStore } from '../../stores/fileStore';
  
  
    export default {
        components: {
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
              time: null,
              projectStore: useProjectStore(),
              departmentStore: useDepartmentStore(),
              fileStore: useFileStore(),
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
            const today = new Date();
            this.time = today.getHours();
            this.projectStore.getProjects();
            this.departmentStore.getDepartments();
            this.fileStore.getFiles();


            console.log(this.fileStore.files)
      
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

          openFile(file) {
              if(file) {
                  let url = this.fileStore.files;
                  url = new URL('../../../../../../public' + file, import.meta.url).href;
                  window.open(url);
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


  .project-files .upload-btn button {
        border: 1px solid #7dc530;
        padding: 2px 15px;
        border-radius: 5px;
    }

    .project-files .files {
        border: 1px solid #4f8d0d;
        width: 14rem;
        height: 15rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        border-radius: 10px;
        margin: 20px 10px;
    }

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
        border: 1px solid #7dc5309c;
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


</style>