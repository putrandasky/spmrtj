<script>
  import {
    POINT_MARKER_ICON_CONFIG
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
      markerData: {
        type: Object,
        required: true
      },
      sizeIcon: {
        type: Number,
        required: true
      },
      zIndexIcon: {
        type: Number,
        required: true
      },
      markerIcon: String,
    },
    data() {
      return {
        marker: null
      };
    },

    mounted() {
      this.createMarker()
    },
    watch: {
      markerData(newVal, oldVal) {
        if (oldVal) {
          // this.removeMarker()
          this.createMarker()
        }
      }
    },
    methods: {
      createMarker() {
        const {
          Marker
        } = this.google.maps;
        const {
          Size
        } = this.google.maps;
        const {
          Point
        } = this.google.maps;

        let image = {
          url: this.markerIcon || null,
          scaledSize: new Size(this.sizeIcon, this.sizeIcon),
          // origin : new Point(0,0),
          // anchor : new Point(0,50)
        }
        if (this.marker) {
          this.marker.setPosition(this.markerData.position)
        } else {

          this.marker = new Marker({
            position: this.markerData.position,
            title: this.markerData.title,
            marker: this.markerData,
            map: this.map,
            zIndex: this.zIndexIcon,
            icon: image
            //   icon: POINT_MARKER_ICON_CONFIG
          });
        }
      },
      // removeMarker() {
      //   this.marker.setMap(null)
      //   this.marker = null
      // }
    },

    render() {}
  };

</script>
