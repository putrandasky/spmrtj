<template>
  <div>
    <!-- <div class="w-100 text-center">
            <b-card class="w-100 text-center mb-3" no-body>
                <h5 class="mb-0 font-weight-bold py-1 text-primary">
                    Kebijakan Layanan Feeder Premium
                </h5>
            </b-card>
        </div> -->
    <opening v-if="content == 'intro1'" @onClick="content = 'main'" :title="spTitle"></opening>
    <div v-if="content == 'main'">
      <div class="w-100 text-primary  text-justify">
        <p>
          Jika Anda diharuskan membayar
          <strong>
            tambahan
          </strong>
          biaya sebesar
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
          dari tarif sebelumnya untuk menikmati fasilitas layanan
          feeder premium Royal Trans / DAMRI.
        </p>
        <p>
          Apakah Anda akan menggunakan layanan pengumpan premium?
        </p>
      </div>
      <div class="btn-group w-100 " role="group">
        <b-btn variant="outline-danger" @click="submit(0)">
          Tidak
        </b-btn>
        <b-btn variant="outline-success" @click="submit(1)">
          Ya
        </b-btn>
      </div>
    </div>
    <div v-if="content == 'main2'">
      <question-slot>
        <template slot="above" class="text-justify">
          Jika Anda menggunakan layanan pengumpan premium, apakah Anda
          akan menggunakan MRT untuk melanjutkan perjalanan Anda?
        </template>
        <template slot="bottom">
          <b-form-radio-group id="travel_purpose" stacked v-model="stateDataCollection.isUsingFeederPremium" :options="options.isUsingFeederPremium" button-variant="outline-primary" buttons name="is_using_feeder_premium" class="btn-block"></b-form-radio-group>
          <b-btn variant="success" @click="submitStateCollection()" block v-if="stateDataCollection.isUsingFeederPremium !== null">Kirim</b-btn>
        </template>
      </question-slot>
    </div>
  </div>
</template>
<script>
  import Opening from "./SurveyPreferenceOpening";
  import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
  export default {
    name: "SurveyPreferenceFeederPremium",
    props: ["spTitle", "spId"],
    components: {
      Opening,
      QuestionSlot
    },
    data: function() {
      return {
        intro: true,
        content: "intro1",
        costIndex: null,
        currentData: {
          costState: {}
        },
        options: {
          isUsingFeederPremium: [{
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
          isUsingFeederPremium: null,
          data: []
        },
        costs: [{
          id: null,
          amount: null
        }]
      };
    },
    created() {
      this.getData();
    },
    watch: {
      costIndex(newVal, oldVal) {
        let self = this;

        if (this.costIndex > 5) {
          this.content = "main2";
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
        respond ? this.content = "main2" : self.costIndex++;
        // respond ? this.handleAfterSubmit() : self.costIndex++;
        console.table(this.stateDataCollection.data);
      },
      handleAfterSubmit() {
        //check if respondent has using MRT
        if (this.$store.state.respondent.transportation_modes.includes(17)) {
          this.submitStateCollection()
        } else {
          this.content = "main2"
        }
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
            `respondent/survey/preference/feeder-premium?token=${this.$route.query.token}`,
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
