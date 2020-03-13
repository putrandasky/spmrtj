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
        heatmap: null,
      };
    },
    mounted() {
      this.createHeatMap()
    },
    computed: {

    },
    watch: {

    },
    methods: {

      createHeatMap() {
        console.log('testcgcs');
        this.heatmap = new this.google.maps.visualization.HeatmapLayer({
          data: this.getPoints(),
          map: this.map,
          zIndex: 5
        });
        let self = this

        this.heatmap.setMap(this.map);
        this.heatmap.set('radius', this.radius);
      },
      resetMap() {
        this.heatmap.setMap(null);
      },
      getPoints() {
        let element = []
        for (let index = 0; index < this.points.length; index++) {
          element[index] = new this.google.maps.LatLng(this.points[index][this.latName], this.points[index][this.lngName])
        }
        return element;
      }

    },

    render() {}
  };

</script>
