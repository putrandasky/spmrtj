<template>
    <div>
        <!-- <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Feeder & Parkir
                </h5>
            </b-card>
        </div> -->
        <div class="w-100 text-primary  text-justify">
            <p>

            Jika terdapat kebijakan tarif parkir sebesar
            <b>Rp. {{ spParking.maxCost | currency }}</b> , dan terdapat layanan
            pengumpan dengan memperoleh penghematan waktu sebesar
            <b>{{ spFeederReguler.maxTime }} menit</b>
            dengan tarif
            <b-badge variant="primary">
                   <h6 class="mb-0 font-weight-bold">
                        Rp
                        <transition name="slide-shrink-fade" mode="out-in">
                            <span :key="currentData.costState.amount">
                                {{ currentData.costState.amount | currency }}
                            </span>
                        </transition>
                    </h6>
            </b-badge>
            </p>
            <p>
            apakah Anda akan menggunakan layanan pengumpan tersebut untuk
            melakukan perjalanan rutinitas Anda?
            </p>
        </div>
        <div class="btn-group w-100" role="group">
            <b-btn variant="outline-danger" @click="submit(0)">
                Saya akan beralih menggunakan moda saya yang sekarang
            </b-btn>
            <b-btn variant="outline-success" @click="submit(1)">
                Saya tetap menggunakan layanan pengumpan
            </b-btn>
        </div>
    </div>
</template>
<script>
export default {
    name: "SurveyPreferenceFeederPark",
    props: ["spTitle","spId"],
    data: function() {
        return {
            spFeederReguler: {
                maxTime: null
            },
            spParking: {
                maxCost: null
            },
            costIndex: null,
            currentData: {
                costState: {}
            },
            stateDataCollection: {
                sp_id: this.spId,
                data: []
            },
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
        costIndex(newVal, oldVal) {
            let self = this;

            if (this.costIndex > this.costs.length) {
                this.submitStateCollection();
            } else {
                self.currentData.costState = self.costs[newVal - 1];
            }
        }
    },
    computed: {},
    methods: {
        submit(respond) {
            let self = this;
            let costId = this.currentData.costState.id;
            this.stateDataCollection.data.push({
                cost_id: costId,
                respond: respond
            });
            respond ?  self.costIndex++:this.submitStateCollection() ;
            console.table(this.stateDataCollection.data);
        },
        submitStateCollection() {
            let self = this;
            this.$store.dispatch("isLoading", true);
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);

            //     this.$emit("finish", 1);
            // }, 1000);
            axios
                .post(
                    `respondent/survey/preference/feeder-park?token=${this.$route.query.token}`,
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
                .get(
                    `respondent/survey/preference/feeder-park?token=${this.$route.query.token}`
                )
                .then(response => {
                    console.log(response.data);
                    // let maxCostFeeder = response.data.
                    // get index from max cost feeder reguler
                    let getIndex = response.data.cost_preference.findIndex(
                        item =>
                            item.amount ==
                            response.data.sp_feeder_reguler.cost_preference
                                .amount
                    );
                    console.log(getIndex);
                    self.spParking.maxCost =
                        response.data.sp_parking.cost_preference.amount;
                    self.spFeederReguler.maxTime =
                        response.data.sp_feeder_reguler.time_preference.amount;
                    self.costs = response.data.cost_preference;
                    self.costIndex = getIndex+1;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style></style>
