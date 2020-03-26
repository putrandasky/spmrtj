<template>
    <div>
        <!-- <div class="w-100 text-center">
            <h4 class="mb-4 sub-title-form text-primary font-weight-bold">
                Bagian I : Data Sosial Ekonomi
            </h4>
        </div> -->
        <question-slot v-if="step == 1">
            <template slot="above">
                Jenis kelamin
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    v-model="input.gender"
                    :options="options.gender"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 2"
                    v-if="input.gender"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 2">
            <template slot="above">
                Umur
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.age"
                    :options="options.age"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 3"
                    v-if="input.age"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 3">
            <template slot="above">
                Pendidikan terakhir
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.education"
                    :options="options.education"
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
                    v-if="input.education"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 4">
            <template slot="above">
                Pekerjaan
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.job"
                    :options="options.job"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 5"
                    v-if="input.job"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 5">
            <template slot="above">
                Pendapatan Per Bulan
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.income"
                    :options="options.income"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 6"
                    v-if="input.income"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 6">
            <template slot="above">
                Pengeluaran Per Bulan
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.expense"
                    :options="options.expense"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 7"
                    v-if="input.expense"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 7">
            <template slot="above">
                Pengeluaran Biaya Transportasi
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_expense"
                    stacked
                    v-model="input.travel_expense"
                    :options="options.travel_expense"
                    button-variant="outline-primary"
                    buttons
                    name="travel_expense"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 8"
                    v-if="input.travel_expense"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 8">
            <template slot="above">
                Penanggung Biaya Transportasi
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_guarantor"
                    stacked
                    v-model="input.travel_guarantor"
                    :options="options.travel_guarantor"
                    button-variant="outline-primary"
                    buttons
                    name="travel_guarantor"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 9"
                    v-if="input.travel_guarantor"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 9">
            <template slot="above">
                Kepemilikan SIM (Surat Izin Mengemudi)
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.license"
                    :options="options.license"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 10"
                    v-if="input.license"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot class="w-100  " v-if="step == 10">
            <template slot="above">
                Ketersediaan kendaraan pribadi
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="travel_purpose"
                    stacked
                    v-model="input.vehicle"
                    :options="options.vehicle"
                    button-variant="outline-primary"
                    buttons
                    name="travel_purpose"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    v-if="input.vehicle"
                    @click="submit"
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
                <div class="d-flex justify-content-start align-items-center w-100">
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
                Selamat datang teman MRTJ di survei yang diselenggarakan oleh
                <strong>
                    PT MRT Jakarta.
                </strong>
            </p>
            <p class="mb-3 text-justify">
                Pada survei bagian ini, teman MRTJ akan ditanyakan terlebih
                dahulu mengenai informasi pribadi teman MRTJ serta data sosial
                ekonomi yang terkait.
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
    </div>
</template>
<script>
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";
import animationData from "@/survey/assets/exclamation-horizontal.js";

export default {
    name: "SocialData",
    mixins: [AuthRespondent],
    props: ["routerData"],

    components: { QuestionSlot },
    data() {
        return {
            // isLoading:false,
            defaultOptions: {
                animationData: animationData,
                loop: true
            },
            animationSpeed: 1,
            modalWelcome: true,
            step: 1,
            options: {
                gender: [],
                age: [],
                education: [],
                job: [],
                income: [],
                expense: [],
                travel_expense: [],
                travel_guarantor: [],
                license: [],
                vehicle: []
            },
            input: {
                gender: null,
                age: null,
                education: null,
                job: null,
                income: null,
                expense: null,
                travel_expense: null,
                travel_guarantor: null,
                license: null,
                vehicle: null
            }
        };
    },
    watch: {},
    created() {
        this.getData();
        this.$emit("childinit", this.routerData);
    },
    methods: {
        handleNext(token, routeName) {
            // let routeName = this.input.transport_guarantor_id == 1 ? 'TravelData' : 'Done'
            this.$router.replace({
                name: routeName,
                query: {
                    token: token
                }
            });
        },
        handleAnimation: function(anim) {
            this.anim = anim;
        },
        submit() {
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);
            //     this.handleNext("fsfsdf", "TravelData");
            // }, 1000);
            this.$store.dispatch("isLoading", true);

            axios
                .post(
                    `respondent/survey/social-data?token=${this.$route.query.token}`,
                    this.input
                )
                .then(response => {
                    console.log(response.data);
                    this.$store.dispatch("storeToken", response.data);
                    this.handleNext(response.data.token, "TravelData");
                    this.submitting = false;
                    this.$store.dispatch("isLoading", false);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getData() {
            // this.isLoading = true;
            let self = this;
            axios
                .get(`respondent/survey/social-data`)
                .then(response => {
                    self.options.gender = this.mutateKey(response.data.gender);
                    self.options.age = this.mutateKey(response.data.age);
                    self.options.education = this.mutateKey(
                        response.data.education
                    );
                    self.options.job = this.mutateKey(response.data.job);
                    self.options.income = this.mutateKey(response.data.income);
                    self.options.expense = this.mutateKey(
                        response.data.expense
                    );
                    self.options.travel_expense = this.mutateKey(
                        response.data.travel_expense
                    );
                    self.options.travel_guarantor = this.mutateKey(
                        response.data.travel_guarantor
                    );
                    self.options.license = this.mutateKey(
                        response.data.license
                    );
                    self.options.vehicle = this.mutateKey(
                        response.data.vehicle
                    );
                    // this.isLoading = false;
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
<style lang="css" scoped></style>
