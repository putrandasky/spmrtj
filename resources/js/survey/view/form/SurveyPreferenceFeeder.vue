<template>
    <div>
        <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Feeder Reguler
                </h5>
            </b-card>
        </div>
        <div
            class="w-100 text-primary text-left"
            v-show="stateQuestion == 'primary'"
        >
            Jika Anda dapat melakukan perjalanan Anda dengan menggunakan layanan
            pengumpan dengan memperoleh penghematan waktu sebesar
            <b-badge variant="primary">
                <h6 class="mb-0 font-weight-bold">
                    {{ currentData.timeState.amount }} menit
                </h6>
            </b-badge>
            dengan tarif
            <b-badge variant="primary">
                <h6 class="mb-0 font-weight-bold">
                    Rp {{ currentData.costState.amount }}
                </h6>
            </b-badge>
            <br />
            apakah Anda akan menggunakan layanan pengumpan tersebut untuk
            melakukan perjalanan rutinitas Anda?
            <div class="btn-group w-100 mt-5" role="group">
                <b-btn variant="outline-secondary" @click="submit(0)">
                    Tidak
                </b-btn>
                <b-btn variant="outline-primary" @click="submit(1)">
                    Ya
                </b-btn>
            </div>
        </div>
        <div v-show="stateQuestion == 'secondary'">
            <b-row class="form-group">
                <b-col
                    sm="12"
                    style="text-align: justify; text-justify: inter-word;"
                >
                    <b-card class="shadow-sm text-primary">
                        Apa yang membuat kamu tidak ingin beralih menggunakan
                        Feeder?
                    </b-card>
                </b-col>
            </b-row>
            <b-button
                block
                variant="secondary"
                @click="submitSecondary('time')"
            >
                Cuma menghemat sedikit waktu
            </b-button>
            <b-button
                block
                variant="secondary"
                @click="submitSecondary('cost')"
            >
                Tarifnya kemahalan
            </b-button>
        </div>
    </div>
</template>
<script>
export default {
    name: "SurveyPreferenceCarParking",
    data: function() {
        return {
            costIndex: null,
            timeIndex: null,
            concern: "",
            stateQuestion: "primary",
            initiateQuestion: true,
            currentData: {
                timeState: {},
                costState: {}
            },
            stateDataCollection: {
                respondent_id: null,
                preferedConcern: "",
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
                this.submitStateCollection();
            } else {
                if (this.timeIndex > 0) {
                    console.log("D");
                    self.currentData.timeState = self.times[newVal - 1];
                } else {
                    console.log("E");
                    // console.log(this.stateDataCollection);
                    this.submitStateCollection();
                }
            }
        },
        costIndex(newVal, oldVal) {
            let self = this;
            if (this.costIndex > 0 && this.costIndex <= 6) {
                self.currentData.costState = self.costs[newVal - 1];
            } else {
                // console.log(this.stateDataCollection);
                this.submitStateCollection();
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

                    let self = this
        // this.stateDataCollection.respondent_id = this.$store.state.respondent.id
        // this.$store.dispatch('isLoading', true)
        axios.post(`respondent/survey/preference/feeder?token=${this.$route.query.token}`, self.stateDataCollection)
          .then((response) => {
            console.log(response.data)
            // this.$store.dispatch('storeToken', response.data)
            this.$store.dispatch('isLoading', false)
            this.$bvToast.toast(response.data.message, {
              title: `SUCCESS`,
              variant: 'success',
              autoHideDelay: 1000,
              solid: true
            })
            this.$emit("finish", 1);
          })
          .catch((error) => {
            console.log(error);
          })
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
