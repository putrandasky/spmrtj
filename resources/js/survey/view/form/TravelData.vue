<template>
    <div>
        <!-- <div class="w-100 text-center">
            <h4 class="mb-4 text-primary font-weight-bold">
                Bagian II : Data Perjalanan
            </h4>
        </div> -->
        <b-row v-if="step == 1">
            <question-slot>
                <template slot="above">Pilih Alamat Asal Perjalanan</template>
                <template slot="text">* Asal perjalanan, biasanya rumah / tempat tinggal atau homebase trip berbasis tempat tinggal</template>
                <template slot="bottom">
                    <auto-complete-place
                        class="w-100 pt-0"
                        placeholder="Ketik untuk cari..."
                        @hit="addPlace($event, 'origin')"
                        @onkeyup="input.travel_origin = null"
                        readonly
                    ></auto-complete-place>
                </template>
            </question-slot>

            <div class="w-100 text-center">
                <h4 class="text-primary">
                    atau
                </h4>
                <p>
                    Pilih lokasi di peta
                </p>
            </div>
            <b-col cols="12" class=" px-0">
                <google-map ref="travelmap" class="travel-map shadow-sm" />
            </b-col>
            <b-button
                v-if="input.travel_origin"
                type="submit"
                variant="success"
                class="mx-auto px-5 mt-3"
                @click="handleNextStep(2)"
            >
                Lanjut
            </b-button>
        </b-row>
        <b-row v-if="step == 2">
            <question-slot>
                <template slot="above">Pilih Alamat Tujuan Perjalanan</template>
                <template slot="text">*Perjalanan rutin untuk beraktivitas sehari- hari dalam kondisi normal : bekerja, sekolah, berdagang, dll</template>                <template slot="bottom">
                    <auto-complete-place
                        class="w-100 pt-0"
                        placeholder="Ketik untuk cari..."
                        @hit="addPlace($event, 'destination')"
                        @onkeyup="input.travel_destination = null"
                        readonly
                    ></auto-complete-place>
                </template>
            </question-slot>

            <div class="w-100 text-center">
                <h4 class="text-primary">
                    atau
                </h4>
                <p>
                    Pilih lokasi di peta
                </p>
            </div>
            <b-col cols="12" class=" px-0">
                <google-map ref="travelmap" class="travel-map shadow-sm" />
            </b-col>
            <b-button
                v-if="input.travel_destination"
                type="submit"
                variant="success"
                class="mx-auto px-5 mt-3"
                @click="step = 3"
            >
                Lanjut
            </b-button>
        </b-row>

        <question-slot class="w-100  " v-if="step == 3">
            <template slot="above">
                Maksud Anda dalam melakukan perjalanan
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.travel_purpose"
                    :options="options.travel_purposes"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 4"
                    v-if="input.travel_purpose"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>

        <question-slot class="w-100  " v-if="step == 4">
            <template slot="above">
                Dari perjalanan tersebut,jenis moda transportasi apa yang anda
                gunakan?
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    slot="bottom"
                    id="travel_model"
                    stacked
                    button-variant="outline-primary"
                    v-model="input.travel_model"
                    :options="options.travel_model"
                    buttons
                    name="travel_model"
                    class="btn-block"
                ></b-form-radio-group>
                <b-button
                    block
                    type="submit"
                    variant="success"
                    class="mx-auto px-5"
                    @click="step = 5"
                    v-if="input.travel_model !== null"
                    >Lanjut</b-button
                >
            </template>
        </question-slot>
        <div v-if="step == 5">
            <question-slot>
                <template slot="above">
                    Frekuensi Anda melakukan perjalanan
                </template>
                <template slot="bottom">
                    <b-badge variant="primary" class="mb-3">
                        <h6 class="mb-0 p-1">
                            {{ input.trip_frequency }} hari per minggu
                        </h6>
                    </b-badge>
                    <range-slider
                        id="trip_frequency"
                        class="p-0"
                        v-model.number="input.trip_frequency"
                        min="1"
                        max="7"
                        step="1"
                        :disabled="submitting"
                    ></range-slider>
                </template>
            </question-slot>
            <question-slot
                class="border-top pt-3 mt-3"
                v-if="[0, 2].includes(input.travel_model)"
            >
                <hr />
                <template slot="above">
                    Biaya parkir yang Anda keluarkan dalam satu hari
                </template>
                <template slot="bottom">
                    <b-badge variant="primary" class="mb-3">
                        <h6 class="mb-0 p-1">
                            Rp. {{ input.parking_cost | currency }}
                        </h6>
                    </b-badge>
                    <range-slider
                        id="trip_frequency"
                        class="p-0"
                        v-model.number="input.parking_cost"
                        min="0"
                        max="50000"
                        step="1000"
                        :disabled="submitting"
                    ></range-slider>
                </template>
            </question-slot>
            <question-slot
                class="border-top pt-3 mt-3"
                v-if="[0, 2].includes(input.travel_model)"
            >
                <hr />
                <template slot="above">
                    Penanggung Biaya Parkir
                </template>
                <template slot="bottom">
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
                </template>
            </question-slot>

            <question-slot
                class="border-top pt-3 mt-3"
                v-if="[0, 2].includes(input.travel_model)"
            >
                <hr />
                <template slot="above">
                    Jenis tempat pakir yang Anda gunakan
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        slot="bottom"
                        id="parking_type"
                        stacked
                        button-variant="outline-primary"
                        v-model="input.parking_type"
                        :options="options.parking_types"
                        buttons
                        name="parking_type"
                        class="btn-block"
                    ></b-form-radio-group>
                </template>
            </question-slot>

            <b-button
                block
                type="submit"
                variant="success"
                class="mx-auto px-5 mt-3"
                @click="step = 6"
                v-if="
                    [0, 2].includes(input.travel_model)
                        ? input.trip_frequency > 0 &&
                          input.parking_cost > 0 &&
                          parking_guarantors !== null &&
                          input.parking_type !== null
                        : input.trip_frequency > 0
                "
            >
                Lanjut
            </b-button>
        </div>
        <div v-if="step == 6">
            <b-row
                class="px-3"
                v-for="(v, i) in input.travel_detail"
                :key="i"
                v-show="!isLoading && input.travel_detail.length == i + 1"
            >
                <h5 class="mb-0 font-weight-bold text-primary">
                    Mohon detailkan setiap moda transportasi yang digunakan
                    dalam melakukan perjalanan dari tempat asal ke tempat tujuan
                </h5>
                <div class="text-left py-2">
                    <small>
                        <em>nb : jalan kaki merupakan moda transportasi.</em>
                    </small>
                </div>
                <div class="mb-3  py-1 w-100">
                    <h6 class="mb-0 text-primary">
                        <strong v-if="i == 0">
                            Tempat asal
                            <span class="text-primary">--</span>
                            pemberhentian ke-1
                        </strong>
                        <strong v-if="i > 0">
                            Pemberhentian ke {{ i }}
                            <span class="text-primary">--</span>
                            pemberhentian ke-
                            {{ i + 1 }}
                        </strong>
                    </h6>
                    <hr />
                </div>

                <h5 class="font-weight-bold text-primary">
                    Moda transportasi yang digunakan
                </h5>

                <b-form-select
                    plain
                    id="transportation_mode"
                    class="form-control-lg shadow-sm"
                    :options="
                        [0].includes(input.travel_model)
                            ? options.transportation_modes.slice(2, 6)
                            : options.transportation_modes
                    "
                    v-model="v.transportation_mode"
                    :disabled="submitting"
                >
                    <template slot="first">
                        <option :value="null" disabled
                            >-- Pilih Moda Transportasi --</option
                        >
                    </template>
                </b-form-select>
                <hr />
                <div class="w-100 mt-3" v-if="v.transportation_mode">
                    <div
                        v-if="
                            notRequiredWaitingTime.indexOf(
                                v.transportation_mode
                            ) == -1
                        "
                    >
                        <h5 class="font-weight-bold text-primary">
                            Durasi waktu tunggu
                        </h5>

                        <b-badge variant="primary" class="mb-3">
                            <h6 class="mb-0 p-1">
                                {{ v.waiting_duration }} menit
                            </h6>
                        </b-badge>
                        <range-slider
                            id="waiting_duration"
                            class="p-0"
                            v-model.number="v.waiting_duration"
                            min="0"
                            max="30"
                            step="1"
                            :disabled="submitting"
                        ></range-slider>
                    </div>
                    <div>
                        <hr />

                        <h5 class="font-weight-bold text-primary">
                            Durasi waktu perjalanan selama
                        </h5>

                        <b-badge variant="primary" class="mb-3">
                            <h6 class="mb-0 p-1">
                                {{ v.travel_duration }} menit
                            </h6>
                        </b-badge>
                        <range-slider
                            id="travel_duration"
                            class="p-0"
                            v-model.number="v.travel_duration"
                            min="0"
                            max="180"
                            step="5"
                            :disabled="submitting"
                        ></range-slider>
                    </div>
                    <hr />
                    <div
                        v-if="
                            notRequiredCost.indexOf(v.transportation_mode) == -1
                        "
                    >
                        <h5 class="font-weight-bold text-primary">
                            Biaya perjalanan
                        </h5>

                        <b-badge variant="primary" class="mb-3">
                            <h6 class="mb-0 p-1">
                                Rp. {{ v.travel_cost | currency }}
                            </h6>
                        </b-badge>
                        <div class="text-left py-2">
                            <small>
                                <em>
                                    Contoh: tarif angkutan umum bila menggunakan angkutan umum, biaya bensin bila menggunakan kendaraan pribadi ataupun diantar.
                                </em>
                            </small>
                        </div>
                        <range-slider
                            id="travel_cost"
                            class="p-0"
                            v-model.number="v.travel_cost"
                            min="0"
                            :max="hasMoreMaxCost.includes(v.transportation_mode)?'300000':'100000'"
                            :disabled="submitting"
                            step="500"
                        ></range-slider>
                    </div>
                </div>
                <!-- <b-button class=" mx-auto my-3 px-5" variant="secondary" @click="back(i)" :disabled="submitting" > -->
                <b-button
                    class="mx-auto px-5 mt-2"
                    variant="secondary"
                    @click="back(i)"
                    :disabled="submitting"
                    v-if="
                        !(
                            v.transportation_mode > 0 &&
                            (notRequiredWaitingTime.indexOf(
                                v.transportation_mode
                            ) == -1
                                ? input.travel_detail[i].waiting_duration > 0
                                    ? true
                                    : false
                                : true) &&
                            v.travel_duration > 0 &&
                            (notRequiredCost.indexOf(v.transportation_mode) ==
                            -1
                                ? input.travel_detail[i].travel_cost > 0
                                    ? true
                                    : false
                                : true)
                        ) && i > 0
                    "
                    >Kembali</b-button
                >
                <div
                    class="w-100 text-center mt-2"
                    v-if="
                        v.transportation_mode > 0 &&
                            (notRequiredWaitingTime.indexOf(
                                v.transportation_mode
                            ) == -1
                                ? input.travel_detail[i].waiting_duration > 0
                                    ? true
                                    : false
                                : true) &&
                            v.travel_duration > 0 &&
                            (notRequiredCost.indexOf(v.transportation_mode) ==
                            -1
                                ? input.travel_detail[i].travel_cost > 0
                                    ? true
                                    : false
                                : true)
                    "
                >
                    <b-button
                        variant="secondary"
                        @click="back(i)"
                        :disabled="submitting"
                        v-if="i > 0"
                        >Kembali</b-button
                    >
                    <b-button
                        variant="info"
                        @click="addTravelDetail"
                        :disabled="submitting"
                        v-if="input.travel_model > 0"
                        >Moda berikutnya</b-button
                    >
                    <b-button
                        variant="success"
                        @click="showConfirmDialog"
                        :disabled="submitting"
                    >
                        Selesai
                        <b-spinner
                            small
                            type="grow"
                            v-show="submitting"
                        ></b-spinner>
                    </b-button>
                </div>
            </b-row>
        </div>
        <b-modal
            v-model="modalWelcome"
            :no-close-on-esc="true"
            :hide-header-close="true"
            :no-close-on-backdrop="true"
            :hide-header="false"
            ok-only
            hide-footer
            centered
        >
            <template v-slot:modal-header>
                <div
                    class="d-flex justify-content-start align-items-center w-100"
                >
                    <span>
                        <lottie
                            :options="defaultOptions"
                            v-on:animCreated="handleAnimation"
                            :height="30"
                            :width="30"
                        />
                    </span>

                    <h5 class="mb-0 ml-3">
                        Petunjuk Pengisian Kuesioner
                    </h5>
                </div>
            </template>

            <p class="mb-3 text-justify">
                Terimakasih sebelumnya karena teman MRTJ sudah mengisi data
                sosial ekonomi dan akan melanjutkan survei berikutnya.
            </p>
            <p class="mb-3 text-justify">
                Pada survei bagian ini diharapkan teman MRTJ untuk mengisi
                informasi tentang perjalanan rutin pada waktu kondisi normal
                sebelum adanya kebijakan social distancing dan work from home.
                Informasi perjalanan yang diisi merupakan perjalanan rutin yang
                biasa dilakukan pada hari
                <strong>
                Selasa/rabu/kamis
                </strong>
                 untuk melakukan
                aktivitas dalam keadaan kondisi normal.
            </p>
            <p class="mb-3 text-justify">
                Perjalanan yang dimaksud adalah perjalanan yang
                <strong
                    >berawal dari rumah (tempat tinggal/homebase trip berbasis
                    tempat tinggal)
                </strong>
                menuju
                <strong>
                    tempat kegiatan beraktifitas yang biasa dilakukan
                    sehari-hari (rutinitas).
                </strong>
            </p>

            <b-btn
                variant="primary"
                class="float-right"
                @click="modalWelcome = false"
                >Saya Mengerti</b-btn
            >
        </b-modal>
    </div>
