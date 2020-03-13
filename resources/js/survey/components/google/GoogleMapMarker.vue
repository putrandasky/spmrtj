<script>
import { POINT_MARKER_ICON_CONFIG } from "../../constants/mapSettings";
import { EventBus } from "@/survey/event.js";

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
        // markerData: {
        //   type: Object,
        //   required: true
        // },
        sizeIcon: {
            type: Number,
            required: true
        },
        zIndexIcon: {
            type: Number,
            required: true
        },
        markerIcon: String
    },
    data() {
        return {
            markerData: {},
            marker: null
        };
    },

    mounted() {
        this.createMarker();
        let self = this;
        EventBus.$on("addMarker", data => {
            self.markerData = data.location;
            console.log("TCL: mounted -> self.markerData", self.markerData);

            this.createMarker();
            this.defineArea(data.location, data.point);
        });
        EventBus.$on("removeGoogleMapData", data => {
            self.markerData = {};
            this.removeMarker();
        });
    },
    watch: {
        markerData(newVal, oldVal) {
            console.log("watch: markerData -> newVal", newVal);

            if (oldVal) {
                // this.removeMarker()
                this.createMarker();
            }
        }
    },
    methods: {
        createMarker() {
            const { Marker } = this.google.maps;
            const { Size } = this.google.maps;
            const { Point } = this.google.maps;

            let image = {
                url: this.markerIcon || null,
                scaledSize: new Size(this.sizeIcon, this.sizeIcon)
                // origin : new Point(0,0),
                // anchor : new Point(0,50)
            };
            if (this.marker) {
                this.marker.setPosition(this.markerData);
                this.map.panTo(this.markerData);
                this.map.setZoom(13);
                // console.log('1');
            } else {
                // console.log('2');
                this.marker = new Marker({
                    // position: this.markerData,
                    // title: this.markerData.title,
                    // marker: this.markerData,
                    map: this.map,
                    zIndex: this.zIndexIcon,
                    icon: image
                    //   icon: POINT_MARKER_ICON_CONFIG
                });
            }
        },
        defineArea(position, point) {
            console.log("TCL: defineArea -> point", point);
            let polyParkir = new self.google.maps.Polygon({
                paths: this.getPath("parkir")
            });
            let polyCycle = new this.google.maps.Polygon({
                paths: this.getPath("cycle")
            });
            let polyPedestrian = new this.google.maps.Polygon({
                paths: this.getPath("pedestrian")
            });
            let polyParkRide = new this.google.maps.Polygon({
                paths: this.getPath("park_and_ride")
            });
            let polyFeeder = new this.google.maps.Polygon({
                paths: this.getPath("feeder")
            });
            let latlng = new this.google.maps.LatLng(
                position.lat,
                position.lng
            );
            let isInPolyParkir = this.google.maps.geometry.poly.containsLocation(
                latlng,
                polyParkir
            );
            let isInPolyCycle = this.google.maps.geometry.poly.containsLocation(
                latlng,
                polyCycle
            );
            let isInPolyPedestrian = this.google.maps.geometry.poly.containsLocation(
                latlng,
                polyPedestrian
            );
            let isInPolyParkRide = this.google.maps.geometry.poly.containsLocation(
                latlng,
                polyParkRide
            );
            let isInPolyFeeder = this.google.maps.geometry.poly.containsLocation(
                latlng,
                polyFeeder
            );
            let area = [];
            isInPolyParkir ? area.push(1) : null;
            isInPolyCycle ? area.push(2) : null;
            isInPolyPedestrian ? area.push(3) : null;
            isInPolyParkRide ? area.push(4) : null;
            isInPolyFeeder ? area.push(5) : null;
            console.log("TCL: mounted -> area", area);
            EventBus.$emit("addAreaDropMarker", {
                area: area,
                point: point
            });
        },
        getPath(area) {
            let element = [];
            let coverage = this.$store.state.coverage;
            for (let index = 0; index < coverage[area].length; index++) {
                element[index] = new this.google.maps.LatLng(
                    coverage[area][index]["lat"],
                    coverage[area][index]["lng"]
                );
            }

            return element;
        },
        removeMarker() {
            this.marker.setMap(null);
            this.marker = null;
        }
    },

    render() {}
};
</script>
