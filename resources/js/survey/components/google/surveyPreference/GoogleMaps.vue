<template>
  <GoogleMapLoader :mapConfig="mapConfig" :apiKey="apiKey" v-if="!isLoading" @onClick="markers = $event" >
    // insert your google maps api key to render styled map

    <template slot-scope="{ google, map }">

      <GoogleMapMarker v-if="origin"  ref="markerOrigin" key="markerOrigin" markerIcon='/img/drop-pin-red.svg' :sizeIcon="60"
        :zIndexIcon="5" :markerData="{lat:parseFloat(origin.origin_lat),lng:parseFloat(origin.origin_lng)}" :google="google" :map="map" />
      <GoogleMapMarker  v-if="destination"  ref="markerDestination" key="markerDestination" markerIcon='/img/drop-pin-red.svg' :sizeIcon="60"
        :zIndexIcon="5" :markerData="{lat:parseFloat(destination.destination_lat),lng:parseFloat(destination.destination_lng)}" :google="google" :map="map" />
        <GoogleMapPolygon :outterData="outterDataArea1" fillColor="#FF9800" :google="google" :map="map"/>
        <GoogleMapPolygon :outterData="outterDataArea2" fillColor="#43a047" :innerData="outterDataArea3" :google="google" :map="map"/>
        <GoogleMapPolygon :outterData="outterDataArea3"  fillColor="#303f9f"  :google="google" :map="map"/>

    </template>
  </GoogleMapLoader>
</template>

<script>
  import GoogleMapLoader from "@/survey/components/google/surveyPreference/GoogleMapLoader";
  import GoogleMapMarker from "@/survey/components/google/surveyPreference/GoogleMapMarker";
  import GoogleMapPolygon from "@/survey/components/google/surveyPreference/GoogleMapPolygon";

  import {
    mapSettings
  } from "@/survey/constants/mapSettings";

  export default {
props:['origin','destination','outterDataArea1','outterDataArea2','outterDataArea3'],
    components: {
      GoogleMapLoader,
      GoogleMapMarker,
      GoogleMapPolygon
    },

    data() {
      return {
        apiKey:process.env.MIX_GMAPS_CLIENT_API_KEY,
        isLoading:false,
        markers: {},

      };
    },
    created() {
      // this.getMarker()
      // this.getLines()
    },
    mounted(){

    },
    computed: {
      mapConfig() {
        return {
          ...mapSettings,
          center: {
          lat: -6.165198,
          lng: 106.827121
        }
                };
      },

      // mapCenter() {
      //   return {
      //     lat: -6.165198,
      //     lng: 106.872157
      //   }
      // }
    },

    methods: {
      getMarker() {
        axios.get(`station`)
          .then((response) => {
            const editData = (data) => {
              return data.map(item => {
                var temp = Object.assign({}, item);
                temp['position'] = {
                  lat: parseFloat(temp.lat),
                  lng: parseFloat(temp.lng)
                }
                temp['title'] = temp.name
                return temp;
              });
            }
            this.markers = editData(response.data)
            console.log(this.markers);

          })
          .catch((error) => {
            console.log(error);
          })
      },
      getLines() {
        axios.get(`linecorridor`)
          .then((response) => {
            this.lines = response.data
            console.log(this.lines);

          })
          .catch((error) => {
            console.log(error);
          })
      },
      getRoutes() {
        let self = this

        axios.get(`survey/form/state-preference/getRoute/${this.$route.query.token}`)
          .then((response) => {
            this.routes = response.data
            // console.log(this.routes);
            let median = this.routes.lrt.path.length % 2 == 0?this.routes.lrt.path.length /2:(this.routes.lrt.path.length+1)/2
            // console.log(this.routes.lrt.path[median-1]);
self.mapCenter.lat = this.routes.lrt.path[median-1].lat
self.mapCenter.lng = this.routes.lrt.path[median-1].lng
self.isLoading = false
            this.$emit('routes', this.routes)
            this.$emit('isLoading', false)
            this.$emit('isSuccess')

            // this.origin['title'] =
          })
          .catch((error) => {
            console.log(error);
            this.$emit('isLoading', false)
            this.$emit('isFailed')

          })
      }
    }
  };

</script>
