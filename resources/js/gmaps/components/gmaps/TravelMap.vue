<template>
    <GoogleMapLoader :mapConfig="mapConfig" :apiKey="apiKey" v-if="!isLoading" >
        // insert your google maps api key to render styled map

        <template slot-scope="{ google, map }">
            <!-- <GoogleMapMarker v-for="marker in markers" markerIcon='/img/train-icon.png' :sizeIcon="30" :zIndexIcon="3"
        :key='"marker-"+marker.id' :markerData="marker" :google="google" :map="map" />
      <GoogleMapMarker ref="markerOrigin" :key="routes.origin.id" markerIcon='/img/point-origin.png' :sizeIcon="60"
        :zIndexIcon="5" :markerData="routes.origin" :google="google" :map="map" />
      <GoogleMapMarker ref="markerDestination" :key="routes.destination.id" markerIcon='/img/point-destination.png'
        :sizeIcon="50" :zIndexIcon="5" :markerData="routes.destination" :google="google" :map="map" /> -->
            <!-- <GoogleMapLine v-for="line in lines" :key='"line-"+line.id' lineColor="RGB(214,25,29)" :zIndexLine="1" :pathData="line.path"
        :google="google" :map="map" /> -->

            <!-- <GoogleMapLine v-if="routes.lrt.lines.length !== 0" v-for="(line,i) in routes.lrt.lines" lineColor="RGB(34,177,76)" ref='routeLine' :key='"route-"+i'
        :pathData="line.path" :google="google" :map="map" /> -->
            <!-- <GoogleMapLine lineColor="RGB(34,177,76)" ref='routeLine'
        :pathData="routes.lrt.path" :zIndexLine="2" :google="google" :map="map" />
      <GoogleMapDirection v-if="routes.origin.position.lat"
        :originPoint='routes.origin.position.lat+","+routes.origin.position.lng'
        :destinationPoint='routes.origin_station.position.lat+","+routes.origin_station.position.lng' :google="google"
        :map="map" />
      <GoogleMapDirection v-if="routes.destination.position.lat"
        :destinationPoint='routes.destination.position.lat+","+routes.destination.position.lng'
        :originPoint='routes.destination_station.position.lat+","+routes.destination_station.position.lng'
        :google="google" :map="map" />
      <GoogleMapDirection v-if="routes.destination.position.lat"
        :destinationPoint='routes.destination.position.lat+","+routes.destination.position.lng'
        :originPoint='routes.origin.position.lat+","+routes.origin.position.lng' :google="google" :map="map" /> -->
            <GoogleMapPolygon
                :outterData="outterDataArea1"
                fillColor="#ff5252"
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
                fillColor="#FG9800"
                :google="google"
                :map="map"
            />
        </template>
    </GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "./GoogleMapLoader";
import GoogleMapPolygon from "./GoogleMapPolygon";
// import GoogleMapMarker from "./GoogleMapMarker";
// import GoogleMapLine from "./GoogleMapLine";
// import GoogleMapDirection from "./GoogleMapDirection";
// import DefaultMarkerData from "./TravelMapMarker";

import { mapSettings } from "../../constants/mapSettings";

export default {
    props: {
        apiKey: {
            type: String,
            required: true
        }
    },
    components: {
        GoogleMapLoader,
        GoogleMapPolygon
        // GoogleMapMarker,
        // GoogleMapLine,
        // GoogleMapDirection
    },

    data() {
        return {
            isLoading:true,
            outterDataArea1: [],
            outterDataArea2: [],
            outterDataArea3: [],
            outterDataArea4: [],
            outterDataArea5: [],
        };
    },
    created() {
        this.getPolygon();
        // this.getMarker()
        // this.getLines()
        // console.log(Object.keys(this.routes).length == 0);
        // this.getRoutes()
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
                lat: -6.165198,
                lng: 106.872157
            };
        }
    },
    methods: {
        getPolygon() {
            axios
                .get(`area`)
                .then(response => {
                    this.outterDataArea1 = response.data[0].coverages
                    this.outterDataArea2 = response.data[1].coverages
                    this.outterDataArea3 = response.data[2].coverages
                    this.outterDataArea4 = response.data[3].coverages
                    this.outterDataArea5 = response.data[4].coverages
                    // this.outterDataArea1 = this.parseFloatLatLng(
                    //     response.data[0].coverages
                    // );
                    console.log(this.outterDataArea1);
                    this.isLoading = false
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
        getMarker() {
            axios
                .get(`api/station`)
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
                    this.markers = editData(response.data);
                    console.log(this.markers);
                })
                .catch(error => {
                    console.log(error);
                    this.$toast.open({
                        duration: 5000,
                        message: `Gagal mendapatkan Data Marker, Silahkan Nanti Coba Lagi`,
                        position: "is-bottom",
                        type: "is-danger"
                    });
                });
        },
        getLines() {
            axios
                .get(`api/line`)
                .then(response => {
                    this.lines = response.data;
                    console.log(this.lines);
                })
                .catch(error => {
                    console.log(error);
                    this.$toast.open({
                        duration: 5000,
                        message: `Gagal mendapatkan Data Jalur LRT, Silahkan Nanti Coba Lagi`,
                        position: "is-bottom",
                        type: "is-danger"
                    });
                });
        },
        getRoutes() {
            let self = this;

            axios
                .get(
                    `api/route?place_origin=${this.placeOrigin}&place_destination=${this.placeDestination}`
                )
                .then(response => {
                    self.routes = DefaultMarkerData.items;
                    // self.$refs.markerOrigin.removeMarker()
                    // self.$refs.markerDestination.removeMarker()
                    // self.$refs.routeLrtLines.removeLine()
                    this.routes = response.data;
                    // this.origin = response.data.origin
                    // this.origin.id = "origin"
                    // this.origin.title = "Posisi Anda"
                    // this.origin['position'] = {
                    //     lat:Number(response.data.origin.point.lat),
                    //     lng:Number(response.data.origin.point.lng),
                    // }
                    console.log(this.routes);
                    this.$toast.open({
                        message: "Sukses Mengolah Data Anda",
                        type: "is-success"
                    });
                    this.$emit("routes", this.routes);
                    this.$emit("isLoading", false);
                    this.$emit("isSuccess");

                    // this.origin['title'] =
                })
                .catch(error => {
                    console.log(error);
                    this.$emit("isLoading", false);
                    this.$emit("isFailed");
                    this.$dialog.alert({
                        title: "Terimakasih Atas Partisipasinya",
                        message:
                            "Anda tidak termasuk dalam kategori responden dalam survey kami ",
                        type: "is-info",
                        hasIcon: true,
                        icon: "exclamation",
                        iconPack: "fa"
                    });
                    // this.$toast.open({
                    //   duration: 5000,
                    //   message: `Gagal Mengolah Data Anda, Silahkan Nanti Coba Lagi`,
                    //   position: 'is-bottom',
                    //   type: 'is-danger'
                    // })
                });
        }
    }
};
</script>
