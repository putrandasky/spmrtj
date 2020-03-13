<template>
  <GoogleMapLoader :mapConfig="mapConfig" :apiKey="apiKey" v-if="!isLoading">
    // insert your google maps api key to render styled map

    <template slot-scope="{ google, map }">
      <GoogleMapLine v-if="withOther" v-for="line in lines.others" :key='"line_others-"+line.id' lineColor="RGB(214,25,29)" :zIndexLine="1"
        :pathData="line.path" :google="google" :map="map" />
      <GoogleMapLine v-for="line in lines.corridor_1" :key='"line_corridor_1-"+line.id' lineColor="RGB(34,177,76)" :zIndexLine="2"
        :pathData="line.path" :google="google" :map="map" />
      <GoogleMapLine v-for="line in lines.corridor_2A" :key='"line_corridor_2A-"+line.id' lineColor="RGB(0,162,232)" :zIndexLine="1"
        :pathData="line.path" :google="google" :map="map" />
      <GoogleMapLine v-for="line in lines.corridor_2B" :key='"line_corridor_2B-"+line.id' lineColor="RGB(163,73,164)" :zIndexLine="1"
        :pathData="line.path" :google="google" :map="map" />

    </template>
  </GoogleMapLoader>
</template>

<script>
  import GoogleMapLoader from "@/gmaps/components/gmaps/GoogleMapLoader";
  import GoogleMapLine from "@/gmaps/components/gmaps/GoogleMapLine";

  import {
    mapSettings
  } from "@/survey/constants/mapSettings";

  export default {
    components: {
      GoogleMapLoader,
      GoogleMapLine,
    },
    props: {
      withOther: {
        type: Boolean,
        required: false
      },

    },
    data() {
      return {
        apiKey:process.env.MIX_GMAPS_CLIENT_API_KEY,
        isLoading:false,
        markers: [

        ],
        lines: {
          others:[],
          corridor_1:[],
          corridor_2A:[],
          corridor_2B:[],
        },
        lineSymbol : {
  path: "M-2,0a2,2 0 1,0 4,0a2,2 0 1,0 -4,0",
  strokeOpacity: 1,
  strokeColor: 'black',
  strokeWeight: 1,
  scale: 3,
  fillColor:'white',
  fillOpacity:1,
        },
        lineSymbolRepeat:'20px'

      };
    },
    created() {
      this.getLines()
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


    },

    methods: {

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

    }
  };

</script>
