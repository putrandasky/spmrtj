<script>
  import {
    Pie, Doughnut
  } from 'vue-chartjs';

  export default {
    extends: Doughnut,
    props: {
      label: {
        type: Array,
        default: null
      },
      data: {
        type: Array,
        default: null
      },
    },
    data: function () {
      return {

        chartdata: {
          labels: this.label,
          datasets: [{
            label: 'Gender',
            data: this.data,
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
