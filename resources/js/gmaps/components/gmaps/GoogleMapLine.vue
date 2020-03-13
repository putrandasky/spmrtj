<script>
  import {
    LINE_PATH_CONFIG
  } from "../../constants/mapSettings";

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
      },
      icons:{
        type:Object,
        default:null
      },
      iconsRepeat:{
        type:String,
        default:null
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
          strokeColor: this.lineColor || "RGB(0,162,232)",
          zIndex: this.zIndexLine || 1,
          strokeOpacity: this.icons? 0 :1,
          strokeWeight: this.icons? 0 :9,
          ...LINE_PATH_CONFIG,
          icons: [{
            icon: this.icons||null,
            offset: '0',
            repeat: this.iconsRepeat||null
          }],
          // icons: [{
          //   icon: lineSymbol,
          //   repeat: "10px"
          // }],
          map: this.map,
        });
      },
      // removeLine() {
      // }
    },

    render() {},
  };

</script>
