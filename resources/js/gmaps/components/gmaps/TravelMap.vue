<template>
    <GoogleMapLoader :mapConfig="mapConfig" :apiKey="apiKey" v-if="!isLoading">
        <template slot-scope="{ google, map }">
            <GoogleMapMarker
                v-for="marker in markers"
                markerIcon="/img/mrtj-icon.png"
                :sizeIcon="15"
                :zIndexIcon="3"
                :key="'marker-' + marker.id"
                :markerData="marker"
                :google="google"
                :map="map"
            />
            <!-- <GoogleMapMarker
                v-for="marker in markerFeeders"
                markerIcon="/img/mrtj-icon.png"
                :sizeIcon="15"
                :zIndexIcon="3"
                :key="'markerFeeder-' + marker.id"
                :markerData="marker"
                :google="google"
                :map="map"
            /> -->
            <GoogleMapMarker
                ref="markerOrigin"
                key="markerOrigin"
                markerIcon="/img/point-origin.png"
                :sizeIcon="60"
                :zIndexIcon="5"
                :markerData="markerOrigin"
                :google="google"
                :map="map"
                v-if="markerOrigin.position.lat"
            />
            <GoogleMapMarker
                ref="markerDestination"
                key="markerDestination"
                markerIcon="/img/point-destination.png"
                :sizeIcon="50"
                :zIndexIcon="5"
                :markerData="markerDestination"
                :google="google"
                :map="map"
                v-if="markerDestination.position.lat"
            />
            <GoogleMapLine
                v-for="line in lines"
                :key="'line-' + line.id"
                lineColor="RGB(7,136,209)"
                :zIndexLine="11"
                :pathData="line.path"
                :google="google"
                :map="map"
            />
            <GoogleMapLine
                v-for="line in lineFeeders"
                :key="'lineFeeder-' + line.id"
                lineColor="RGB(155, 89, 182)"
                :zIndexLine="10"
                :pathData="line.path"
                :google="google"
                :map="map"
            />

            <!-- <GoogleMapLine v-if="routes.mrt.lines.length !== 0" v-for="(line,i) in routes.mrt.lines" lineColor="RGB(34,177,76)" ref='routeLine' :key='"route-"+i'
        :pathData="line.path" :google="google" :map="map" /> -->
            <GoogleMapLine
                v-if="routes.mrt.path.length !== 0"
                lineColor="RGB(34,177,76)"
                ref="routeLine"
                :pathData="routes.mrt.path"
                :zIndexLine="25"
                :google="google"
                :map="map"
            />
            <GoogleMapLine
                v-if="routes.feeder.path.length !== 0"
                lineColor="RGB(231, 76, 60)"
                ref="routeLineFeeder"
                :pathData="routes.feeder.path"
                :zIndexLine="25"
                :google="google"
                :map="map"
            />
            <GoogleMapDirection
                v-if="routes.mrt.path.length !== 0"
                lineColor="rgb(230, 126, 34)"
                :originPoint="
                    routes.origin.position.lat +
                        ',' +
                        routes.origin.position.lng
                "
                :destinationPoint="
                    routes.origin_station.position.lat +
                        ',' +
                        routes.origin_station.position.lng
                "
                :zIndex="12"
                :google="google"
                :map="map"
            />
            <GoogleMapDirection
                v-if="routes.mrt.path.length !== 0"
                lineColor="rgb(230, 126, 34)"
                :destinationPoint="
                    routes.destination.position.lat +
                        ',' +
                        routes.destination.position.lng
                "
                :originPoint="
                    routes.destination_station.position.lat +
                        ',' +
                        routes.destination_station.position.lng
                "
                :zIndex="12"
                :google="google"
                :map="map"
            />
            <GoogleMapDirection
                v-if="routes.destination.position.lat"
                :destinationPoint="
                    routes.destination.position.lat +
                        ',' +
                        routes.destination.position.lng
                "
                :originPoint="
                    routes.origin.position.lat +
                        ',' +
                        routes.origin.position.lng
                "
                :zIndex="12"
                :google="google"
                :map="map"
            />
            <GoogleMapPolygon
                :outterData="outterDataArea1"
                fillColor="rgb(255, 82, 82)"
                :google="google"
                :map="map"
            />
            <GoogleMapPolygon
                :outterData="outterDataArea2"
                fillColor="#0F9D58"
                :google="google"
                :map="map"
            />
            <GoogleMapPolygon
                :outterData="outterDataArea3"
                fillColor="#000000"
                :google="google"
                :map="map"
            />
            <GoogleMapPolygon
                :outterData="outterDataArea4"
                fillColor="#FF9800"
                :google="google"
                :map="map"
            />
            <GoogleMapPolygon
                :outterData="outterDataArea5"
                fillColor="rgb(0,0,0)"
                :google="google"
                :map="map"
                :zIndex="9"
            />
        </template>
    </GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "./GoogleMapLoader";
