<script>
  import {
    Pie, Doughnut
  } from 'vue-chartjs';

  export default {
    extends: Doughnut,
    props: {
      chartData: {
        type: Array,
        default: null
      },
    },
    data: function () {
      return {

        chartdata: {
          labels: this.chartData.map(data => data.description),
          datasets: [{
            label: 'Gender',
            data: this.chartData.map(data => data.respondents_count),
            hoverBorderColor: '#ffffff',
            backgroundColor: [
              '#24478c',
              '#41B64C',
            ],
          }]
        },
        options: {
          legend: {
            position: 'right',
            labels: {
              padding: 10,
              boxWidth: 5,
            },
          },
          cutoutPercentage: 0,
          tooltips: {
            custom: false,
            mode: 'index',
            position: 'nearest',
          },

        }
      }
    },
    mounted() {
      this.renderChart(this.chartdata, this.options)
    }
  }

</script>
<style>
</style>
