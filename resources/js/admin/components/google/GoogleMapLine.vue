<script>
  import {
    LINE_PATH_CONFIG
  } from "@/admin2/constants/mapSettings";

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
      pathData: {
        type: Array,
        required: true
      },
      lineColor: {
        type: String,
      },
      zIndexLine: {
        type: Number,
      }
    },
    data() {
      return {
        path: null
      };
    },
    mounted() {
      this.createLine()
    },
    watch: {
      pathData(newVal, oldVal) {
        if (oldVal) {
          // this.removeMarker()

          this.createLine()
        }
      }
    },
    methods: {
      createLine() {
        // console.log(this.path);
        const {
          Polyline
        } = this.google.maps;
        if (this.path) {
          this.path.setMap(null)
          this.path = null
        }

          this.path = new Polyline({
            path: this.pathData,
          map: this.map,
          strokeColor: this.lineColor || "RGB(0,162,232)",
          zIndex: this.zIndexLine ||1,
          ...LINE_PATH_CONFIG
        });
      },
      // removeLine() {
      // }
    },

    render() {},
  };

</script>
