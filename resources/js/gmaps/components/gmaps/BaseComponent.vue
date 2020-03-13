<template>

              <TravelMap ref="travelmap" class="travel-map" :apiKey="apiKey" />

</template>

<script>
  import TravelMap from "./TravelMap";
  import debounce from 'lodash/debounce'
  export default {
    name: "App",
    components: {
      TravelMap
    },
    data() {
      return {
        isLoading: false,
        routes: {
          google: {
            distance: '',
            duration: ''
          },
          lrt: {
            distance: '',
            duration: '',
            stations:[]
          },
          origin_station: {
            title: '',
            distance: '',
            duration: ''
          },
          destination_station: {
            title: '',
            distance: '',
            duration: ''
          },
          summary:{
            duration_with_lrt:'',
            the_better:''
          }
        },
        dataOrigin: [],
        dataDestination: [],
        selectedOrigin: '',
        selectedDestination: '',
        isOriginFetching: false,
        isDestinationFetching: false,
        apiKey: process.env.MIX_GMAPS_CLIENT_API_KEY
      }
    },
    watch: {

    },
    methods: {
handleClick(e){
// console.log(e.latLng);

},
      submit() {
        this.isLoading = true
        this.$refs.travelmap.getRoutes()
      },

      getAsyncDataOrigin: debounce(function (input) {
        this.selectedOrigin = ""
        if (!input.length) {
          this.dataOrigin = []
          return
        }
        this.isOriginFetching = true
        axios.get(`api/place-autocomplete/${input}`)
          .then((response) => {
            console.log(response.data)
            this.dataOrigin = response.data.predictions
            this.isOriginFetching = false

          })
          .catch((error) => {
            console.log(error);
          })
      }, 500),

      getAsyncDataDestination: debounce(function (input) {
        this.selectedDestination = ""
        if (!input.length) {
          this.dataDestination = []
          return
        }
        this.isDestinationFetching = true
        axios.get(`api/place-autocomplete/${input}`)
          .then((response) => {
            console.log(response.data)
            this.dataDestination = response.data.predictions
            this.isDestinationFetching = false

          })
          .catch((error) => {
            console.log(error);
          })
      }, 500)

    }
  }

</script>

<style lang="scss" scoped>
  .travel-map {
    height: 100vh;
  }

</style>
