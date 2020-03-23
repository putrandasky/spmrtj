<template>
    <div>
        <div class="google-map" ref="googleMap"></div>
        <template v-if="Boolean(this.google) && Boolean(this.map)">
            <slot :google="google" :map="map" />
        </template>
    </div>
</template>

<script>
import GoogleMapsApiLoader from "google-maps-api-loader";
import { EventBus } from "@/survey/event.js";

export default {
    props: {
        mapConfig: Object,
        apiKey: String
    },

    data() {
        return {
            google: null,
            map: null
        };
    },

    async mounted() {
        const googleMapApi = await GoogleMapsApiLoader({
            libraries: ["geometry"],
            apiKey: this.apiKey,
            language: "id"
        });
        this.google = googleMapApi;
        this.initializeMap();
        EventBus.$on("removeGoogleMapData", data => {
            this.initializeMap();
        });
    },

    methods: {
        initializeMap() {
            const mapContainer = this.$refs.googleMap;
            this.map = new this.google.maps.Map(mapContainer, this.mapConfig);
            let self = this;

            this.google.maps.event.addListener(this.map, "click", function(
                event
            ) {
                self.$store.dispatch("isLoading", true);
                // let polyArea_1 = new self.google.maps.Polygon({
                //   paths: self.getPath('area_1')
                // });
                // let polyArea_2 = new self.google.maps.Polygon({
                //   paths: self.getPath('area_2')
                // });
                // let polyArea_3 = new self.google.maps.Polygon({
                //   paths: self.getPath('area_3')
                // });
                // self.$store.dispatch('isLoading', true)
                // self.google.maps.geometry.poly.containsLocation(event.latLng, polyArea_1)
                // let isInPolyArea_1 = self.google.maps.geometry.poly.containsLocation(event.latLng, polyArea_1)
                // let isInPolyArea_2 = self.google.maps.geometry.poly.containsLocation(event.latLng, polyArea_2)
                // let isInPolyArea_3 = self.google.maps.geometry.poly.containsLocation(event.latLng, polyArea_3)

                // let area = isInPolyArea_3 ? 3 : isInPolyArea_2 ? 2 : isInPolyArea_1 ? 1 : 0
                console.log(
                    "addListenersOnMap -> lat",
                    event.latLng.lat(),
                    "addListenersOnMap -> lng",
                    event.latLng.lng()
                );
                // console.log(area)
                let latlng = new self.google.maps.LatLng(
                    event.latLng.lat(),
                    event.latLng.lng()
                );
                axios
                    .get(
                        `geocoding?latlng=${event.latLng.lat() +
                            "," +
                            event.latLng.lng()}`
                    )
                    .then(response => {
                        self.$store.dispatch("isLoading", false);
                        // EventBus.$emit('addMarker', latlng);
                        // console.log( response.data.results[0]);

                        EventBus.$emit("addPlace", response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
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
        }
    }
};
</script>

<style scoped>
.google-map {
    width: 100%;
    min-height: 100%;
}
</style>
