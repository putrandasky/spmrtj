<script>
import { Bar, Line } from "vue-chartjs";

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
    data: function() {
        return {
            chartdata: {
                labels: this.chartLabel,
                datasets: [
                    // {
                    //     type: "line",
                    //     label: "Cumm Total",
                    //     yAxisID: "Cummulative",
                    //     fill: false,
                    //     data: this.chartDatasets.respondent_cummulative,
                    //     backgroundColor: "#F70302",
                    //     borderColor: "#F70302",
                    //     pointBackgroundColor: "#ffffff",
                    //     pointHoverBackgroundColor: "#FD6382",
                    //     borderWidth: 1,
                    //     pointRadius: 0,
                    //     pointHoverRadius: 3
                    // },
                    {
                        type: "line",
                        label: "Cumm Valid",
                        yAxisID: "Cummulative",
                        fill: false,
                        data: this.chartDatasets.respondent_cummulative_valid,
                        backgroundColor: "#24478c",
                        borderColor: "#24478c",
                        pointBackgroundColor: "#ffffff",
                        pointHoverBackgroundColor: "rgb(0,123,255)",
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 3
                    },
                    // {
                    //     type: "bar",
                    //     label: "Inc Total",
                    //     yAxisID: "Increment",
                    //     fill: "start",
                    //     data: this.chartDatasets.respondent_increment,
                    //     backgroundColor: "#FD6382",
                    //     borderColor: "#FD6382",
                    //     pointBackgroundColor: "#ffffff",
                    //     pointHoverBackgroundColor: "rgb(0,123,255)",
                    //     borderWidth: 1,
                    //     pointRadius: 0,
                    //     pointHoverRadius: 3
                    // },
                    {
                        type: "bar",
                        label: "Inc Valid",
                        yAxisID: "Increment",
                        fill: "start",
                        data: this.chartDatasets.respondent_increment_valid,
                        backgroundColor: "#41B64C",
                        borderColor: "#41B64C",
                        pointBackgroundColor: "#ffffff",
                        pointHoverBackgroundColor: "rgb(0,123,255)",
                        borderWidth: 1,
                        pointRadius: 0,
                        pointHoverRadius: 3
                    }
                ]
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
                            gridLines: false,
                            ticks: {
                                fontSize: 10
                            },
                            scaleLabel: {
                                display: true,
                                labelString: "Date"
                            }
                        }
                    ],
                    yAxes: [
                        {
                            id: "Cummulative",
                            type: "linear",
                            position: "left",
                            gridLines: true,
                            scaleLabel: {
                                display: true,
                                labelString: "Respondent"
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
                        },
                        {
                            id: "Increment",
                            type: "linear",
                            position: "right",
                            gridLines: false,
                            ticks: {
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
    mounted() {
        this.renderChart(this.chartdata, this.options);
    }
};
</script>
<style></style>
