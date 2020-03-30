<template>
    <div>
        <!-- <b-card class="w-100 mb-3" no-body>
            <h5 class="mb-0 font-weight-bold py-1 text-primary">
                Preferensi Layanan Park & Ride Pengguna Motor Pribadi
            </h5>
        </b-card> -->

                <div class="w-100 text-primary text-justify">
                    <p>
                        Jika terdapat lokasi park & ride di stasiun MRT terdekat
                        dengan fasilitas sesuai yang Anda inginkan, dengan tarif
                        parkir sebesar
                        <b-badge variant="primary">
                            <h6 class="mb-0 font-weight-bold">
                                Rp
                                <transition
                                    name="slide-shrink-fade"
                                    mode="out-in"
                                >
                                    <span :key="currentData.costState.amount">
                                        {{
                                            currentData.costState.amount
                                                | currency
                                        }}
                                    </span>
                                </transition>
                            </h6>
                        </b-badge>
                        , Flat / hari.
                    </p>
                    <p>
                        Apakah Anda akan menggunakan fasilitas park & ride?
                    </p>
                </div>
                <div class="btn-group w-100" role="group">
                    <b-btn variant="outline-danger" @click="submit(0)">
                        Tidak, saya tidak akan menggunakan fasilitas Park & Ride
                    </b-btn>
                    <b-btn variant="outline-success" @click="submit(1)">
                        Ya, saya akan menggunakan fasilitas Park & RIde
                    </b-btn>
                </div>
    </div>
</template>
<script>
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";

export default {
    name: "SurveyPreferenceParkRideMotor",
    props: ["spTitle","spId"],
    components: {
        QuestionSlot
    },
    data: function() {
        return {
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
            respond ? this.submitStateCollection() : self.costIndex++;
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
                    `respondent/survey/preference/park-ride-motor?token=${this.$route.query.token}`,
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
                .get(`respondent/survey/preference/park-ride-motor`)
                .then(response => {
                    console.log(response.data);
                    self.costs = response.data.cost_preferences;
                    self.costIndex = 1;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style></style>
