<template>
    <div>
        <!-- <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Parkir Mobil
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
            <div class="w-100 text-primary text-justify">
                <p>
                    Jika tarif parkir yang harus Anda bayarkan untuk menggunakan
                    fasilitas parkir menjadi
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
                    untuk <strong>setiap jam</strong> namun memperoleh penghematan waktu
                    perjalanan sebesar
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
                </p>
                <p>
                    Apakah Anda akan tetap menggunakan mobil untuk melakukan
                    perjalanan rutinitas Anda?
                </p>
            </div>
            <div class="btn-group w-100" role="group">
                <b-btn variant="outline-danger" @click="submit(0)">
                    Tidak
                </b-btn>
                <b-btn variant="outline-success" @click="submit(1)">
                    Ya
                </b-btn>
            </div>
        </div>
    </div>
</template>
<script>
import Opening from "./SurveyPreferenceOpening";
import OpeningSecond from "./SurveyPreferenceOpeningSecond";
export default {
    name: "SurveyPreferenceCarParking",
    props: ["spTitle", "spId"],
    components: { Opening,OpeningSecond },
    data: function() {
        return {
            content: 'intro1',
            costIndex: null,
            timeIndex: null,
            currentData: {
                timeState: {},
                costState: {}
            },
            stateDataCollection: {
                sp_id: this.spId,
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
    mounted() {},
    watch: {
        timeIndex(newVal, oldVal) {
            let self = this;
            if (this.timeIndex > 4) {
                this.submitStateCollection();
            } else {
                self.currentData.timeState = self.times[newVal - 1];
            }
        },
        costIndex(newVal, oldVal) {
            let self = this;

            if (this.costIndex > 6) {
                this.submitStateCollection();
            } else {
                self.currentData.costState = self.costs[newVal - 1];
            }
        }
    },
    computed: {},
    methods: {
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
                    `respondent/survey/preference/park-car?token=${this.$route.query.token}`,
                    self.stateDataCollection
                )
                .then(response => {
                    console.log(response.data);
                    // this.$store.dispatch('storeToken', response.data)
                    self.$store.dispatch("isLoading", false);
                    self.$emit("finish", 1);
                    // this.$bvToast.toast(response.data.message, {
                    //     title: `SUCCESS`,
                    //     variant: "success",
                    //     autoHideDelay: 1000,
                    //     solid: true
                    // });
                })
                .catch(error => {
                    console.log(error);
                });
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
            respond ? self.costIndex++ : self.timeIndex++;
            console.table(this.stateDataCollection.data);
        },
        getData() {
            let self = this;
            axios
                .get(`respondent/survey/preference/park-car`)
                .then(response => {
                    console.log(response.data);
                    self.times = response.data.time_preferences;
                    self.costs = response.data.cost_preferences;
                    self.costIndex = 1;
                    self.timeIndex = 1;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style></style>
