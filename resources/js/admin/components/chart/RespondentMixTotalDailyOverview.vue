<script>
  import {
    Bar,
    Line
  } from 'vue-chartjs';

  export default {
    extends: Bar,
    props: {
      chartDatasets: {
        type: Object,
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
              type: 'bar',
              label: 'Complete',
              fill: false,
              data: this.chartDatasets.complete,
              backgroundColor: '#2ecc71',
              borderColor: '#2ecc71',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: '#FD6382',
              borderWidth: 3,
              pointRadius: 0,
              pointHoverRadius: 3,
            },
            {
              type: 'bar',
              label: 'Survey Preference',
              fill: false,
              data: this.chartDatasets.survey_preference,
              backgroundColor: '#3498db',
              borderColor: '#3498db',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: 'rgb(0,123,255)',
              borderWidth: 3,
              pointRadius: 0,
              pointHoverRadius: 3,
            },
            {
              type: 'bar',
              label: 'Opinion',
              fill: 'start',
              data: this.chartDatasets.opinion,
              backgroundColor: '#9b59b6',
              borderColor: '#9b59b6',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: 'rgb(0,123,255)',
              borderWidth: 1.5,
              pointRadius: 0,
              pointHoverRadius: 3,
            },
            {
              type: 'bar',
              label: 'Social Data',
              fill: 'start',
              data: this.chartDatasets.social_data,
              backgroundColor: '#f1c40f',
              borderColor: '#f1c40f',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: 'rgb(0,123,255)',
              borderWidth: 1.5,
              pointRadius: 0,
              pointHoverRadius: 3,
            },
            {
              type: 'bar',
              label: 'Travel Return',
              fill: 'start',
              data: this.chartDatasets.travel_return,
              backgroundColor: '#e74c3c',
              borderColor: '#e74c3c',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: 'rgb(0,123,255)',
              borderWidth: 1.5,
              pointRadius: 0,
              pointHoverRadius: 3,
            },
            {
              type: 'bar',
              label: 'Travel Leave',
              fill: 'start',
              data: this.chartDatasets.travel_leave,
              backgroundColor: '#e67e22',
              borderColor: '#e67e22',
              pointBackgroundColor: '#ffffff',
              pointHoverBackgroundColor: 'rgb(0,123,255)',
              borderWidth: 1.5,
              pointRadius: 0,
              pointHoverRadius: 3,
            }
          ]
        },
        options: {
          scales: {
            xAxes: [{
              gridLines: false,
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
