<template>
    <AppLayout title="Statistics">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Statistics
            </h2>
        </template>
        <div class="w-[100%] h-[100%] rounded-3xl bg-white dark:bg-gray-700">
  <Bar class="p-3 h-auto w-[75%] rounded-3xl mt-[7%] ml-[10%] overflow-y-auto no-scrollbar bg-gray-100"
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />
</div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

      const chartData = {
        labels: [ 'January', 'February', 'March' ],
        datasets: [ 
            {
                label: 'Data One',
                backgroundColor: '#f87979', 
                data: [40, 20, 12]
             },
             {
                label: 'Data Two',
                backgroundColor: 'blue', 
                data: [20, 10, 6]
             } 
            ]
      }

      const chartOptions = {
        responsive: false
      }


</script>
