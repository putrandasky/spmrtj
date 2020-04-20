<template>
    <div>
        <!-- <div class="w-100 text-center">
            <h4 class="mb-4 text-primary font-weight-bold">
                Bagian IV : Informasi Tambahan
            </h4>
        </div> -->

        <div class="w-100  " v-if="step == 1">
            <question-slot>
                <template slot="above">
                    Apa alasan Anda menggunakan jenis kendaraan (moda) seperti
                    yang Anda jawab pada bagian data perjalanan responden?
                </template>

                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="reason_using_transport"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.reason_using_transport"
                    >
                        <b-form-checkbox
                            style="text-align:unset"
                            v-for="(v, i) in options.reason_using_transport"
                            :key="i"
                            class="text-primary"
                            name="reason_using_transport"
                            :value="v.value"
                            :disabled="
                                input.reason_using_transport.length >= 5 &&
                                    input.reason_using_transport.indexOf(
                                        v.value
                                    ) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" xl="1" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.reason_using_transport.indexOf(
                                                v.value
                                            ) > -1
                                        "
                                    >
                                        {{
                                            input.reason_using_transport.indexOf(
                                                v.value
                                            ) + 1
                                        }}
                                    </span>
                                </b-col>
                                <b-col
                                    cols="10"
                                    xl="11"
                                    class="pl-0 text-left"
                                    >{{ v.text }}</b-col
                                >
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <b-btn
                        variant="success"
                        block
                        @click="handleStep(2)"
                        v-if="input.reason_using_transport.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <!-- <div class="w-100" v-if="step == 2">
            <question-slot>
                <template slot="above">
                    Apa alasan Anda menggunakan / tidak menggunakan layanan MRT
                    Jakarta?
                </template>
                <template slot="bottom">
                    <b-form-textarea
                        class="mb-3"
                        id="reason_is_using_mrt"
                        v-model="input.reason_is_using_mrt"
                        placeholder="Mohon isi alasan anda"
                        rows="3"
                        max-rows="6"
                    ></b-form-textarea>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 3"
                        v-if="input.reason_is_using_mrt"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div> -->
        <div class="w-100" v-if="step == 2">
            <question-slot>
                <template slot="above">
                    Apakah anda pernah menggunakan layanan MRT??
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="is_using_mrt"
                        v-model="input.is_using_mrt"
                        :options="options.is_using_mrt"
                        button-variant="outline-primary"
                        buttons
                        name="is_using_mrt"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 3"
                        v-if="input.is_using_mrt != null"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <div class="w-100  " v-if="step == 3">
            <question-slot>
                <template slot="above">
                    Perbaikan apa yang Anda harapkan dari kondisi layanan MRT
                    yang ada saat ini?
                </template>
                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="reason_using_transport"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.mrt_improvement"
                    >
                        <b-form-checkbox
                            style="text-align:unset"
                            v-for="(v, i) in options.mrt_improvement"
                            :key="i"
                            class="text-primary"
                            name="mrt_improvement"
                            :value="v.value"
                            :disabled="
                                input.mrt_improvement.length >= 5 &&
                                    input.mrt_improvement.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" xl="1" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.mrt_improvement.indexOf(
                                                v.value
                                            ) > -1
                                        "
                                    >
                                        {{
                                            input.mrt_improvement.indexOf(
                                                v.value
                                            ) + 1
                                        }}
                                    </span>
                                </b-col>
                                <b-col
                                    cols="10"
                                    xl="11"
                                    class="pl-0 text-left"
                                    >{{ v.text }}</b-col
                                >
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 4"
                        v-if="input.mrt_improvement.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <div class="w-100" v-if="step == 4">
            <question-slot>
                <template slot="above">
                    Jika ada layanan MRT yang dapat Anda gunakan dari rumah Anda
                    menuju lokasi Anda melakukan aktivitas Anda (Kantor /
                    Sekolah), berapakah biaya yang bersedia Anda keluarkan untuk
                    menggunakan layanan MRT tersebut?
                </template>
                <template slot="bottom">
                    <div class="w-100 text-center">
                        <b-badge class="mb-3" variant="primary">
                            <h6 class="mb-0 py-1">
                                Rp. {{ input.mrt_cost | currency }}
                            </h6>
                        </b-badge>
                    </div>
                    <range-slider
                        id="mrt_cost"
                        class="p-0"
                        v-model.number="input.mrt_cost"
                        min="0"
                        max="100000"
                        step="1000"
                    ></range-slider>
                    <b-btn
                        variant="success"
                        block
                        @click="handleStep(5)"
                        v-if="input.mrt_cost > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <question-slot v-if="step == 5">
            <template slot="above">
                Bagaimana sistem parkir di kantor atau sekolah anda ?
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="work_place_parking_system"
                    v-model="input.work_place_parking_system"
                    :options="options.work_place_parking_system"
                    button-variant="outline-primary"
                    buttons
                    name="work_place_parking_system"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="handleStep(6)"
                    v-if="input.work_place_parking_system"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot v-if="step == 6">
            <template slot="above">
                Jika Anda menggunakan angkutan umum, berapa kali Anda harus naik
                angkutan umum (bukan taksi/angkutan Online) dari rumah sampai ke
                sekolah / tempat kerja?
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="willingness_public_transport_trip"
                    v-model="input.willingness_public_transport_trip"
                    :options="options.willingness_public_transport_trip"
                    button-variant="outline-primary"
                    stacked
                    buttons
                    name="willingness_public_transport_trip"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="submit"
                    v-if="input.willingness_public_transport_trip"
                >
                    Kirim
                </b-btn>
            </template>
        </question-slot>
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
                            :options="defaultOptions2"
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
                Selamat! teman MRTJ telah menjawab semua pertanyaan preferensi
                dengan baik
            </p>
            <p class="mb-3 text-justify">
                Pada survei bagian ini, teman MRTJ akan ditanyakan beberapa
                pertanyaan penunjang untuk melengkapi survei ini.
            </p>
            <p class="mb-3 text-justify">
                Lengkapi survei ini hingga akhir untuk memperoleh kesempatan
                meraih
                <strong>
                    e-wallet senilai Rp. 100.000
                </strong>
                untuk
                <strong>
                    100 orang beruntung
                </strong>
                dan hadiah utama hadiah utama
                <strong>
                    voucher MAP Rp. 2,5 juta
                </strong>
                untuk
                <strong>
                    2 orang
                </strong>
                dengan memasukan informasi pribadi di akhir kuisioner ini
            </p>

            <b-btn
                variant="primary"
                class="float-right"
                @click="modalWelcome = false"
                >Saya Mengerti</b-btn
            >
        </b-modal>
        <b-modal
            v-model="modalComplete"
            :no-close-on-esc="true"
            :hide-header-close="true"
            :no-close-on-backdrop="true"
            :hide-header="true"
            ok-only
            hide-footer
            centered
        >
            <lottie
                :options="defaultOptions"
                v-on:animCreated="handleAnimation"
                :height="300"
            />
            <h5 class="mb-3 text-primary">
                Selamat! Semua pertanyaan survei sudah selesai dijawab dengan
                baik.
            </h5>
            <b-btn
                variant="primary"
                class="float-right"
                @click="handleNext($route.query.token, 'Completed')"
                >Lanjut</b-btn
            >
        </b-modal>
    </div>
