<script>
import { CheckArea } from "../../components/mixins/CheckArea.js";
import { EventBus } from "@/gmaps/event.js";
export default {
    mixins: [CheckArea],
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
            default: "#FF0000"
        },
        zIndex: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {};
    },

    mounted() {
        this.createPolygon();
    },
    watch: {},
    methods: {
        addListenersOnPolygon(polygon) {
            let self = this;
            google.maps.event.addListener(polygon, "click", function(event) {
                console.log(
                    "addListenersOnPolygon -> lat",
                    event.latLng.lat(),
                    "addListenersOnPolygon -> lng",
                    event.latLng.lng()
                );
                 self.$store.dispatch("isLoading", true);
                axios
                    .get(
                        `geocoding?latlng=${event.latLng.lat() +
                            "," +
                            event.latLng.lng()}`
                    )
                    .then(response => {
                        // self.$store.dispatch("isLoading", false);

                        self.defineArea({
                            latlng: event.latLng,
                            address: response.data[0].formatted_address
                        });
                        console.log(response.data);

                        // EventBus.$emit("addPlace", response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        },
        createPolygon() {
            let self = this;
            var polygon = new this.google.maps.Polygon({
                paths: this.innerData
                    ? [this.outterData, this.innerData]
                    : this.outterData,
                strokeColor: self.fillColor,
                strokeOpacity: 0.8,
                strokeWeight: 0,
                fillColor: self.fillColor,
                fillOpacity: 0.35,
            });
            polygon.setOptions({ zIndex: this.zIndex });
            this.addListenersOnPolygon(polygon);
            polygon.setMap(this.map);
        }
    },

    render() {}
};
</script>
