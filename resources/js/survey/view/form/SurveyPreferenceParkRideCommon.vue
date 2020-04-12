<template>
    <div>
        <!-- <b-card class="w-100 mb-3" no-body>
            <h5 class="mb-0 font-weight-bold py-1 text-primary">
                Preferensi Layanan Park & Ride
            </h5>
        </b-card> -->
         <opening
            v-if="content == 'intro1'"
            @onClick="content = 'main'"
            :title="spTitle"
        ></opening>


        <div v-if="content == 'main'">
            <question-slot v-if="step == 1">
                <template slot="above">
                    Dimanakah lokasi park & ride untuk layanan MRT yang Anda
                    inginkan?
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="travel_purpose"
                        v-model="input.location"
                        :options="options.locations"
                        button-variant="outline-primary"
                        buttons
                        name="travel_purpose"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        class="shadow-sm"
                        block
                        @click="step = 2"
                        v-if="input.location"
                    >
                        Lanjut
                    </b-btn>
                </template>
            </question-slot>
            <question-slot v-if="step == 2">
                <template slot="above">
                    Jenis parkir seperti apa yang lebih Anda inginkan ?
                </template>
                <template slot="bottom">
                    <div
                        class="w-100 d-flex justify-content-between align-items-center"
                    >
                        <b-badge
                            :variant="
                                input.park_type == 1 ? 'primary' : 'light'
                            "
                            >Lebih baik <br />
                            parkir terbuka</b-badge
                        >
                        <b-badge
                            :variant="
                                input.park_type == 3 ? 'primary' : 'light'
                            "
                            >Sama saja</b-badge
                        >
                        <b-badge
                            :variant="
                                input.park_type == 5 ? 'primary' : 'light'
                            "
                            >Lebih baik <br />
                            parkir tertutup</b-badge
                        >
                    </div>
                    <range-slider
                        id="location"
                        class="p-0"
                        v-model.number="input.park_type"
                        min="1"
                        max="5"
                        step="1"
                    ></range-slider>
                    <div
                        class="w-100 d-flex justify-content-around align-items-center"
                    >
                        <b-badge
                            :variant="
                                input.park_type == 2 ? 'primary' : 'light'
                            "
                            >Parkir terbuka <br />
                            sudah cukup</b-badge
                        >
                        <b-badge
                            :variant="
                                input.park_type == 4 ? 'primary' : 'light'
                            "
                            >Parkir tertutup <br />
                            sudah cukup</b-badge
                        >

                     </div>
                     <div>
                    <small>
                        Nb : Geser untuk memilih
                    </small>
                     </div>
                    <b-btn
                        variant="success"
                        class="shadow-sm "
                        block
                        @click="step = 3"
                        v-if="input.park_type"
                    >
                        Lanjut
                    </b-btn>

                </template>
            </question-slot>
            <question-slot v-if="step == 3">
                <template slot="above">
                    <div class="mb-3">
                        Fasilitas apa saja yang Anda inginkan yang berada di
                        lokasi park & ride
                    </div>
                </template>
                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="facility"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.facility"
                    >
                        <b-form-checkbox
                            style="text-align:unset"
                            v-for="(v, i) in options.facilities"
                            :key="i"
                            name="facility"
                            :value="v.value"
                            :disabled="
                                input.facility.length >= 5 &&
                                    input.facility.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" xl="1" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.facility.indexOf(v.value) > -1
                                        "
                                    >
                                        {{
                                            input.facility.indexOf(v.value) + 1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" xl="11" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <b-btn
                        variant="success"
                        class="shadow-sm"
                        block
                        @click="step = 4"
                        v-if="input.facility.length > 0"
                    >
                        Lanjut
                    </b-btn>
                </template>
            </question-slot>
            <question-slot v-if="step == 4">
                <template slot="above">
                    Berapa lama durasi rata – rata parkir Anda jika menggunakan
                    fasilitas parkir ?
                </template>
                <template slot="bottom">
                    <div class="w-100">
                        <b-badge class="mb-3" variant="primary">
                            <h6 class="mb-0 py-1">
                                {{ input.park_duration }} Jam
                            </h6>
                        </b-badge>
                    </div>
                    <range-slider
                        id="park_duration"
                        class="p-0"
                        v-model.number="input.park_duration"
                        min="1"
                        max="16"
                        step="1"
                    ></range-slider>
                    <b-btn
                        variant="success"
                        class="shadow-sm"
                        block
                        @click="submit"
                        v-if="input.park_duration"
                    >
                        Submit
                    </b-btn>
                </template>
            </question-slot>
        </div>
    </div>
</template>
<script>
import Opening from "./SurveyPreferenceOpening";
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
export default {
    name: "SurveyPreferenceParkRideCommon",
    props: ["spTitle", "spId"],
    components: { QuestionSlot, Opening },
    data: function() {
        return {
            content: "intro1",
            step: 1,
            input: {
                sp_id: this.spId,
                location: null,
                park_type: 0,
                facility: [],
                park_duration: 0
            },
            options: {
                locations: [
                    {
                        value: "A",
                        text:
                            "Dekat stasiun MRT Jakarta lalu berjalan kaki menuju stasiun"
                    },
                    {
                        value: "B",
                        text:
                            "Dekat dengan rumah lalu menggunakan shuttle menuju Stasiun"
                    }
                ],
                facilities: [
                    {
                        value: "A",
                        text: "Toilet"
                    },
                    {
                        value: "B",
                        text: "Musholla"
                    },
                    {
                        value: "C",
                        text: "Kamera Pengawas"
                    },
                    {
                        value: "D",
                        text: "Petugas Keamanan"
                    },
                    {
                        value: "E",
                        text: "ATM"
                    },
                    {
                        value: "F",
                        text: "Kantin"
                    }
                ]
            }
        };
    },
    created() {},
    methods: {
        submit() {
            let self = this;
            this.$store.dispatch("isLoading", true);

            axios
                .post(
                    `respondent/survey/preference/park-ride-common?token=${this.$route.query.token}`,
                    self.input
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