</template>
<script>
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
import AutoCompletePlace from "@/survey/components/AutoCompletePlace.vue";
import GoogleMap from "@/survey/components/google/GoogleMaps.vue";
import { EventBus } from "@/survey/event.js";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";
import animationData from "@/survey/assets/exclamation-horizontal.js";

export default {
    name: "TravelData",
    mixins: [AuthRespondent],

    props: ["routerData"],
    components: {
        AutoCompletePlace,
        GoogleMap,
        QuestionSlot
    },
    data: function() {
        return {
            defaultOptions: {
                animationData: animationData,
                loop: true
            },
            animationSpeed: 1,
            step: 1,
            notRequiredWaitingTime: [1, 2, 3, 5],
            notRequiredCost: [1, 2],
            hasMoreMaxCost:[5,6,8,9],
            modalWelcome: true,
            isLoading: false,
            submitting: false,
            input: {
                travel_origin: null,
                travel_destination: null,
                travel_purpose: null,
                travel_model: null,
                trip_frequency: 0,
                parking_guarantor: null,
                parking_cost: 0,
                parking_type: null,
                area_origin: null,
                area_destination: null,
                travel_detail: [
                    {
                        transportation_mode: null,
                        waiting_duration: 0,
                        travel_duration: 0,
                        travel_cost: 0
                    }
                ]
            },
            options: {
                travel_purposes: {},
                transportation_modes: {},
                parking_guarantors: {},
                parking_types: {},
                travel_model: [
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
                ]
            }
        };
    },
    created() {
        this.getData();
        this.$emit("childinit", this.routerData);
    },
    mounted() {
        EventBus.$on("addAreaDropMarker", data => {
            data.point == "origin"
                ? (this.input.area_origin = data.area)
                : (this.input.area_destination = data.area);
        });
    },
    computed: {},
    methods: {
        handleAnimation: function(anim) {
            this.anim = anim;
        },
        handleNext(token, routeName) {
            // let routeName = this.input.transport_guarantor_id == 1 ? 'TravelData' : 'Done'
            this.$router.replace({
                name: routeName,
                query: {
                    token: token
                }
            });
        },
        submit() {
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);
            //     this.handleNext("fsfsdf", "TravelData");
            // }, 1000);
            this.$store.dispatch("isLoading", true);

            axios
                .post(
                    `respondent/survey/travel-data?token=${this.$route.query.token}`,
                    this.input
                )
                .then(response => {
                    console.log(response.data);
                    this.$store.dispatch("storeToken", response.data);
                    this.$store.dispatch("isLoading", false);
                    if (response.data.spData.length > 0) {
                        this.handleNext(response.data.token, "SurveyPreference");
                    } else {
                        this.handleNext(response.data.token, "Done");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showConfirmDialog() {
            let self = this;
            this.boxTwo = "";
            this.$bvModal
                .msgBoxConfirm(
                    `Klik "Ya" untuk meneruskan survei, Klik "Tidak" untuk mengulang survei `,
                    {
                        title: "Apakah anda yakin dengan semua jawaban anda?",
                        okVariant: "primary",
                        okTitle: "Ya",
                        cancelTitle: "Tidak",
                        footerClass: "p-2",
                        hideHeaderClose: true,
                        centered: true
                    }
                )
                .then(value => {
                    if (value == true) {
                        this.submit();
                    }
                    if (value == false) {
                        let input = {
                            travel_origin: null,
                            travel_destination: null,
                            travel_purpose: null,
                            travel_model: null,
                            trip_frequency: 0,
                            parking_guarantor: null,
                            parking_cost: 0,
                            parking_type: null,
                            area_origin: null,
                            area_destination: null,
                            travel_detail: [
                                {
                                    transportation_mode: null,
                                    waiting_duration: 0,
                                    travel_duration: 0,
                                    travel_cost: 0
                                }
                            ]
                        };
                        self.input = input;
                        self.step = 1;
                    }
                })
                .catch(err => {
                    // An error occurred
                });
        },
        back(i) {
            this.input.travel_detail.splice(i, 1);
        },
        addTravelDetail() {
            this.input.travel_detail.push({
                transportation_mode: null,
                waiting_duration: 0,
                travel_duration: 0,
                travel_cost: 0
            });
            console.log(this.input.travel_detail);
        },
        handleNextStep(step) {
            if (step == 2) {
                EventBus.$emit("removeGoogleMapData");
                this.step = 2;
            }
            // if (step == 7) {
            //     this.input.travel_model == 0
            //         ? this.showConfirmDialog()
            //         : (this.step = 7);
            // }
        },
        addPlace(e, point) {
            point == "origin"
                ? (this.input.travel_origin = e)
                : (this.input.travel_destination = e);
            EventBus.$emit("addMarker", {
                location: e.geometry.location,
                point: point
            });
            console.log(
                "TCL: addPlace -> e.geometry.location",
                e.geometry.location
            );
        },
        getData() {
            this.$store.dispatch("isLoading", true);

            axios
                .get(`respondent/survey/travel-data`)
                .then(response => {
                    this.options.travel_purposes = this.mutateKey(
                        response.data.travel_purposes
                    );
                    this.options.transportation_modes = this.mutateKey(
                        response.data.transportation_modes
                    );
                    this.options.parking_guarantors = this.mutateKey(
                        response.data.parking_guarantors
                    );
                    this.options.parking_types = this.mutateKey(
                        response.data.parking_types
                    );
                    this.$store.dispatch(
                        "addCoverageArea",
                        response.data.coverages
                    );
                    this.$store.dispatch("isLoading", false);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        mutateKey(data) {
            let mutateData = data.map(function(item) {
                return {
                    value: item.id,
                    text: item.range || item.name || item.description,
                    state: false
                };
            });
            return mutateData;
        }
    }
};
</script>
<style>
.travel-map {
    min-height: 250px;
    height: 100%;
    width: 100%;
    /* padding: .5rem; */
}
</style>
