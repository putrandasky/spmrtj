import { EventBus } from "@/gmaps/event.js";
export const CheckArea = {
    data() {
        return {
            // coverage: {
            //     parkir: [],
            //     cycle: [],
            //     pedestrian: [],
            //     park_and_ride: [],
            //     feeder: []
            // }
        };
    },
    created() {

        // EventBus.$on("addCoverage", data => {
        //     this.coverage = data
        //     console.log("created -> coverage", this.coverage)

        // });
    },
    methods: {
        defineArea(position) {
            // console.log("TCL: defineArea -> point", point);
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
            console.log("defineArea -> polyFeeder", this.getPath("feeder"))
            // let latlng = new this.google.maps.LatLng(
            //     position.lat,
            //     position.lng
            // );
            let isInPolyParkir = this.google.maps.geometry.poly.containsLocation(
                position.latlng,
                polyParkir
            );
            let isInPolyCycle = this.google.maps.geometry.poly.containsLocation(
                position.latlng,
                polyCycle
            );
            let isInPolyPedestrian = this.google.maps.geometry.poly.containsLocation(
                position.latlng,
                polyPedestrian
            );
            let isInPolyParkRide = this.google.maps.geometry.poly.containsLocation(
                position.latlng,
                polyParkRide
            );
            let isInPolyFeeder = this.google.maps.geometry.poly.containsLocation(
                position.latlng,
                polyFeeder
            );
            let area = [];
            isInPolyParkir ? area.push(1) : null;
            isInPolyCycle ? area.push(2) : null;
            isInPolyPedestrian ? area.push(3) : null;
            isInPolyParkRide ? area.push(4) : null;
            isInPolyFeeder ? area.push(5) : null;
            console.log("TCL: mounted -> area", area);
            this.$store.dispatch("isLoading", false);
            EventBus.$emit("addMarker", {
                position,area
            });
        },
        getPath(area) {
            let element = [];
            let coverage = this.$store.state.coverage;
            // console.log("getPath -> coverage", this.coverage)
            for (let index = 0; index < coverage[area].length; index++) {
                element[index] = new this.google.maps.LatLng(
                    coverage[area][index]["lat"],
                    coverage[area][index]["lng"]
                );
            }

            return element;
        }
    }
};
