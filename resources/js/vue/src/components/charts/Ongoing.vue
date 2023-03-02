<template>
  <LineWithLineChart :data="data" :options="options"/>
</template>

<script lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
Colors
} from 'chart.js'
import LineWithLineChart from './LineWithLineChart.js'
import * as chartConfig from './areaConfig.js'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

export default {
  name: 'Ongoing',
  components: {
    LineWithLineChart
  },
  data() {
    return chartConfig
  },
 
}
</script>
