<template>
    <b-container fluid class="mb-3">
        <loading
            class="text-center"
            :active.sync="$store.state.isLoading"
            :can-cancel="false"
            :opacity="0.9"
            :height="60"
            loader="dots"
            transition="fade"
            background-color="rgba(0,0,0,.85)"
            color="rgba(255,255,255,.9)"
            :is-full-page="true"
        >
            <div
                class="text-center"
                slot="after"
                style="color:rgba(255,255,255,.9)"
            >
                Mohon Tunggu...
            </div>
        </loading>

        <b-row>
            <b-col cols="12" class="w-100 text-center py-3">
                <h3>
                    Aplikasi Simulasi Perjalanan
                </h3>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="3">
                <div v-show="!markerOrigin.position.lat">
                    <b-alert show variant="info"
                        >1. Klik Pada Peta Untuk Memilih Asal Perjalanan
                    </b-alert>
                </div>
            </b-col>
            <b-col md="3">
                <div
                    v-show="
                        markerOrigin.position.lat &&
                            !markerDestination.position.lat
                    "
                >
                    <b-alert show variant="info">
                        2. Klik Pada Peta Untuk Memilih Tujuan Perjalanan
                    </b-alert>
                </div>
            </b-col>
            <b-col md="3">
                <div
                    v-show="
                        markerDestination.position.lat &&
                            markerOrigin.position.lat &&
                            (input.parking_guarantor==null ||
                            input.travel_model==null ||
                            input.transportation_mode==null)

                    "
                >
                    <b-alert show variant="info">
                        3. Input Data Pendukung
                    </b-alert>
                </div>
            </b-col>
            <b-col md="3">
                <div
                    class="mb-3"
                    v-if="
                        input.parking_guarantor!==null && input.travel_model!==null && input.transportation_mode!==null && !routes
                    "
                >
                    <b-button
                        class="shadow"
                        block
                        variant="success"
                        @click="submit"
                        >Submit
                    </b-button>
                </div>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="6">
                <b-row>
                    <b-col cols="12">
                        <b-card no-body class="shadow mb-3">
                            <TravelMap
                                ref="travelmap"
                                class="travel-map"
                                :apiKey="apiKey"
                                :markerOrigin="markerOrigin"
                                :markerDestination="markerDestination"
                                :areaOrigin="origin.area"
                                :areaDestination="destination.area"
                                :input="input"
                                @routes="routes = $event"
                                @transportationModes="
                                    options.transportation_modes = $event
                                "
                                @getSp="surveyPreference = $event"
                            />
                        </b-card>
                    </b-col>
                    <b-col lg="6">
                        <div v-show="markerOrigin.position.lat" class="pb-3">
                            <b-card title="Asal Perjalanan" class="shadow">
                                <hr />
                                <strong class="font-weight-bold">Alamat</strong>
                                <div>
                                    {{ origin.address }}
                                </div>
                                <div>
                                    <strong>Lat: </strong
                                    ><span>{{
                                        markerOrigin.position.lat
                                    }}</span>
                                    <strong>Lng: </strong
                                    ><span>{{
                                        markerOrigin.position.lng
                                    }}</span>
                                </div>
                                <strong>
                                    Area
                                </strong>
                                <ul>
                                    <li v-for="(v, i) in origin.area" :key="i">
                                        {{ convertSpIdToText(v) }}
                                    </li>
                                </ul>
                            </b-card>
                        </div>
                    </b-col>
                    <b-col lg="6">
                        <div
                            v-show="markerDestination.position.lat"
                            class="pb-3"
                        >
                            <b-card title="Tujuan Perjalanan" class="shadow">
                                <hr />
                                <strong class="font-weight-bold">Alamat</strong>
                                <div>
                                    {{ destination.address }}
                                </div>
                                <div>
                                    <strong>Lat: </strong>
                                    <span>{{
                                        markerDestination.position.lat
                                    }}</span>
                                    <strong>Lng: </strong>
                                    <span>{{
                                        markerDestination.position.lng
                                    }}</span>
                                </div>
                                <strong>
                                    Area
                                </strong>
                                <ul>
                                    <li
                                        v-for="(v, i) in destination.area"
                                        :key="i"
                                    >
                                        {{ convertSpIdToText(v) }}
                                    </li>
                                </ul>
                            </b-card>
                        </div>
                    </b-col>
                </b-row>
            </b-col>
            <b-col md="6">
                <b-card class="shadow mb-3" v-show="markerDestination.position.lat &&
                            markerOrigin.position.lat">

                <div>
                    <label for="parking_guarantor">
                        Penanggung Biaya Parkir
                    </label>
                    <b-form-radio-group
                        slot="bottom"
                        id="parking_guarantor"
                        button-variant="outline-primary"
                        v-model="input.parking_guarantor"
                        :options="options.parking_guarantors"
                        buttons
                        name="parking_guarantor"
                        class="btn-block"
                    ></b-form-radio-group>
                </div>
                <div>
                    <label for="parking_guarantor">
                        Model Transportasi
                    </label>
                    <b-form-radio-group
                        slot="bottom"
                        id="travel_model"
                        button-variant="outline-primary"
                        v-model="input.travel_model"
                        :options="options.travel_models"
                        buttons
                        stacked
                        name="travel_model"
                        class="btn-block"
                    ></b-form-radio-group>
                </div>
                <div>
                          <label for="transportation_mode">
                        Moda Transportasi
                    </label>
                    <b-form-select
                        plain
                        id="transportation_mode"
                        class="form-control-lg shadow-sm"
                        :options="
                            [0].includes(input.travel_model)
                                ? options.transportation_modes.slice(2, 6)
                                : options.transportation_modes
                        "
                        v-model="input.transportation_mode"
                        :disabled="input.travel_model==null"
                    >
                        <template slot="first">
                            <option :value="null" disabled
                                >-- Pilih Moda Transportasi --</option
                            >
                        </template>
                    </b-form-select>
                </div>

                </b-card>
                <div
                    class="pb-3"
                    v-show="surveyPreference.length >0
                    "
                >
                    <b-card
                        title="Pertanyaan Preferensi"
                        class="shadow"
                    >

                    <ul v-for="(v,i) in surveyPreference" :key="i">
                        <li class="mb-0">{{i+1}}. {{v}}</li>
                    </ul>
                        <!-- <hr />
                        <div v-show="hasParking">
                            Preferensi Kebijakan Tarif Parkir
                        </div>
                        <div v-show="hasFeederReguler">
                            Preferensi Kebijakan Layanan Feeder (reguler)
                        </div>
                        <div v-show="hasFeederPremium">
                            Preferensi Kebijakan Layanan Feeder (premium)
                        </div>
                        <div v-show="hasFeederPark">
                            Preferensi Kebijakan Layanan Feeder & Parkir
                        </div>
                        <div v-show="hasParkRide">
                            Preferensi Layanan Park & Ride
                        </div>
                        <div v-show="hasParkRideHypotetical">
                            Preferensi Layanan Park & Ride (Hypotetical)
                        </div>
                        <div v-show="hasPedestrian">
                            Preferensi Kebijakan Jalur Pedestrian
                        </div>
                        <div v-show="hasCycle">
                            Preferensi Kebijakan Jalur Sepeda
                        </div> -->
                    </b-card>
                </div>
                <div v-if="routes" class="pb-3">
                    <b-card title="Hasil Simulasi" class="shadow">
                        <hr />
                        <div>
                            <div v-if="routes.mrt.path.length !== 0">
                                <!-- <h5>Menggunakan MRT</h5> -->
                                <strong>
                                    Stasiun MRT yang anda lewati
                                </strong>
                                <div>
                                    <b-badge
                                        variant="primary"
                                        v-for="(v, i) in routes.mrt.stations"
                                        :key="`station-${i}`"
                                    >
                                        {{ v.name }}
                                    </b-badge>
                                </div>
                                <div
                                    v-if="
                                        routes.mrt.path.length !== 0 &&
                                            routes.feeder.path.length == 0
                                    "
                                >
                                    <strong>
                                        Total durasi dari posisi anda - MRT -
                                        tujuan anda :
                                    </strong>
                                    <div>
                                        {{ routes.summary.duration_with_mrt }}
                                    </div>
                                </div>
                                <div
                                    v-if="
                                        routes.mrt.path.length !== 0 &&
                                            routes.feeder.path.length !== 0
                                    "
                                >
                                    <strong>
                                        Total durasi dari posisi anda - Feeder -
                                        MRT - tujuan anda :
                                    </strong>
                                    <div>
                                        {{
                                            routes.summary
                                                .duration_with_mrt_and_feeder
                                        }}
                                    </div>
                                </div>
                            </div>

                            <hr />
                        </div>
                        <div
                            v-if="
                                routes.mrt.path.length == 0 &&
                                    routes.feeder.path.length !== 0
                            "
                        >
                            <strong>
                                Total durasi dari posisi anda - Feeder - tujuan
                                anda :
                            </strong>
                            <div>
                                {{ routes.summary.duration_with_feeder }}
                            </div>
                        </div>
                        <h5>
                            Menggunakan Transportasi Biasa (versi Google)
                        </h5>
                        <div>Jarak : ({{ routes.google.distance }})</div>
                        <div>Durasi : ({{ routes.google.duration }})</div>
                        <div v-if="routes.summary">
                            <hr />
                            <h5>
                                KESIMPULAN
                            </h5>
                            <div>
                                {{ routes.summary.the_better }}
                            </div>
                        </div>
                    </b-card>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import TravelMap from "./TravelMap";
