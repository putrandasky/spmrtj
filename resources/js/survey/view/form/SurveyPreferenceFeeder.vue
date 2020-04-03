<template>
    <div>
        <!-- <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Feeder Reguler
                </h5>
            </b-card>
        </div> -->
        <opening
            v-if="content == 'intro1'"
            @onClick="content = 'intro2'"
            :title="spTitle"
        ></opening>
        <opening-second
            v-if="content == 'intro2'"
            @onClick="content = 'main'"
            :title="spTitle"
        ></opening-second>
        <div v-if="content == 'main'">
            <div
                class="w-100 text-primary  text-justify"
                v-show="stateQuestion == 'primary'"
            >
                <p>
                    Jika Anda dapat melakukan perjalanan Anda dengan menggunakan
                    layanan pengumpan dengan memperoleh penghematan waktu
                    sebesar
                    <b-badge variant="primary">
                        <h6 class="mb-0 font-weight-bold">
                            <transition name="slide-shrink-fade" mode="out-in">
                                <span :key="currentData.timeState.amount">
                                    {{ currentData.timeState.amount }}
                                </span>
                            </transition>
                            menit
                        </h6>
                    </b-badge>
                    dengan tarif
                    <b-badge variant="primary">
                        <h6 class="mb-0 font-weight-bold">
                            Rp
                            <transition name="slide-shrink-fade" mode="out-in">
                                <span :key="currentData.costState.amount">
                                    {{
                                        currentData.costState.amount | currency
                                    }}
                                </span>
                            </transition>
                        </h6>
                    </b-badge>
                </p>
                <p>
                    apakah Anda akan menggunakan layanan pengumpan tersebut
                    untuk melakukan perjalanan rutinitas Anda?
                </p>
                <div class="btn-group w-100 " role="group">
                    <b-btn variant="outline-danger" @click="submit(0)">
                        Tidak
                    </b-btn>
                    <b-btn variant="outline-success" @click="submit(1)">
                        Ya
                    </b-btn>
                </div>
            </div>
            <question-slot class="w-100" v-show="stateQuestion == 'secondary'">
                <template slot="above">
                    Apa yang membuat kamu tidak ingin beralih menggunakan
                    Feeder?
                </template>
                <template slot="bottom">
                    <b-button
                        block
                        variant="primary"
                        @click="submitSecondary('time')"
                    >
                        Cuma menghemat sedikit waktu
                    </b-button>
                    <b-button
                        block
                        variant="primary"
                        @click="submitSecondary('cost')"
                    >
                        Tarifnya kemahalan
                    </b-button>
                </template>
            </question-slot>
        </div>
        <div  v-if="content == 'main2'">
            <question-slot>
                        <template slot="above" class="text-justify">
                    Jika Anda menggunakan layanan pengumpan, apakah Anda akan menggunakan layanan MRT untuk melanjutkan perjalanan Anda?
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="travel_purpose"
                        stacked
                        v-model="stateDataCollection.isUsingFeederReguler"
                        :options="options.isUsingFeederReguler"
                        button-variant="outline-primary"
                        buttons
                        name="is_using_feeder_reguler"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        @click="submitStateCollection()"
                        block
                        v-if="stateDataCollection.isUsingFeederReguler !== null"
                        >Kirim</b-btn
                    >
                </template>
            </question-slot>
        </div>
    </div>
