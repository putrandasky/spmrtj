<template>
    <div>
        <!-- <b-card class="w-100 mb-3" no-body>
            <h5 class="mb-0 font-weight-bold py-1 text-primary">
                Preferensi Layanan Park & Ride Pengguna Motor Pribadi
                (Hypotethical)
            </h5>
        </!-->
        <div class="w-100 text-primary text-justify">
            <p>
                Jika dijalur perjalanan Anda ada layanan MRT yang bisa digunakan setiap hari dan terdapat lokasi
                park & ride dengan fasilitas sesuai yang Anda inginkan dan
                berjarak sejauh dari
                <b-badge variant="primary">
                    <h6 class="mb-0 font-weight-bold">
                        <transition name="slide-shrink-fade" mode="out-in">
                            <span :key="currentData.questionState.distance">
                                {{ currentData.questionState.distance }}
                            </span>
                        </transition>
                        km
                    </h6>
                </b-badge>
                dari stasiun MRT, dengan tarif parkir sebesar
                <b-badge variant="primary">
                    <h6 class="mb-0 font-weight-bold">
                        Rp 5.000
                    </h6>
                </b-badge>
                - flat / hari
                <span v-show="currentData.questionState.time">
                    dan layanan feeder untuk mengantar anda ke stasiun dengan
                    perjalanan selama
                    <b-badge variant="primary">
                        <h6 class="mb-0 font-weight-bold">
                            <transition name="slide-shrink-fade" mode="out-in">
                                <span :key="currentData.questionState.time">
                                    {{ currentData.questionState.time }}
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
                                <span
                                    :key="currentData.questionState.feeder_cost"
                                >
                                    {{
                                        currentData.questionState.feeder_cost
                                            | currency
                                    }}
                                </span>
                            </transition>
                        </h6>
                    </b-badge>
                </span>
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
    name: "SurveyPreferenceParkRideHypoMotor",
    props: ["spTitle", "spId"],
    components: {
        QuestionSlot
    },
    data: function() {
        return {
            questionIndex: 1,
            currentData: {
                questionState: {}
            },
            stateDataCollection: {
                sp_id: this.spId,
                data: []
            },
            questions: [
                {
                    id: 1,
                    distance: 0.5,
                    time: null,
                    feeder_cost: null
                },
                {
                    id: 2,
                    distance: 1,
                    time: 5,
                    feeder_cost: 3500
                },
                {
                    id: 3,
                    distance: 2,
                    time: 10,
                    feeder_cost: 3500
                },
                {
                    id: 4,
                    distance: 3,
                    time: 15,
                    feeder_cost: 3500
                },
                {
                    id: 5,
                    distance: 5,
                    time: 20,
                    feeder_cost: 5000
                },
                {
                    id: 6,
                    distance: 8,
                    time: 30,
                    feeder_cost: 5000
                },
                {
                    id: 7,
                    distance: 10,
                    time: 40,
                    feeder_cost: 5000
                }
            ]
        };
    },
    created() {
        this.questionIndex = 1;
        this.currentData.questionState = this.questions[0];
    },
    watch: {
        questionIndex(newVal, oldVal) {
            let self = this;

            if (this.questionIndex > this.questions.length) {
                this.submitStateCollection();
            } else {
                self.currentData.questionState = self.questions[newVal - 1];
            }
        }
    },
    computed: {},
    methods: {
        submit(respond) {
            let self = this;
            let questionId = this.currentData.questionState.id;
            this.stateDataCollection.data.push({
                question_id: questionId,
                respond: respond
            });
            self.questionIndex++;
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
                    `respondent/survey/preference/park-ride-hypo-motor?token=${this.$route.query.token}`,
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
        }
    }
};
</script>
<style></style>
