<template>
  <Doughnut :data="data" :options="options"/>
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import * as chartConfig from './chartConfig1.js'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'AdminDonut',
  components: {
    Doughnut
  },
  data() {
    return chartConfig
  },
  
}
</script>