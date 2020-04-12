<script>
  import {
    Line
  } from 'vue-chartjs'

  export default {
    extends: Line,
    props: {
      chartDatasets: {
        type: Array,
        default: null
      },
      chartLabel: {
        type: Array,
        default: null
      }
    },
    data: function () {
      return {

        chartdata: {
          labels: this.chartLabel,
          datasets: [{
            label: 'Cummulative',
            fill: 'start',
            data: this.chartDatasets,
            backgroundColor: 'rgba(0,123,255,0.1)',
            borderColor: 'rgba(0,123,255,1)',
            pointBackgroundColor: '#ffffff',
            pointHoverBackgroundColor: 'rgb(0,123,255)',
            borderWidth: 1.5,
            pointRadius: 0,
            pointHoverRadius: 3,
          }]
        },
        options: {

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
