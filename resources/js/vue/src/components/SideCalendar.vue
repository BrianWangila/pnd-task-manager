<template>
  <main class="side-calendar">
    <div class="cal-image">
      <img src="../assets/calendar.png" alt="side-calendar" />
    </div>
    <div>
      <h4 style="font-weight: 600;">Calendar</h4>
      <p>Upcoming projects and tasks</p>

      <div>

      </div>
    </div>
  </main>
</template>




<style scoped>
  .side-calendar {
    position: relative;
    left: 82vw;
    top: 8vh;
    border-left: 1px solid rgba(128, 128, 128, 0.189);
    padding: 50px;
    width: 18vw;
    height: 92vh;
    text-align: center;
    
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