import debounce from "lodash/debounce";
//   import AutoCompletePlace from "@/gmaps/components/AutoCompletePlace.vue";
import { EventBus } from "@/gmaps/event.js";
export default {
    name: "App",
    components: {
        TravelMap
    },
    data() {
        return {
            isLoading: false,
            input: {
                parking_guarantor: null,
                travel_model: null,
                transportation_mode: null,
                travel_origin: null
            },
            markerDestination: {
                position: {
                    lat: null,
                    lng: null
                },
                title: "Tujuan Perjalanan"
            },
            markerOrigin: {
                position: {
                    lat: null,
                    lng: null
                },
                title: "Asal Perjalanan"
            },
            origin: {
                address: "",
                area: []
            },
            destination: {
                address: "",
                area: []
            },
            options: {
                transportation_modes: [],
                travel_models: [
                    {
                        text: "Mobil/Motor (pengemudi/penumpang)",
                        value: 0
                    },
                    {
                        text: "Angkutan Umum",
                        value: 1
                    },
                    {
                        text:
                            "Mobil/Motor dan Angkutan Umum (kombinasi keduanya)",
                        value: 2
                    }
                ],
                parking_guarantors: [
                    {
                        text: "Pribadi",
                        value: 1
                    },
                    {
                        text: "Perusahaan",
                        value: 2
                    },
                    {
                        text: "Lain-lain",
                        value: 3
                    }
                ]
            },
            routes: null,
            selectedOrigin: "",
            selectedDestination: "",
            surveyPreference:[],
            isOriginFetching: false,
            isDestinationFetching: false,
            apiKey: process.env.MIX_GMAPS_CLIENT_API_KEY
        };
    },
    watch: {},
    created() {
        EventBus.$on("addMarker", data => {
            this.addMarker(data);
        });
        this.getData();
    },
    computed: {
        // checkSp() {
        //     if (origin.area.includes(5)) {
        //         return "SP Feeder Reguler, SP Feeder Premium";
        //     }
        //     if (destination.area.includes(1)) {
        //         return "SP Parkir";
        //     }
        //     if (destination.area.includes(1)) {
        //         return "SP Parkir";
        //     }
        // },

        hasParking() {
            return this.hasPedestrian
                ? false
                : this.hasCycle
                ? false
                : this.destination.area.includes(1)
                ? true
                : false;
        },
        hasFeederReguler() {
            return this.hasPedestrian
                ? false
                : this.hasCycle
                ? false
                : this.hasParking
                ? this.origin.area.includes(5)
                    ? true
                    : false
                : this.origin.area.includes(5)
                ? true
                : false;
        },
        hasFeederPremium() {
            return this.hasFeederReguler ? true : false;
        },
        hasFeederPark() {
            return;
            this.hasPedestrian
                ? false
                : this.hasCycle
                ? false
                : this.hasFeederReguler
                ? true
                : false;
        },
        hasParkRide() {
            return this.hasPedestrian
                ? false
                : this.hasCycle
                ? false
                : this.hasFeederReguler
                ? false
                : this.origin.area.includes(4)
                ? true
                : false;
        },
        hasParkRideHypotetical() {
            return this.hasPedestrian
                ? false
                : this.hasCycle
                ? false
                : this.hasFeederReguler
                ? false
                : this.origin.area.includes(4)
                ? false
                : true;
        },
        hasPedestrian() {
            return this.origin.area.includes(3) &&
                this.destination.area.includes(3)
                ? true
                : false;
        },
        hasCycle() {
            return this.hasPedestrian
                ? false
                : this.origin.area.includes(2) &&
                  this.destination.area.includes(2)
                ? true
                : false;
        }
    },
    methods: {
        convertSpIdToText(id) {
            return id == 1
                ? "Parkir"
                : id == 2
                ? "Sepeda"
                : id == 3
                ? "Pedestrian"
                : id == 4
                ? "Park and Ride"
                : id == 5
                ? "Feeder"
                : null;
        },
        submit() {
            // this.isLoading = true;
            this.$refs.travelmap.getRoutes();
        },
        handleClick(e) {
            // console.log(e.latLng);
        },
        addMarker(data) {
            if (!this.markerOrigin.position.lat) {
                this.markerOrigin.position.lat = data.position.latlng.lat();
                this.markerOrigin.position.lng = data.position.latlng.lng();
                this.origin.address = data.position.address;
                this.origin.area = data.area;
                return;
            }
            if (this.markerOrigin.position.lat) {
                this.markerDestination.position.lat = data.position.latlng.lat();
                this.markerDestination.position.lng = data.position.latlng.lng();
                this.destination.address = data.position.address;
                this.destination.area = data.area;
                return;
            }
        },
        getData() {
            axios
                .get(``)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        submit() {
            this.$store.dispatch("isLoading", true);
            this.$refs.travelmap.getRoutes();
        }
    }
};
</script>

<style lang="scss" scoped>
.travel-map {
    height: 500px;
    max-height: 500px;
}
</style>
