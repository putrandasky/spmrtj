<template>
    <b-col lg="9" md="10" sm="12" >
        <div class="d-flex justify-content-around mb-3">
            <b-img  src="./img/Mrt-Jkt-White-small.png"></b-img>
            <b-img   src="./img/Logo-Jaklingko-white-small.png"></b-img>
        </div>
        <div class="text-center mb-5">
            <p
                class="display-2 font-weight-bold text-white text-shadow title-form"
            >
                TERIMA KASIH
            </p>
            <p class="font-weight-bold text-white text-shadow">
                Partisipasi Anda sangat membantu kami dalam mewujudkan
                transportasi publik yang semakin baik.
            </p>
        </div>
        <b-row class="d-flex justify-content-center" v-if="!isLoading && !isSubmitted">
            <b-col lg="6">
                <b-card class="shadow text-center font-weight-bold">
                    <b-card-text>
                        <p class="text-primary">
                            Silahkan mengisi data diri Anda untuk memperoleh
                            kesempatan mendapatkan souvenir menarik.
                            <br />
                            Responden beruntung akan kami hubungi melalui kontak
                            yang diberikan.
                        </p>
                        <b-alert variant="primary" show>
                            <small>
                                <b>
                                    Nb: Informasi data diri yang Anda berikan
                                    akan dijaga kerahasiaannya.
                                </b>
                            </small>
                        </b-alert>
                    </b-card-text>
                    <b-button
                        variant="success"
                        block
                        v-if="!isSubmitted"
                        @click="inputDataModal = true"
                        >Isi data diri</b-button
                    >
                </b-card>
            </b-col>
        </b-row>
        <b-modal
            v-if="!isSubmitted"
            :no-close-on-esc="true"
            :hide-header-close="true"
            :no-close-on-backdrop="true"
            title="Mohon isi data diri anda"
            v-model="inputDataModal"
            @ok="postData"
            ok-title="Kirim"
            cancel-title="Batal"
            ok-variant="primary"
        >
            <b-form-group
                label="Nama"
                :invalid-feedback="errors.name"
                :state="stateName"
            >
                <b-input
                    autocomplete="off"
                    type="text"
                    class="form-control"
                    placeholder="Masukan nama lengkap"
                    v-model="input.name"
                    :state="stateName"
                />
            </b-form-group>
            <b-form-group
                label="Nomor Telepon"
                :invalid-feedback="errors.phone"
                :state="statePhone"
            >
                <b-input
                    autocomplete="off"
                    type="number"
                    class="form-control"
                    placeholder="Masukan nomor telepon aktif"
                    v-model="input.phone"
                    :state="statePhone"
                />
            </b-form-group>
            <b-form-group
                label="Email"
                :invalid-feedback="errors.email"
                :state="stateEmail"
            >
                <b-input
                    autocomplete="off"
                    type="text"
                    class="form-control"
                    placeholder="Masukan alamat email aktif"
                    v-model="input.email"
                    :state="stateEmail"
                />
            </b-form-group>
            <b-form-group
                label="Alamat"
                :invalid-feedback="errors.address"
                :state="stateAddress"
            >
                <b-input
                    autocomplete="off"
                    type="text"
                    class="form-control"
                    placeholder="Masukan alamat rumah lengkap"
                    v-model="input.address"
                    :state="stateAddress"
                />
            </b-form-group>
            <b-form-group
                label="Apa harapan anda untuk MRT Jakarta"
                :invalid-feedback="errors.comment"
                :state="stateComment"
            >
                <b-form-textarea
                    id="harapan"
                    v-model="input.comment"
                    :state="stateComment"
                    placeholder="Tuliskan harapan anda disini"
                    rows="6"
                    max-rows="6"
                ></b-form-textarea>
            </b-form-group>
        </b-modal>
        <b-modal
            v-model="modalComplete"
            :no-close-on-esc="true"
            :hide-header-close="true"
            :no-close-on-backdrop="true"
            :hide-header="true"
            ok-only
            hide-footer
            centered
        >
            <lottie
                :options="defaultOptions"
                v-on:animCreated="handleAnimation"
                :height="300"
            />
            <h5 class="mb-3 text-primary">Data diri anda sudah berhasil tersimpan.</h5>
            <b-btn
                variant="primary"
                class="float-right"
                @click="modalComplete = false"
                >Tutup</b-btn
            >
        </b-modal>
    </b-col>
</template>
<script>
import animationData from "@/survey/assets/checklist-blue.js";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";

export default {
    name: "Complete",
    mixins: [AuthRespondent],

    components: {},
    data: function() {
        return {
            defaultOptions: {
                animationData: animationData,
                loop: false
            },
            animationSpeed: 1,
            configCalendar: {
                dateFormat: "d-M-y"
            },
            modalComplete: false,
            isLoading: true,
            inputDataModal: false,
            isSubmitted: false,
            input: {
                phone: null,
                name: "",
                email: "",
                address: "",
                comment: ""
            },
            errors: {
                phone: null,
                name: "",
                email: "",
                address: "",
                comment: null
            }
        };
    },
    created() {
        this.getData()
    },
    computed: {
        statePhone() {
            return this.errors.phone == "no-error"
                ? true
                : this.errors.phone
                ? false
                : null;
        },
        stateEmail() {
            return this.errors.email == "no-error"
                ? true
                : this.errors.email
                ? false
                : null;
        },
        stateAddress() {
            return this.errors.address == "no-error"
                ? true
                : this.errors.address
                ? false
                : null;
        },
        stateBirthDate() {
            return this.errors.birthdate == "no-error"
                ? true
                : this.errors.birthdate
                ? false
                : null;
        },
        stateName() {
            return this.errors.name == "no-error"
                ? true
                : this.errors.name
                ? false
                : null;
        },
        stateComment() {
            return this.errors.comment == "no-error"
                ? true
                : this.errors.comment
                ? false
                : null;
        }
    },
    methods: {
        handleAnimation: function(anim) {
            this.anim = anim;
        },
        getData() {
            let self = this;
            this.isLoading = true;
            axios
                .get(`respondent/survey/personal-data?token=${this.$route.query.token}`)
                .then(response => {
                    console.log("TCL: getData -> social-data", response.data);
                    if (response.data.phone) {
                        self.isSubmitted = true;
                    }
                    self.isLoading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        postData(e) {
            e.preventDefault();
            let self = this;

            axios
                .post(
                    `respondent/survey/personal-data?token=${this.$route.query.token}`,
                    this.input
                )
                .then(response => {
                    self.isSubmitted = true;
                    this.inputDataModal = false;
                    this.modalComplete = true;
                    // fbq("track", "CompleteRegistration");
                })
                .catch(error => {
                    console.log(error);
                    let errors = error.response.data.errors;
                    this.errors.name = errors.name
                        ? errors.name[0]
                        : "no-error";
                    this.errors.phone = errors.phone
                        ? errors.phone[0]
                        : "no-error";
                    this.errors.address = errors.address
                        ? errors.address[0]
                        : "no-error";
                    this.errors.email = errors.email
                        ? errors.email[0]
                        : "no-error";
                    this.errors.comment = errors.comment
                        ? errors.comment[0]
                        : "no-error";
                });
        }
    }
};
</script>
<style scoped>

</style>
