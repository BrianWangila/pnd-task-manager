<template>
  <main class="side-calendar">
    <div class="cal-image">
      <img src="../assets/images/calendar.png" alt="side-calendar" />
    </div>
    <div>
      <h4 style="font-weight: 600; color: #2F5508;">Calendar</h4>
      <p>Upcoming projects and tasks</p>
      
      <div>
        <!-- <Calendar /> -->
        <DatePicker @click="calendarData" v-model="date" />

      </div>
    </div>
    <footer>
      <p>&copy; Peak and Dale</p>
    </footer>
  </main>
</template>


<script>
  import { Calendar, DatePicker } from 'v-calendar';

  export default {
    components: {
      Calendar,
      DatePicker,
    },
    data() {
      return {
        date: new Date(),
        
      };
    },


    methods: {
      calendarData(){
        console.log(this.date)

        
      },
    },

    

  }
</script>



<style scoped>
  .side-calendar {
    position: relative;
    left: 82vw;
    top: 8vh;
    border-left: 1px solid rgba(217, 217, 217, 0.4);
    padding: 50px;
    width: 18vw;
    height: 92vh;
    text-align: center;
    
  }

  footer {
    display: flex;
    justify-content: center;

  }

  footer p {
    position: absolute;
    bottom: 0;
    color: #81BE41;
  }

  .side-calendar .cal-image {
    display: flex;
    justify-content: center;
  }
  .side-calendar img {
    width: 20vw;
    height: 20vh;
    margin: 5vh;
  }
</style>