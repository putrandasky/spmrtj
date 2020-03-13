<template>
    <div>
        <div class="w-100 text-center">
            <h4 class="mb-4 text-primary font-weight-bold">
                Bagian IV : Informasi Tambahan
            </h4>
        </div>
        <div class="w-100  " v-if="step == 1">
            <question-slot>
                <template slot="above">
                    Apa alasan Anda menggunakan jenis kendaraan (moda) seperti
                    yang disebutkan di atas?
                </template>

                <template slot="bottom">
             <div class="w-100 text-left">
                    <small>
                        nb: Boleh memilih lebih dari satu jawaban
                    </small>
                </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="reason_using_transport"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.reason_using_transport"
                    >
                        <b-form-checkbox
                            style="text-align:unset"
                            v-for="(v, i) in options.reason_using_transport"
                            :key="i"
                            class="text-primary"
                            name="reason_using_transport"
                            :value="v.value"
                            :disabled="
                                input.reason_using_transport.length >= 5 &&
                                    input.reason_using_transport.indexOf(
                                        v.value
                                    ) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.reason_using_transport.indexOf(
                                                v.value
                                            ) > -1
                                        "
                                    >
                                        {{
                                            input.reason_using_transport.indexOf(
                                                v.value
                                            ) + 1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 2"
                        v-if="input.reason_using_transport.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <div class="w-100" v-if="step == 2">
            <question-slot>
                <template slot="above">
                    Apa alasan Anda menggunakan / tidak menggunakan layanan MRT
                    Jakarta?
                </template>
                <template slot="bottom">
                    <b-form-textarea
                        class="mb-3"
                        id="reason_is_using_mrt"
                        v-model="input.reason_is_using_mrt"
                        placeholder="Mohon isi alasan anda"
                        rows="3"
                        max-rows="6"
                    ></b-form-textarea>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 3"
                        v-if="input.reason_is_using_mrt"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <div class="w-100  " v-if="step == 3">
            <question-slot>
                <template slot="above">
                    Perbaikan apa yang Anda harapkan dari kondisi layanan MRT
                    yang ada saat ini?
                </template>
                <template slot="bottom">
              <div class="w-100 text-left">
                    <small>
                        nb: Boleh memilih lebih dari satu jawaban
                    </small>
                </div>
                    <b-form-checkbox-group
                        slot="bottom"
                        id="reason_using_transport"
                        stacked
                        button-variant="light"
                        buttons
                        class="btn-block"
                        v-model="input.mrt_improvement"
                    >
                        <b-form-checkbox
                            style="text-align:unset"
                            v-for="(v, i) in options.mrt_improvement"
                            :key="i"
                            class="text-primary"
                            name="mrt_improvement"
                            :value="v.value"
                            :disabled="
                                input.mrt_improvement.length >= 5 &&
                                    input.mrt_improvement.indexOf(v.value) == -1
                            "
                        >
                            <b-row>
                                <b-col cols="2" class="text-center px-0">
                                    <span
                                        class="rounded px-2 bg-light border border-light text-primary font-weight-bold"
                                        v-if="
                                            input.mrt_improvement.indexOf(
                                                v.value
                                            ) > -1
                                        "
                                    >
                                        {{
                                            input.mrt_improvement.indexOf(
                                                v.value
                                            ) + 1
                                        }}
                                    </span>
                                </b-col>
                                <b-col cols="10" class="pl-0 text-left">{{
                                    v.text
                                }}</b-col>
                            </b-row>
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 4"
                        v-if="input.mrt_improvement.length > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <div class="w-100" v-if="step == 4">
            <question-slot>
                <template slot="above">
                    Jika ada layanan MRT yang dapat Anda gunakan dari rumah Anda
                    menuju lokasi Anda melakukan aktivitas Anda (Kantor /
                    Sekolah), berapakah biaya yang bersedia Anda keluarkan untuk
                    menggunakan layanan MRT tersebut?
                </template>
                <template slot="bottom">
                    <div class="w-100 text-center">
                        <b-badge class="mb-3" variant="primary">
                            <h6 class="mb-0 py-1">
                                Rp. {{ input.mrt_cost | currency }}
                            </h6>
                        </b-badge>
                    </div>
                    <range-slider
                        id="mrt_cost"
                        class="p-0"
                        v-model.number="input.mrt_cost"
                        min="0"
                        max="100000"
                        step="1000"
                    ></range-slider>
                    <b-btn
                        variant="success"
                        block
                        @click="step = 5"
                        v-if="input.mrt_cost > 0"
                        >Lanjut</b-btn
                    >
                </template>
            </question-slot>
        </div>
        <question-slot v-if="step == 5">
            <template slot="above">
                Bagaimana sistem parkir di lokasi gedung tempat Anda bekerja ?
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="work_place_parking_system"
                    v-model="input.work_place_parking_system"
                    :options="options.work_place_parking_system"
                    button-variant="outline-primary"
                    buttons
                    name="work_place_parking_system"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="step = 6"
                    v-if="input.work_place_parking_system"
                >
                    Lanjut
                </b-btn>
            </template>
        </question-slot>
        <question-slot v-if="step == 6">
            <template slot="above">
                Jika Anda menggunakan angkutan umum, berapa kali Anda harus naik
                angkutan umum (bukan taksi/angkutan Online) dari rumah sampai ke
                sekolah / tempat kerja?
            </template>
            <template slot="bottom">
                <b-form-radio-group
                    id="willingness_public_transport_trip"
                    v-model="input.willingness_public_transport_trip"
                    :options="options.willingness_public_transport_trip"
                    button-variant="outline-primary"
                    stacked
                    buttons
                    name="willingness_public_transport_trip"
                    class="btn-block"
                ></b-form-radio-group>
                <b-btn
                    variant="success"
                    class="shadow-sm"
                    block
                    @click="submit"
                    v-if="input.willingness_public_transport_trip"
                >
                    Kirim
                </b-btn>
            </template>
        </question-slot>
    </div>
</template>
<script>
import QuestionSlot from "@/survey/components/slot/QuestionSlot.vue";
export default {
    name: "AdditionalData",
    components: { QuestionSlot },
    data: function() {
        return {
            step: 1,
            input: {
                reason_using_transport: [],
                mrt_improvement: [],
                work_place_parking_system: null,
                willingness_public_transport_trip: null,
                mrt_cost: 0,
                is_using_mrt: null,
                reason_is_using_mrt: ""
            },
            options: {
                reason_using_transport: [],
                mrt_improvement: [],
                work_place_parking_system: [],
                willingness_public_transport_trip: []
            }
        };
    },
    created() {
        this.getData();
    },
    methods: {
        submit() {},
        getData() {
            axios
                .get(`respondent/survey/additional-data`)
                .then(response => {
                    console.log(response.data);
                    this.options.reason_using_transport = this.mutateKey(
                        response.data.reason_using_transportation_choices
                    );
                    this.options.mrt_improvement = this.mutateKey(
                        response.data.mrt_improvement_choices
                    );
                    this.options.work_place_parking_system = this.mutateKey(
                        response.data.work_place_parking_system
                    );
                    this.options.willingness_public_transport_trip = this.mutateKey(
                        response.data.willingness_public_transport_trip
                    );
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
<style></style>
