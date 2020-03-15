<template>
    <div>
        <div class="w-100 text-center">
            <h4 class="mb-4 text-primary font-weight-bold">
                Bagian III : Survei Preferensi
            </h4>
        </div>
        <transition name="fade" mode="out-in">
        <component @finish="onFinish" v-bind:is="component"></component>
        </transition>
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
export default {
    name: "SurveyPreference",
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
            step: 0,
            component: ""
        };
    },
    mounted() {
        this.step = 1;
        // console.log(this.$route.name);

    },
    computed: {},
    watch: {
        step(newVal, oldVal) {
            if (newVal == 1) {
                this.component = "CarParking"
            }
            if (newVal == 2) {
                this.component = "MotorParking"
            }
            if (newVal == 3) {
                this.component = "Cycle"
            }
            if (newVal == 4) {
                this.component = "Pedestrian"
                }
            if (newVal == 5) {
                this.component = "Feeder"
            }
            if (newVal == 6) {
                this.component = "FeederPremium"
            }
            if (newVal == 7) {
                this.component = "FeederPark"
            }
            if (newVal == 8) {
                this.component = "ParkRideCommon"
            }
            if (newVal == 9) {
                this.component = "ParkRideCar"
            }
            if (newVal == 10) {
                this.component = "ParkRideMotor"
            }
            if (newVal == 11) {
                this.component = "ParkRideHypoCar"
            }
            if (newVal == 12) {
                this.component = "ParkRideHypoMotor"
            }
            if (newVal == 13) {
                this.handleNext()
            }
        }
    },
    methods: {
        onFinish(e) {
            this.step += e
            console.log(this.step);

        },
        handleNext() {
            // let routeName = this.input.transport_guarantor_id == 1 ? 'TravelData' : 'Done'
            this.$router.replace({
                name: 'AdditionalData',
                query: {
                    token: this.$route.query.token
                }
            });
        },
    }
};
</script>
<style></style>
