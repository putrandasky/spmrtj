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
import { CheckArea } from "../../components/mixins/CheckArea.js";
import { EventBus } from "@/gmaps/event.js";
export default {
    mixins: [CheckArea],
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
            libraries: ["visualization", "geometry"],
            apiKey: this.apiKey,
            language: "id"
        });
        this.google = googleMapApi;
        this.initializeMap();
    },

    methods: {
        initializeMap() {
            let self = this
            const mapContainer = this.$refs.googleMap;
            this.map = new this.google.maps.Map(mapContainer, this.mapConfig);
            this.google.maps.event.addListener(this.map, "click", function(
                event
            ) {
                 self.$store.dispatch("isLoading", true);
                console.log(
                    "addListenersOnMap -> lat",
                    event.latLng.lat(),
                    "addListenersOnMap -> lng",
                    event.latLng.lng()
                );
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
                        self.defineArea({
                            latlng: event.latLng,
                            address: response.data[0].formatted_address
                        });
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
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
