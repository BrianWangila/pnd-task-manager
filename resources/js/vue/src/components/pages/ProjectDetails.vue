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
        <h4 class=" fw-bolder">Frontend Web Development</h4>
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
        <div>
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

        <div class="project-description">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-left">
                <ul id="portfolio-filters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-card">Card</li>
                    <li data-filter=".filter-web">Web</li>
                </ul>
                </div>
            </div>

            <div class="row portfolio-container">
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>App</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>App</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-wrap">
                    <div class="portfolio-info">
                    <h4>Card 2</h4>
                    <p>Card</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>Web 2</h4>
                            <p>Web</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                        <h4>App 3</h4>
                        <p>App</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>Card 1</h4>
                            <p>Card</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>Card 3</h4>
                            <p>Card</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
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


export default {
  components: {
    Calendar,
    DatePicker,

  },
  
  data() {
    return {
      date: new Date(),
      projectStore: useProjectStore(),
      projectItem: "",

    };
  },
  mounted(){

    var id = this.$route.params.id;

    this.projectStore.singleProject(id)
    this.projectItem = this.projectStore.projectItem

    console.log(this.projectItem)

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


    .projects {
        flex:1; 
        margin-left: 25px;
        /* display: flex;
        flex-direction: row; */
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

    .text-dark {
        text-align: center;
        color: red;
    }
    .card-title {
        background-color: rgba(255, 165, 0, 0.12);
        color: #FFA500;
        padding: 10px;
        border-radius: 15px;
        font-weight: 600;
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

    .btn2 {
        border: 1px solid #81BE41;
    }

    .main-content {
        margin: 2rem;
    }



    /* Project details styling */
    #portfolio-filters {
        padding: 0;
        margin: 5vh 0 20px 0;
        list-style: none;
        border-radius: 50px;
        padding: 2px 15px;
    }

    #portfolio-filters li {
        cursor: pointer;
        display: inline-block;
        padding: 8px 16px 10px 16px;
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
        text-transform: uppercase;
        color: #000;
        background: rgba(255, 255, 255, 0.1);
        margin: 0 3px 10px 3px;
        transition: all 0.3s ease-in-out;
        border-radius: 4px;
    }

    #portfolio-filters li:hover,
    #portfolio-filters li.filter-active {
        background: #82be4156;
    }

    #portfolio-filters li:last-child {
        margin-right: 0;
    }

    .portfolio-wrap {
        transition: 0.3s;
        position: relative;
        overflow: hidden;
        z-index: 1;
        background: rgba(0, 0, 0, 0.6);
    }

    .portfolio-wrap::before {
        content: "";
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        left: 30px;
        right: 30px;
        top: 30px;
        bottom: 30px;
        transition: all ease-in-out 0.3s;
        z-index: 2;
        opacity: 0;
    }

    .portfolio-wrap .portfolio-info {
        opacity: 60;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        z-index: 3;
        transition: all ease-in-out 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .portfolio-wrap .portfolio-info::before {
        display: block;
        content: "";
        width: 48px;
        height: 48px;
        position: absolute;
        top: 35px;
        left: 35px;
        border-top: 3px solid #fff;
        border-left: 3px solid #fff;
        transition: all 0.5s ease 0s;
        z-index: 9994;
    }

    .portfolio-wrap .portfolio-info::after {
        display: block;
        content: "";
        width: 48px;
        height: 48px;
        position: absolute;
        bottom: 35px;
        right: 35px;
        border-bottom: 3px solid #fff;
        border-right: 3px solid #fff;
        transition: all 0.5s ease 0s;
        z-index: 9994;
    }

    .portfolio-wrap .portfolio-info h4 {
        font-size: 20px;
        color: #fff;
        font-weight: 600;
    }

    .portfolio-wrap .portfolio-info p {
        color: #ffffff;
        font-size: 14px;
        text-transform: uppercase;
        padding: 0;
        margin: 0;
    }

    .portfolio-wrap .portfolio-links {
        text-align: center;
        z-index: 4;
    }

    .portfolio-wrap .portfolio-links a {
        color: #fff;
        margin: 0 2px;
        font-size: 28px;
        display: inline-block;
        transition: 0.3s;
    }

    .portfolio-wrap .portfolio-links a:hover {
        color: #63eda3;
    }

    .portfolio-wrap:hover::before {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 1;
    }

    .portfolio-wrap:hover .portfolio-info {
        opacity: 1;
    }

    .portfolio-wrap:hover .portfolio-info::before {
        top: 15px;
        left: 15px;
    }

    .portfolio-wrap:hover .portfolio-info::after {
        bottom: 15px;
        right: 15px;
    }


</style>