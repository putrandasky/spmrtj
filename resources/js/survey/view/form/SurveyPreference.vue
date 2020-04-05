<template>
    <div>
        <transition name="fade" mode="out-in">
            <component
                @finish="onFinish"
                v-bind:is="component"
                :spTitle="sp_title"
                :spId="sp_id"
            ></component>
        </transition>
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
                Terimakasih teman MRTJ sudah mengisi data perjalanan dengan baik
                dan akan memulai survei preferensi yang merupakan inti dari
                diadakannya survei ini.
            </p>
            <p class="mb-3 text-justify">
                Pada survei preferensi ini, teman MRTJ akan diberikan beberapa
                pertanyaan terkait rencana kebijakan pelayanan yang sesuai dengan data
                perjalanan yang biasa dilakukan oleh teman MRTJ.
            </p>
            <p class="mb-3 text-justify">
                Diharapkan teman MRTJ bisa memberikan jawaban yang sesuai dengan
                harapan dan pilihan teman MRTJ untuk meningkatkan pelayanan MRT
                Jakarta.
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
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";

import CarParking from "@/survey/view/form/SurveyPreferenceCarParking.vue";
import Feeder from "@/survey/view/form/SurveyPreferenceFeeder.vue";
import FeederPremium from "@/survey/view/form/SurveyPreferenceFeederPremium.vue";
import FeederPark from "@/survey/view/form/SurveyPreferenceFeederPark.vue";
import Pedestrian from "@/survey/view/form/SurveyPreferencePedestrian.vue";
import Cycle from "@/survey/view/form/SurveyPreferenceCycle.vue";
import ParkRideCommon from "@/survey/view/form/SurveyPreferenceParkRideCommon.vue";
import ParkRideCar from "@/survey/view/form/SurveyPreferenceParkRideCar.vue";
import ParkRideMotor from "@/survey/view/form/SurveyPreferenceParkRideMotor.vue";
import ParkRideHypoCar from "@/survey/view/form/SurveyPreferenceParkRideHypoCar.vue";
import ParkRideHypoMotor from "@/survey/view/form/SurveyPreferenceParkRideHypoMotor.vue";
import MotorParking from "@/survey/view/form/SurveyPreferenceMotorParking.vue";
import animationData from "@/survey/assets/exclamation-horizontal.js";
export default {
    name: "SurveyPreference",
    props: ["routerData"],
    mixins: [AuthRespondent],
    components: {
        CarParking,
        Pedestrian,
        MotorParking,
        Feeder,
        Cycle,
        FeederPremium,
        ParkRideCommon,
        ParkRideCar,
        ParkRideMotor,
        ParkRideHypoCar,
        ParkRideHypoMotor,
        FeederPark
    },
    data: function() {
        return {
            defaultOptions: {
                animationData: animationData,
                loop: true
            },
            animationSpeed: 1,
            remaining_sp: [],
            current_sp: 0,
            modalWelcome: true,
            step: 1,
            component: "",
            sp_title: "",
            sp_id: null
        };
    },
    mounted() {
        // this.step = 4;
        console.log(
            "Survey Preferences",
            this.$store.state.respondent.survey_preferences
        );

        this.$emit("childinit", this.routerData);
    },
    computed: {},
    watch: {
        "$store.state.respondent.survey_preferences": "checkPreference",
        current_sp(newVal, oldVal) {
            this.sp_id = newVal;
            console.log("step", this.step);
            console.log("remaining_sp", this.remaining_sp.length);

            if (this.step > this.remaining_sp.length) {
                console.log("next");
                this.handleNext();
            }

            if (newVal == 1) {
                this.component = "Pedestrian";
                this.sp_title = "Kebijakan Layanan Jalur Pejalan Kaki";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 2) {
                this.component = "Cycle";
                this.sp_title = "Kebijakan Layanan Jalur Sepeda";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 3) {
                this.component = "CarParking";
                this.sp_title = "Kebijakan Layanan Parkir Mobil";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 4) {
                this.component = "MotorParking";
                this.sp_title = "Kebijakan Layanan Parkir Motor";
                this.$emit("spInit", { sp_title: this.sp_title });
            }

            if (newVal == 5) {
                this.component = "Feeder";
                this.sp_title = "Kebijakan Layanan Feeder Reguler";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 6) {
                this.component = "FeederPremium";
                this.sp_title = "Kebijakan Layanan Feeder Premium";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 7) {
                this.component = "FeederPark";
                this.sp_title = "Kebijakan Layanan Feeder & Parkir";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 8) {
                this.component = "ParkRideCommon";
                this.sp_title = "Preferensi Layanan Park & Ride";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 9) {
                this.component = "ParkRideCar";
                this.sp_title =
                    "Preferensi Layanan Park & Ride Pengguna Mobil Pribadi";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 10) {
                this.component = "ParkRideMotor";
                this.sp_title =
                    "Preferensi Layanan Park & Ride Pengguna Motor Pribadi";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 11) {
                this.component = "ParkRideHypoCar";
                this.sp_title =
                    "Preferensi Layanan Park & Ride Pengguna Mobil Pribadi Hypotethical";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 12) {
                this.component = "ParkRideHypoMotor";
                this.sp_title =
                    "Preferensi Layanan Park & Ride Pengguna Motor Pribadi Hypotethical";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
            if (newVal == 13) {
                this.handleNext();
                this.sp_title = "";
                this.$emit("spInit", { sp_title: this.sp_title });
            }
        }
    },
    methods: {
        handleAnimation: function(anim) {
            this.anim = anim;
        },
        checkPreference(e) {
            // check sp status is not yet completed
            let filteredData = e.filter(item => item.status == 0);
            this.remaining_sp = filteredData.map(
                item => item.survey_preference_id
            );
            // below to be commented if production
            // this.remaining_sp = [1,2,3,4,5,6,7,8,9,10,11,12]

            this.current_sp = this.remaining_sp[this.step - 1];
        },
        onFinish(e) {
            this.step += e;
                console.log('onFinish',e);

                this.current_sp = this.remaining_sp[this.step - 1];
        },
        handleNext() {
            // let routeName = this.input.transport_guarantor_id == 1 ? 'TravelData' : 'Done'
            axios
                .post(
                    `respondent/survey/preference/survey-completed?token=${this.$route.query.token}`
                )
                .then(response => {
                    console.log(response.data);
                    this.sp_title = "";
                    this.$emit("spInit", { sp_title: this.sp_title });
                    this.$router.replace({
                        name: "AdditionalData",
                        query: {
                            token: this.$route.query.token
                        }
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style></style>
