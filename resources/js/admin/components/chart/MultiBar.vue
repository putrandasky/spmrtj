<script>
import { Bar, Line } from "vue-chartjs";

export default {
    extends: Bar,
    props: {
        chartDatasets: {
            type: Array,
            default: null
        },
        chartLabel: {
            type: Array,
            default: null
        },
        xLabel: {
            type: String,
            default: null
        },
        yLabel: {
            type: String,
            default: null
        }
    },
    data: function() {
        return {
            userBgColor: [
                "#24478c",
                "#41B64C",
                "#16a085",
                "#f39c12",
                "#d35400",
                "#c0392b",
                "#8e44ad",
                "#34495e",
                "#7f8c8d",
                "#bdc3c7"

            ],
            chartdata: {
                labels: this.chartLabel,
                datasets: []
            },
            options: {
                legend: {
                    position: "top",
                    labels: {
                        padding: 10,
                        boxWidth: 5,
                        fontSize: 8
                    }
                },
                scales: {
                    xAxes: [
                        {
                            display: true,
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                fontSize: 10
                            },
                            scaleLabel: {
                                display: this.xLabel?true:false,
                                labelString: this.xLabel
                            }
                        }
                    ],
                    yAxes: [
                        {
                            id: "left",
                            type: "linear",
                            position: "left",
                            display: true,
                            gridLines: {
                                display: true
                            },
                            scaleLabel: {
                                display: this.yLabel?true:false,
                                labelString: this.yLabel
                            },
                            ticks: {
                                fontSize: 10,
                                callback(tick) {
                                    if (tick === 0) {
                                        return tick;
                                    }
                                    if (Math.floor(tick) === tick) {
                                        return tick;
                                    }
                                }
                            }
                        }
                    ]
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: "nearest",
                    intersect: false
                },
                tooltips: {
                    custom: false,
                    mode: "nearest",
                    intersect: false
                }
            }
        };
    },
    created() {
        for (let i = 0; i < this.chartDatasets.length; i++) {
            console.log(i);
            this.chartdata.datasets.push({
                type: "bar",
                label: this.chartDatasets[i].label,
                yAxisID: "left",
                fill: "start",
                data: this.chartDatasets[i].chartData,
                backgroundColor: this.userBgColor[i],
                borderColor: this.userBgColor[i],
                pointBackgroundColor: "#ffffff",
                pointHoverBackgroundColor: "rgb(0,123,255)",
                borderWidth: 1,
                pointRadius: 0,
                pointHoverRadius: 3
            });
        }
    },
    mounted() {
        this.renderChart(this.chartdata, this.options);
    }
};
</script>
<style></style>
