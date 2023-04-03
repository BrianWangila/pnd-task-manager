<template>
  <Doughnut :data="data" :options="options" class="donut-size"/>
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import * as chartConfigRate from './chatconfigRate'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'AdminDonut',
  components: {
    Doughnut
  },
  data() {
    return chartConfigRate
  },
  
}
</script>





<style scoped>

  .donut-size {
    height: 110px;
  }

</style>