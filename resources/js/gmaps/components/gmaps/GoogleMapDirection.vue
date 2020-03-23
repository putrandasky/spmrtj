<script>
export default {
    props: {
        google: {
            type: Object,
            required: true
        },
        map: {
            type: Object,
            required: true
        },
        originPoint: {
            type: String
        },
        destinationPoint: {
            type: String
        },
        lineColor: {
            type: String,
            default:'rgb(52, 152, 219)'
        },
        zIndex: {
            type: Number,
            default:1
        }
    },
    data() {
        return {
            directionsService: null,
            directionsDisplay: null
        };
    },
    mounted() {
        this.createDirection();
    },
    computed: {
        combined() {
            return this.originPoint + this.destinationPoint;
        }
    },
    watch: {
        combined(value) {
            this.createDirection();
        }
    },
    methods: {
        createDirection() {
            const { DirectionsService } = this.google.maps;
            const { DirectionsRenderer } = this.google.maps;
             let self = this;
            if (!this.directionsService) {
                this.directionsService = new DirectionsService();
                this.directionsDisplay = new DirectionsRenderer({
                    suppressMarkers: true,
                    preserveViewport: true,
                    polylineOptions: {
                        strokeColor: self.lineColor,
                        zIndex:self.zIndex
                    }
                });
            }


            this.directionsDisplay.setMap(this.map);
            this.directionsService.route(
                {
                    origin: this.originPoint,
                    destination: this.destinationPoint,
                    travelMode: "DRIVING",
                    avoidTolls: true
                },
                function(response, status) {
                    if (status === "OK") {
                        self.directionsDisplay.setDirections(response);
                    } else {
                        window.alert(
                            "Directions request failed due to " + status
                        );
                    }
                }
            );
        }
    },

    render() {}
};
</script>