</template>
<script>
import Opening from "./SurveyPreferenceOpening";
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
import OpeningSecond from "./SurveyPreferenceOpeningSecond";
export default {
    name: "SurveyPreferenceFeeder",
    props: ["spTitle","spId"],
    components: { QuestionSlot, Opening,OpeningSecond },
    data: function() {
        return {
            content: 'intro1',
            costIndex: null,
            timeIndex: null,
            concern: "",
            stateQuestion: "primary",
            initiateQuestion: true,
            currentData: {
                timeState: {},
                costState: {}
            },
            options:{
                isUsingFeederReguler:[
                    {
                        text: "Ya, saya akan menggunakan layanan MRT.",
                        value: 1
                    },
                    {
                        text: "Tidak, saya akan menggunakan moda lain",
                        value: 0
                    }
                ]
            },
            stateDataCollection: {
                sp_id: this.spId,
                preferedConcern: "",
                isUsingFeederReguler: null,
                data: []
            },
            times: [
                {
                    id: null,
                    amount: null
                }
            ],
            costs: [
                {
                    id: null,
                    amount: null
                }
            ]
        };
    },
    created() {
        this.getData();
    },
    watch: {
        timeIndex(newVal, oldVal) {
            let self = this;
            console.log(newVal);
            console.log(this.stateDataCollection.preferedConcern);

            if (
                this.stateDataCollection.preferedConcern == "cost" &&
                this.timeIndex < 4
            ) {
                console.log("A");
                this.content = 'main2';
            } else {
                if (this.timeIndex > 0) {
                    console.log("D");
                    self.currentData.timeState = self.times[newVal - 1];
                } else {
                    console.log("E");
                    // console.log(this.stateDataCollection);
                    this.content = 'main2';
                }
            }
        },
        costIndex(newVal, oldVal) {
            let self = this;
            if (this.costIndex > 0 && this.costIndex <= 6) {
                self.currentData.costState = self.costs[newVal - 1];
            } else {
                // console.log(this.stateDataCollection);
                this.content = 'main2';
            }
        }
    },
    computed: {},
    methods: {
        checkThreshold(newIndex) {
            // if (newIndex > 2) {
            //     return true;
            // } else {
            //     return (
            //         this.times[newIndex].amount <
            //         this.$store.getters.saving_time
            //     );
            // }
        },
        submit(respond) {
            let self = this;

            let timeId = this.currentData.timeState.id;
            let costId = this.currentData.costState.id;
            this.stateDataCollection.data.push({
                time_id: timeId,
                cost_id: costId,
                respond: respond
            });
            console.log(this.stateDataCollection.data);

            if (this.initiateQuestion) {
                self.initiateQuestion = false;
                if (!respond) {
                    this.stateQuestion = "secondary";
                    return;
                }
            }
            if (this.concern == "cost") {
                if (respond || (self.costIndex == 6 && self.timeIndex == 3)) {
                    self.timeIndex--;
                    return;
                } else {
                    self.costIndex++;
                    return;
                }
            }
            if (this.concern == "time" || this.concern == "") {
                respond
                    ? self.timeIndex == 1 && self.costIndex > 4
                        ? self.timeIndex--
                        : self.costIndex--
                    : self.timeIndex == 1 && self.costIndex >= 4
                    ? self.costIndex++
                    : self.timeIndex--;
            }
        },
        submitSecondary(concern) {
            let self = this;

            this.concern = concern;
            this.stateDataCollection.preferedConcern = concern;
            this.stateQuestion = "primary";
            concern == "time" ? self.timeIndex-- : self.costIndex++;
        },
        submitStateCollection() {
            this.$store.dispatch("isLoading", true);
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);

            //     this.$emit("finish", 1);
            // }, 1000);

            let self = this;
            // this.stateDataCollection.respondent_id = this.$store.state.respondent.id
            // this.$store.dispatch('isLoading', true)
            axios
                .post(
                    `respondent/survey/preference/feeder?token=${this.$route.query.token}`,
                    self.stateDataCollection
                )
                .then(response => {
                    console.log(response.data);
                    // this.$store.dispatch('storeToken', response.data)
                    this.$store.dispatch("isLoading", false);
                    // this.$bvToast.toast(response.data.message, {
                    //     title: `SUCCESS`,
                    //     variant: "success",
                    //     autoHideDelay: 1000,
                    //     solid: true
                    // });
                    this.$emit("finish", 1);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getData() {
            this.isLoading = true;
            let self = this;
            axios
                .get(`respondent/survey/preference/feeder`)
                .then(response => {
                    console.log(response.data);
                    self.times = response.data.time_preferences;
                    self.costs = response.data.cost_preferences;
                    self.costIndex = 4;
                    self.timeIndex = 4;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style></style>
