<script>



  export default {
    props: {
      google: {
        type: Object,
        required: true
      },
      map: {
        type: Object,
        required: true
      },
      outterData: {
        type: Array,
        required: true
      },
      innerData: {
        type: Array,
        required: false
      },
      fillColor: {
        type: String,
        default: '#FF0000'
      },
    },
    data() {
      return {
      };
    },

    mounted() {
      this.createPolygon()

    },
    watch: {

    },
    methods: {
      createPolygon() {
        let self = this
        var polygon = new this.google.maps.Polygon({
          paths: this.innerData?[this.outterData,this.innerData]:this.outterData,
          strokeColor: self.fillColor,
          strokeOpacity: 0.8,
          strokeWeight: 0,
          fillColor: self.fillColor,
          fillOpacity: 0.35
        });
        polygon.setMap(this.map);
      },

    },

    render() {}
  };

</script>
