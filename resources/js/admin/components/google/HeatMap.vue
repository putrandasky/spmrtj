<template>
    <GoogleMapLoader :mapConfig="mapConfig" :apiKey="apiKey">
        // insert your google maps api key to render styled map

        <template slot-scope="{ google, map }">
            <heat-map
                v-if="type == 1"
                :google="google"
                :map="map"
                :points="points"
                ref="origin"
                :radius="20"
                latName="lat"
                lngName="lng"
            />
            <!-- <heat-map v-if="type == 2" :google="google" :map="map" :points="points.respondent_station"  ref="station"  :radius="10" :latName="latName" :lngName="lngName"/> -->
            <!-- <GoogleMapLine v-for="line in lines" :key='"line-"+line.id' lineColor="RGB(214,25,29)" :zIndexLine="0"
        :pathData="line.path" :google="google" :map="map" /> -->
        </template>
    </GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "@/admin/components/google/GoogleMapLoader";
import HeatMap from "@/gmaps/components/gmaps/GoogleMapHeatMap";
//   import GoogleMapLine from "@/admin2/components/google/GoogleMapLine";

import { mapSettings } from "@/admin/constants/mapSettings";

export default {
    components: {
        GoogleMapLoader,
        HeatMap
        //   GoogleMapLine
    },
    props: {
        mapType: {
            type: Number,
            default: 1
        },
        points: {
            type: Array,
            required: true
        },
        radius: {
            type: Number,
            default: 10
        },
        latName: {
            type: String,
            default: "lat"
        },
        lngName: {
            type: String,
            default: "lng"
        }
    },
    data() {
        return {
            apiKey: process.env.MIX_GMAPS_CLIENT_API_KEY,
            type: 1,
            // lines: [],
            mapCenter: {
                lat: -6.175318,
                lng: 106.827142
            }
        };
    },
    created() {
        // console.log(Object.keys(this.routes).length == 0);
        console.log("jjajaj");
        // this.getLines();
    },
    watch: {
        mapType(newVal, oldVal) {
            this.type = newVal;
            if (this.type == 1) {
                this.$refs.origin.createHeatMap();
            } else {
                this.$refs.station.createHeatMap();
            }
        }
    },
    computed: {
        mapConfig() {
            return {
                ...mapSettings,
                center: this.mapCenter
                // mapTypeId: 'satellite'
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
        // getLines() {
        //     axios
        //         .get(`/line`)
        //         .then(response => {
        //             this.lines = response.data;
        //             console.log(this.lines);
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         });
        // }
    }
};
</script>
