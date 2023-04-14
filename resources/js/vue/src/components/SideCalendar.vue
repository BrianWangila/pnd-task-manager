<template>
  <main class="side-calendar">
    <div class="cal-image" :style="tasks.length != 0 ? {display: 'none'} : null">
      <img src="../assets/images/calendar.png" alt="side-calendar" />
    </div>
    <div>
      <h4 style="font-weight: 600; color: #2F5508;">Calendar</h4>
      <p>Click on date to view upcoming tasks</p>
      
      <div>
        <!-- <Calendar @click="calendarData" v-model="date"/> -->
        <DatePicker @click="calendarData" v-model="date" />

      </div>
      <div style="overflow-y: auto; width: 14vw; max-height: 43vh;">
        <div v-if="tasks.length != 0" class="calendar-tasks" style="" v-for="task in tasks" :key="task.id">
            <div style="display: flex; align-items: center; padding: 0;">
                <img src="../assets/images/meeting.png" :alt="task.task_title">
                <div style="margin-left: -30px; text-align: left;">
                    <div style="font-weight: bold;">{{ task.task_title }} <span v-if="task.status == 'Completed'" style="color: #81BE41; font-size: 12px;">(Complete)</span></div>
                    <div style="font-size: 12px;"><span style="font-weight: bold;">Assignee: </span>{{ task.employee.name }}</div>
                    <div style="font-size: 13px; font-weight: 500;" v-if="task.sub_tasks.length != 0">Subtasks</div>
                    <div v-for="subTask in task.sub_tasks" :key="subTask.id">
                        <li style="font-size: 10px;">{{ subTask.title }} <span v-if="subTask.status == 'complete'" style="color: #81BE41; font-size: 12px;"><i class="bi bi-check2-all"></i></span></li>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="calendar-tasks">
            No tasks are due on this date
        </div>
      </div>
    </div>
    <footer>
      <p>&copy; Peak and Dale</p>
    </footer>
  </main>
</template>


<script>
    import { Calendar, DatePicker } from 'v-calendar';
    import axiosClient from '../axios';


    export default {
        components: {
            Calendar,
            DatePicker,
        },

        data() {
            return {
                date: new Date(),
                tasks: [],
                style: '',
            };
        },

        methods: {

            async calendarData(){
                this.display = "none";
                const year = this.date.getFullYear();
                const month = String(this.date.getMonth() + 1).padStart(2, '0');
                const day = String(this.date.getDate()).padStart(2, '0');

                const formattedDate = `${year}-${month}-${day}`;

                console.log(formattedDate)

                try {
                    await axiosClient.get("/date-tasks/"+formattedDate)
                    .then(res => {
                        this.tasks = res.data;
                        console.log(this.tasks);
                    })

                } catch (error) {
                    console.log(error)
                }

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

  .calendar-tasks {
    border: 1px solid lightgray;
    border-radius: 10px;
    margin-top: 5px;
    width: 13.2vw;
    max-height: 43vh;
    overflow-y: auto;
  }

  .calendar-tasks img {
    width: 50px;
    height: 50px;
    margin-left: 10px;
  }
</style>