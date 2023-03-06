<template>
  <main>
    <div class="heading">
      <div>
        <h2 style="font-size: 30px; font-weight: 600;"><span style="font-size: 25px; font-weight: 500;"></span>All Briefs/Projects</h2>
        
        <P style="font-weight: 500;">Home / <span style="font-weight: 400;">Projects</span></P>
      </div>
      <div>
        <div className="btn-group">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-calendar"></i> Today
          </button>
          <ul className="dropdown-menu" >
            <li><DatePicker v-model="date" /></li>
          </ul>
        </div>

        <div className="btn-group" style="margin-left: 20px;">
          <button type="button" className="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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

      <div>
        {{ project_store.projects }}
      </div>

      
      <hr class="footer-divider">

      <footer>
        <p> &copy; Copyright <span style="color:#2F5508; font-weight: 600;">Peak&Dale</span>. All Rights Reserved <br/>
            Designed by <span style="color: #81BE41">Peak&Dale</span></p>
      </footer>
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
      time: null,
      project_store: useProjectStore(),
    };
  },

  mounted(){
    const today = new Date()
    this.time = today.getHours()
    this.project_store.getProjects()
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


</style>