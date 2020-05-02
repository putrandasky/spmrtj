<script>
import { Bar } from "vue-chartjs";

export default {
    extends: Bar,
    props: {
        labelData: {
            required: true,
            default: null
        },
        label: {
            required: true
        },
        scaleLabel: {
            required: false,
            default: null
        },
        data: {
            required: true,
            default: null
        },
        bgColor: {
            required: false,
            default: "#24478c"
        },
        borderColor: {
            required: false,
            default: "#24478c"
        },
        pointBgColor: {
            required: false,
            default: "#ffffff"
        },
        pointHoverBgColor: {
            required: false,
            default: "rgb(0,123,255)"
        }
    },
    data: function() {
        return {
            chartdata: {
                labels: this.labelData,
                datasets: [
                    {
                        label: this.label,
                        fill: this.label,
                        data: this.data,
                        backgroundColor: this.bgColor,
                        borderColor: this.borderColor,
                        pointBackgroundColor: this.pointBgColor,
                        pointHoverBackgroundColor: this.pointHoverBgColor,
                        borderWidth: 1.5,
                        pointRadius: 0,
                        pointHoverRadius: 3
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [
                        {

                            scaleLabel: {
                                display: this.scaleLabel?true:false,
                                labelString: this.scaleLabel
                            }
                        }
                    ],
                    yAxes: [
                        {
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