import GoogleMapPolygon from "./GoogleMapPolygon";
import GoogleMapMarker from "./GoogleMapMarker";
import GoogleMapLine from "./GoogleMapLine";
import GoogleMapDirection from "./GoogleMapDirection";
import DefaultMarkerData from "./TravelMapMarker";
import { EventBus } from "@/gmaps/event.js";
import { mapSettings } from "../../constants/mapSettings";
import { store } from "@/gmaps/store";
import { CheckArea } from "../../components/mixins/CheckArea.js";

export default {
    mixins: [CheckArea],
    props: {
        apiKey: {
            type: String,
            required: true
        },
        markerOrigin: {
            type: Object,
            required: true
        },
        areaOrigin: {
            type: Array,
            required: true
        },
        markerDestination: {
            type: Object,
            required: true
        },
        areaDestination: {
            type: Array,
            required: true
        }
    },
    components: {
        GoogleMapLoader,
        GoogleMapPolygon,
        GoogleMapMarker,
        GoogleMapLine,
        GoogleMapDirection
    },

    data() {
        return {
            isLoading: true,
            outterDataArea1: [],
            outterDataArea2: [],
            outterDataArea3: [],
            outterDataArea4: [],
            outterDataArea5: [],
            markers: [],
            markerFeeders: [],

            lines: [],
            lineFeeders: [],
            routes: DefaultMarkerData.items,
            origin: {},
            destination: {},
            lineSymbolDash: {
                path: "M 0,-2 0,2",
                strokeColor: "RGB(214,25,29)",
                fillColor: "RGB(214,25,29)",
                strokeOpacity: 1,
                strokeWeight: 5,
                scale: 1
            }
        };
    },
    created() {
        // this.getPolygon();
        // this.getMarkerForStation();
        // this.getLines();
        // console.log(Object.keys(this.routes).length == 0);
        // this.getRoutes()
         this.$store.dispatch("isLoading", true);
        this.getMapData()
    },
    computed: {
        mapConfig() {
            return {
                ...mapSettings,
                center: this.mapCenter
            };
        },

        mapCenter() {
            return {
                lat: -6.266660,
                lng: 106.797331
            };
        }
    },
    methods: {
        getMapData() {
            axios
                .get(`map-data`)
                .then(response => {
                    // console.log(response.data);
                         this.outterDataArea1 = this.parseFloatLatLng(response.data.area[0].coverages);
                    this.outterDataArea2 = this.parseFloatLatLng(response.data.area[1].coverages);
                    this.outterDataArea3 = this.parseFloatLatLng(response.data.area[2].coverages);
                    this.outterDataArea4 = this.parseFloatLatLng(response.data.area[3].coverages);
                    this.outterDataArea5 = this.parseFloatLatLng(response.data.area[4].coverages);

                    let coverage = {
                        parkir: this.outterDataArea1,
                        cycle: this.outterDataArea2,
                        pedestrian: this.outterDataArea3,
                        park_and_ride: this.outterDataArea4,
                        feeder: this.outterDataArea5
                    };
                    const editData = data => {
                        return data.map(item => {
                            var temp = Object.assign({}, item);
                            temp["position"] = {
                                lat: parseFloat(temp.lat),
                                lng: parseFloat(temp.lng)
                            };
                            temp["title"] = temp.name;
                            return temp;
                        });
                    };
                    this.$store.dispatch("addCoverageArea", coverage);
                    this.markers = editData(response.data.station);
                    this.markerFeeders = editData(response.data.feeder);
                    this.lines = response.data.line_station;
                    this.lineFeeders = response.data.line_feeder;
                    console.log(this.lines);

                    this.isLoading = false;
                     this.$store.dispatch("isLoading", false);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getPolygon() {
            let self = this;
            axios
                .get(`area`)
                .then(response => {
                    this.outterDataArea1 = this.parseFloatLatLng(response.data[0].coverages);
                    this.outterDataArea2 = this.parseFloatLatLng(response.data[1].coverages);
                    this.outterDataArea3 = this.parseFloatLatLng(response.data[2].coverages);
                    this.outterDataArea4 = this.parseFloatLatLng(response.data[3].coverages);
                    this.outterDataArea5 = this.parseFloatLatLng(response.data[4].coverages);
                    // self.$store.dispatch(
                    //     "addCoverageArea",
                    //     response.data[0].coverages
                    // );
                    let coverage = {
                        parkir: this.outterDataArea1,
                        cycle: this.outterDataArea2,
                        pedestrian: this.outterDataArea3,
                        park_and_ride: this.outterDataArea4,
                        feeder: this.outterDataArea5
                    };
                    // console.log(coverage);
                    this.$store.dispatch("addCoverageArea", coverage);
                    // EventBus.$emit("addCoverage",coverage);

                    // this.outterDataArea1 = this.parseFloatLatLng(
                    //     response.data[0].coverages
                    // );
                    // console.log(this.outterDataArea1);
                })
                .catch(error => {});
        },
        parseFloatLatLng(data) {
            let mutateData = data.map(function(item) {
                return {
                    lat: parseFloat(item.lat),
                    lng: parseFloat(item.lng)
                };
            });
            return mutateData;
        },

        getMarkerForStation() {
            axios
                .get(`station`)
                .then(response => {
                    const editData = data => {
                        return data.map(item => {
                            var temp = Object.assign({}, item);
                            temp["position"] = {
                                lat: parseFloat(temp.lat),
                                lng: parseFloat(temp.lng)
                            };
                            temp["title"] = temp.name;
                            return temp;
                        });
                    };
                    this.markers = editData(response.data.station);
                    this.markerFeeders = editData(response.data.feeder);
                    console.log(this.markers);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getLines() {
            axios
                .get(`line`)
                .then(response => {
                    this.lines = response.data;
                    this.isLoading = false;
                    console.log(this.lines);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getRoutes() {
            let self = this;
            let data = {
                place_origin: {
                    lat: this.markerOrigin.position.lat,
                    lng: this.markerOrigin.position.lng
                },
                place_destination: {
                    lat: this.markerDestination.position.lat,
                    lng: this.markerDestination.position.lng
                },
                area_destination:this.areaDestination,
                area_origin:this.areaOrigin,
            };
            axios
                .post(`route`, data)
                .then(response => {
                    self.routes = DefaultMarkerData.items;
                    self.routes = response.data;
                    // console.log(this.routes);
                    this.$emit("routes", self.routes);
                    // this.$emit("isLoading", false);
                    // this.$emit("isSuccess");
                    // this.origin['title'] =
                     self.$store.dispatch("isLoading", false);
                })
                .catch(error => {
                    console.log(error);
                    this.$emit("isLoading", false);
                    this.$emit("isFailed");
                });
        }
    }
};
</script>
