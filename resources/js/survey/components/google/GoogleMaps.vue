<template>
    <GoogleMapLoader
        :mapConfig="mapConfig"
        :apiKey="apiKey"
        v-if="!isLoading"
        @onClick="markers = $event"
    >
        // insert your google maps api key to render styled map

        <template slot-scope="{ google, map }">
            <GoogleMapMarker
                ref="markerOrigin"
                key="markerOrigin"
                markerIcon="/img/drop-pin-red.svg"
                :sizeIcon="60"
                :zIndexIcon="5"
                :markerData="markers"
                :google="google"
                :map="map"
            />
        </template>
    </GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "@/survey/components/google/GoogleMapLoader";
import GoogleMapMarker from "@/survey/components/google/GoogleMapMarker";

import { mapSettings } from "@/survey/constants/mapSettings";

export default {
    props: ["routes", "mapCenter"],
    components: {
        GoogleMapLoader,
        GoogleMapMarker
    },

    data() {
        return {
            apiKey: process.env.MIX_GMAPS_CLIENT_API_KEY,
            isLoading: false,
            markers: {}
        };
    },
    created() {
        // this.getMarker()
        // this.getLines()
    },
    mounted() {},
    computed: {
        mapConfig() {
            return {
                ...mapSettings,
                center: {
                    lat: -6.165198,
                    lng: 106.827121
                }
            };
        }

        // mapCenter() {
        //   return {
        //     lat: -6.165198,
        //     lng: 106.872157
        //   }
        // }
    },

    methods: {

    }
};
</script>
