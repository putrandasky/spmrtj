<template>
    <div>
        <!-- <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Feeder Premium
                </h5>
            </b-card>
        </div> -->
        <opening  v-if="intro" @onClick ="intro = $event" :title="spTitle"></opening>
        <div v-if="!intro">
        <div class="w-100 text-primary text-left">
            Jika Anda diharuskan membayar tambahan biaya sebesar
            <b-badge variant="primary">
                <h6 class="mb-0 font-weight-bold">
                    Rp {{ currentData.costState.amount }}
                </h6>
            </b-badge>
            dari tarif sebelumnya untuk menikmati fasilitas layanan feeder
            premium Royal Trans.
            <br />
            Apakah Anda akan menggunakan layanan pengumpan premium?
        </div>
        <div class="btn-group w-100 mt-5" role="group">
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
import Opening from './SurveyPreferenceOpening'
export default {
    name: "SurveyPreferenceCarParking",
    props:['spTitle'],
    components:{Opening},
    data: function() {
        return {
            intro: true,
            costIndex: null,
            currentData: {
                costState: {}
            },
            stateDataCollection: {
                respondent_id: null,
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

            if (this.costIndex > 5) {
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
            let self = this
            this.$store.dispatch("isLoading", true);
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);

            //     this.$emit("finish", 1);
            // }, 1000);
            axios
                .post(
                    `respondent/survey/preference/feeder-premium?token=${this.$route.query.token}`,
                    self.stateDataCollection
                )
                .then(response => {
                    console.log(response.data);
                    // this.$store.dispatch('storeToken', response.data)
                    this.$store.dispatch("isLoading", false);
                    this.$bvToast.toast(response.data.message, {
                        title: `SUCCESS`,
                        variant: "success",
                        autoHideDelay: 1000,
                        solid: true
                    });
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
                .get(`respondent/survey/preference/feeder-premium`)
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