</template>
<script>
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";
import animationData from "@/survey/assets/checklist-blue.js";
import animationData2 from "@/survey/assets/exclamation-horizontal.js";

export default {
    name: "AdditionalData",
    mixins: [AuthRespondent],
    props: ["routerData"],
    components: { QuestionSlot },
    data: function() {
        return {
            modalWelcome: true,
            defaultOptions: {
                animationData: animationData,
                loop: false
            },
            defaultOptions2: {
                animationData: animationData2,
                loop: true
            },
            animationSpeed: 1,
            modalComplete: false,

            step: 1,
            input: {
                reason_using_transport: [],
                mrt_improvement: [],
                work_place_parking_system: null,
                willingness_public_transport_trip: null,
                mrt_cost: 0,
                is_using_mrt: null,
                reason_is_using_mrt: ""
            },
            options: {
                reason_using_transport: [],
                mrt_improvement: [],
                work_place_parking_system: [],
                willingness_public_transport_trip: [],
                is_using_mrt: [
                    {
                        text: "Tidak",
                        value: 0
                    },
                    {
                        text: "Ya",
                        value: 1
                    }
                ]
            }
        };
    },
    created() {
        this.getData();
        this.$emit("childinit", this.routerData);
        console.log(this.routerData);
    },
    methods: {
        handleAnimation: function(anim) {
            this.anim = anim;
        },
        handleStep(step) {
            if (step == 2) {
                //check if has trans mode MRT
                let checkTransModes = this.$store.state.respondent.transportation_modes.filter(
                    function(item) {
                        return item == 17;
                    }
                );
                console.log(checkTransModes);
                // Skip next question if has MRT as trans mode
                if (checkTransModes != 0) {
                    this.input.is_using_mrt = 1
                    this.step = 3;
                } else {
                    this.step = 2;
                }
            }
            if (step == 5) {
                //check if has trans mode private motor and car
                let checkTransModes = this.$store.state.respondent.transportation_modes.filter(
                    function(item) {
                        return item == 3 || item == 4 || item == 5 || item == 6;
                    }
                );
                // Skip next question if doesnt have  private transport
                checkTransModes != 0 ? (this.step = 5) : (this.step = 6);
            }
            if (step == 6) {
                // this.$store.state.respondent.travel_model == 1? this.submit() : this.step = 6
                this.step = 6;
            }
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
            this.$store.dispatch("isLoading", true);

            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);
            //     this.modalComplete = true;

            // }, 1000);

            axios
                .post(
                    `respondent/survey/additional-data?token=${this.$route.query.token}`,
                    this.input
                )
                .then(response => {
                    console.log(response.data);
                    this.modalComplete = true;
                    this.$store.dispatch("isLoading", false);
                    this.$emit("childinit", {
                        progress: 100,
                        title: "Informasi Tambahan"
                    });
                    // this.handleNext(response.data.token, "Completed");
                })
                .catch(error => {
                    console.log(error);
                });
        },

        getData() {
            axios
                .get(`respondent/survey/additional-data`)
                .then(response => {
                    console.log(response.data);
                    this.options.reason_using_transport = this.mutateKey(
                        response.data.reason_using_transportation_choices
                    );
                    this.options.mrt_improvement = this.mutateKey(
                        response.data.mrt_improvement_choices
                    );
                    this.options.work_place_parking_system = this.mutateKey(
                        response.data.work_place_parking_system
                    );
                    this.options.willingness_public_transport_trip = this.mutateKey(
                        response.data.willingness_public_transport_trip
                    );
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
<style></style>
