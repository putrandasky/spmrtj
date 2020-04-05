<template>
    <div class="w-100">
        <!-- <b-card class="w-100 text-center mb-3" no-body>
            <h5 class="mb-0 font-weight-bold py-1 text-primary">
                Kebijakan Layanan Jalur Sepeda
            </h5>
        </b-card> -->
        <opening
            v-if="intro"
            @onClick="intro = $event"
            :title="spTitle"
        ></opening>
        <div v-if="!intro">
            <question-slot class="w-100  " v-if="step == 1">
                <template slot="above" class="text-justify">
                    Apakah anda menggunakan jalur sepeda untuk dari ataupun
                    menuju stasiun MRT?
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="travel_purpose"
                        stacked
                        v-model="input.question_1"
                        :options="options.question_1"
                        button-variant="outline-primary"
                        buttons
                        name="is_using_mrt"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        @click="step = 2"
                        block
                        v-if="input.question_1"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
            <question-slot class="w-100  " v-if="step == 2">
                <template slot="above">
                    Apa yang membuat Anda tidak menggunakan sepeda untuk
                    beraktivitas saat ini
                </template>
                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="question_2"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.question_2"
                    >
                        <b-form-checkbox
                            class="text-primary"
                            style="text-align:unset"
                            v-for="(v, i) in options.question_2"
                            :key="i"
                            name="question_2"
                            :value="v.value"
                            :disabled="
                                input.question_2.length >= 5 &&
                                    input.question_2.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" xl="1" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.question_2.indexOf(v.value) >
                                                -1
                                        "
                                    >
                                        {{
                                            input.question_2.indexOf(v.value) +
                                                1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" xl="2" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <!-- <b-form-radio-group
                id="travel_purpose"
                stacked
                v-model="input.question_2"
                :options="options.question_2"
                button-variant="outline-primary"
                buttons
                name="travel_purpose"
                class="btn-block"
            ></b-form-radio-group> -->
                    <b-input
                        class="mb-3"
                        v-if="input.question_2.includes(9)"
                        v-model="input.question_2_other"
                        placeholder="Masukan jawaban lainnya"
                    ></b-input>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 3"
                        v-if="
                            input.question_2.includes(9)
                                ? input.question_2_other
                                    ? true
                                    : false
                                : input.question_2.length > 0
                        "
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
            <question-slot class="w-100  " v-if="step == 3">
                <template slot="above">
                    Fasilitas apa saja yang Anda inginkan tersedia pada jalur
                    sepeda?
                </template>
                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="question_2"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.question_3"
                    >
                        <b-form-checkbox
                            class="text-primary"
                            style="text-align:unset"
                            v-for="(v, i) in options.question_3"
                            :key="i"
                            name="question_3"
                            :value="v.value"
                            :disabled="
                                input.question_3.length >= 5 &&
                                    input.question_3.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" xl="1" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.question_3.indexOf(v.value) >
                                                -1
                                        "
                                    >
                                        {{
                                            input.question_3.indexOf(v.value) +
                                                1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" xl="2" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <!-- <b-form-radio-group
                id="travel_purpose"
                stacked
                v-model="input.question_3"
                :options="options.question_3"
                button-variant="outline-primary"
                buttons
                name="travel_purpose"
                class="btn-block"
            ></b-form-radio-group> -->
                    <b-btn
                        variant="success"
                        block
                        @click="step = 4"
                        v-if="input.question_3.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
            <question-slot class="w-100  " v-if="step == 4">
                <template slot="above" class="text-justify">
                    Jika jalur sepeda yang menjadi akses menuju stasiun MRT
                    memiliki fasilitas yang sesuai Anda harapkan, apakah Anda
                    akan menggunakan sepeda dari dan menuju stasiun untuk
                    menggunakan layanan MRT?
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="travel_purpose"
                        stacked
                        v-model="input.question_4"
                        :options="options.question_4"
                        button-variant="outline-primary"
                        buttons
                        name="travel_purpose"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        block
                        @click="submit"
                        v-if="input.question_4"
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
export default {
    name: "SurveyPreferenceCycle",
    props: ["spTitle", "spId"],
    components: { QuestionSlot, Opening },
    data() {
        return {
            intro: true,
            step: 1,
            options: {
                question_1: [],
                question_2: [],
                question_3: [],
                question_4: []
            },
            input: {
                sp_id: this.spId,
                question_1: null,
                question_2: [],
                question_2_other: "",
                question_3: [],
                question_4: null
            }
        };
    },
    watch: {},
    created() {
        this.getData();
    },
    methods: {
        submit() {
            let self = this;
            this.$store.dispatch("isLoading", true);
            // setTimeout(() => {
            //     this.$store.dispatch("isLoading", false);

            //     this.$emit("finish", 1);
            // }, 1000);
            axios
                .post(
                    `respondent/survey/preference/cycle?token=${this.$route.query.token}`,
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
        },
        getData() {
            this.isLoading = true;
            let self = this;
            axios
                .get(`respondent/survey/preference/cycle`)
                .then(response => {
                    // self.mutateKey(response.data)
                    // console.log(response.data);
                    this.options.question_1 = this.mutateKey(
                        response.data.filter(item => item.question_id == 1)
                    );
                    this.options.question_2 = this.mutateKey(
                        response.data.filter(item => item.question_id == 2)
                    );
                    this.options.question_3 = this.mutateKey(
                        response.data.filter(item => item.question_id == 3)
                    );
                    this.options.question_4 = this.mutateKey(
                        response.data.filter(item => item.question_id == 4)
                    );
                    // console.log(this.question_1);
                    // self.data = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        mutateKey(data) {
            let mutateData = data.map(function(item) {
                return {
                    value: item.id,
                    text: item.range || item.name || item.description,
                    state: false
                };
            });
            return mutateData;
        }
    }
};
</script>
<style lang="css" scoped></style>
