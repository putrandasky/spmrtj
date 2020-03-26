<template>
    <div>
        <!-- <b-card class="w-100 mb-3" no-body>
            <h5 class="mb-0 font-weight-bold py-1 text-primary">
                Kebijakan Layanan Jalur Pedestrian
            </h5>
        </!-->
        <opening
            v-if="intro"
            @onClick="intro = $event"
            :title="spTitle"
        ></opening>
        <div v-if="!intro">
            <question-slot class="w-100  " v-if="step == 1">
                <template slot="above">
                    Apa yang membuat Anda tidak menggunakan jalur pedestrian
                    saat ini?
                </template>
                <template slot="bottom">
                    <div class="w-100 text-left">
                        <small>
                            nb: Boleh memilih lebih dari satu jawaban
                        </small>
                    </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="question_1"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block "
                        v-model="input.question_1"
                    >
                        <b-form-checkbox
                            class="text-primary"
                            style="text-align:unset"
                            v-for="(v, i) in options.question_1"
                            :key="i"
                            name="question_1"
                            :value="v.value"
                            :disabled="
                                input.question_1.length >= 5 &&
                                    input.question_1.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.question_1.indexOf(v.value) >
                                                -1
                                        "
                                    >
                                        {{
                                            input.question_1.indexOf(v.value) +
                                                1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <!-- <b-form-radio-group
                id="travel_purpose"
                stacked
                v-model="input.question_1"
                :options="options.question_1"
                button-variant="outline-primary"
                buttons
                name="travel_purpose"
                class="btn-block"
            ></b-form-radio-group> -->
                    <b-input
                        class="mb-3"
                        v-if="input.question_1.includes(7)"
                        v-model="input.question_1_other"
                        placeholder="Masukan jawaban lainnya"
                    ></b-input>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 2"
                        v-if="input.question_1.includes(7)?
                        input.question_1_other ?true:false
                        :
                        input.question_1.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
            <question-slot class="w-100  " v-if="step == 2">
                <template slot="above">
                    Fasilitas pejalan kaki apa saja yang Anda inginkan tersedia
                    pada jalur pedestrian?
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
                                <b-col cols="2" class="text-center px-0">
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
                                <b-col cols="10" class="pl-0 text-left">{{
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
                    <b-btn
                        variant="success"
                        block
                        @click="step = 3"
                        v-if="input.question_2.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
            <question-slot class="w-100  " v-if="step == 3">
            <template slot="above" class="text-justify">
                    Jika jalur pedestrian yang menjadi akses menuju stasiun MRT
                    memiliki fasilitas yang sesuai Anda harapkan, apakah Anda
                    akan berjalan kaki dari dan menuju stasiun untuk menggunakan
                    layanan MRT?
                </template>
                <template slot="bottom">
                    <b-form-radio-group
                        id="travel_purpose"
                        stacked
                        v-model="input.question_3"
                        :options="options.question_3"
                        button-variant="outline-primary"
                        buttons
                        name="travel_purpose"
                        class="btn-block"
                    ></b-form-radio-group>
                    <b-btn
                        variant="success"
                        @click="submit"
                        block
                        v-if="input.question_3"
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
    name: "SurveyPreferencePedestrian",
    props: ["spTitle"],
    components: { QuestionSlot, Opening },
    data() {
        return {
            intro: true,
            step: 1,
            options: {
                question_1: [],
                question_2: [],
                question_3: []
            },
            input: {
                question_1: [],
                question_1_other: "",
                question_2: [],
                question_3: null
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
                    `respondent/survey/preference/pedestrian?token=${this.$route.query.token}`,
                    self.input
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
                .get(`respondent/survey/preference/pedestrian`)
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
