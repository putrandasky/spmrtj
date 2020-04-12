<script>
  import {
    Bar
  } from 'vue-chartjs'

  export default {
    extends: Bar,
    props: {
      chartData: {
        type: Array,
        default: null
      },

    },
    data: function () {
      return {

        chartdata: {
          labels: this.chartData.map(data => data.frequence),
          datasets: [{
            label: 'Total Valid',
            fill: 'start',
            data: this.chartData.map(data => data.total),
            backgroundColor: '#9A67FD',
            borderColor: '#9A67FD',
            pointBackgroundColor: '#ffffff',
            pointHoverBackgroundColor: 'rgb(0,123,255)',
            borderWidth: 1.5,
            pointRadius: 0,
            pointHoverRadius: 3,
          }]
        },
        options: {
    scales: {
        yAxes: [{
              ticks: {
                callback(tick) {
                  if (tick === 0) {
                    return tick;
                  }
                  if (Math.floor(tick) === tick) {
                    return tick;
                  }
                },
              },
        }]
    },
      responsive: true,
      maintainAspectRatio: false,
        hover: {
          mode: 'nearest',
          intersect: false,
        },
        tooltips: {
          custom: false,
          mode: 'nearest',
          intersect: false,
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
