<script>
  import {
    HorizontalBar
  } from 'vue-chartjs'

  export default {
    extends: HorizontalBar,
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
            label: 'Total Valid',
            fill: 'start',
             xAxisID: 'Total',
            data: this.chartData.map(data => data.respondents_count),
            backgroundColor: '#FE9E42',
            borderColor: '#FE9E42',
            pointBackgroundColor: '#ffffff',
            pointHoverBackgroundColor: 'rgb(0,123,255)',
            borderWidth: 1.5,
            pointRadius: 0,
            pointHoverRadius: 3,
          }]
        },
        options: {
          scales: {

            xAxes: [{
              id: 'Total',
              type: 'linear',
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
            }],
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
