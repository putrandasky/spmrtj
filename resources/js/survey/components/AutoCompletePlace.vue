<template>
  <div>

    <label for="place">{{label}}</label>
    <vue-bootstrap-typeahead inputClass="form-control-lg shadow-sm" id="place" @keyup.native="onKeyUp"  v-model="placeSearch" :data="places"
      :serializer="place => place.formatted_address" @hit="hit($event)" :minMatchingChars="3"
      :placeholder="placeholder">
      <template slot="suggestion" slot-scope="{ data, htmlText }">
        <span v-html="htmlText" style="font-size:14px"></span>
        <!-- {{ data.description }} -->
      </template>
    </vue-bootstrap-typeahead>
    <b-spinner small class="inside-input" variant="primary" v-show="searchingFeedback"></b-spinner>
    <div>
      <strong  v-if="searchingFeedbackNoPlace" slot="description" style="
    position: relative;
    top: -5px;
    left: 0;
    color: red;
    font-size: 10px;">
      Tidak ada lokasi yang anda cari
    </strong>
      </div>
      <div>
      <small>Ket: masukan alamat secara detail agar muncul usulan lokasi yang lebih tepat</small>
      </div>
  </div>
</template>
<script>
  import _ from 'lodash';
  import {
    EventBus
  } from '@/survey/event.js';

  export default {
    name: 'AutoCompletePlace',
    props: ['placeholder', 'label'],
    data: function () {
      return {
        places: [],
        placeSearch: '',
        selectedPlace: null,
        searchingFeedback: false,
        searchingFeedbackNoPlace: false,
      }
    },
    created() {},
    mounted() {
      let self = this
      EventBus.$on('addPlace', data => {
        self.places = []
        self.places.push(data[0])
        self.hit(data[0])
        // console.log(`self_places`);
        // console.log(self.places);

      });
      EventBus.$on('removeGoogleMapData', data => {
        self.places = []

      });
    },
    methods: {
      hit(e) {
        this.$emit('hit', e)
      },
      onKeyUp(e) {
        this.onKeyUpSearchPlace(e)
        this.onKeyUpImmediate()
      },
      onKeyUpImmediate() {
        let self = this
        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event
            .keyCode >=
            97 && event.keyCode <= 122) || event.keyCode == 8 || event.keyCode == 229) {
          if (this.places.length !== 0) {
            self.places = []
            this.$emit('onkeyup')
            console.log('keyup');
          }
        }
      },
      onKeyUpSearchPlace: _.debounce(function (event) {
        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event
            .keyCode >=
            97 && event.keyCode <= 122) || event.keyCode == 8 || event.keyCode == 229) {
          this.selectedPlace = null
          if (this.placeSearch.length >= 3) {
            this.searchingFeedbackNoPlace = false
            this.searchingFeedback = true
            this.getPlace(this.placeSearch)
          } else {
            this.searchingFeedbackNoPlace = false
            this.searchingFeedback = false

          }
        }
      }, 500),
      getPlace(query) {
        let self = this
        axios.get(`geocoding?address=${query}`)
          .then((response) => {
            console.log(response.data)
            if (response.data.length == 0) {
              this.searchingFeedback = false
              this.searchingFeedbackNoPlace = true
            }
            if (response.data.length !== 0) {
              self.places = response.data
              this.searchingFeedback = false
            }
            // console.log(this.selectedUser)
          })
          .catch((error) => {
            console.log(error);
                          this.searchingFeedback = false
              this.searchingFeedbackNoPlace = true
          })
        // this.addresses = suggestions.suggestions
      },
    },
  }

</script>
<style>
</style>
