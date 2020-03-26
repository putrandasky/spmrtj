<template>
    <div class="app pt-3 d-flex align-items-start flex-column">
        <b-container fluid class="mb-auto">
            <b-row class="h-100">
                <b-col lg="5" class="pb-3 pb-lg-0">
                    <b-card class="opacity-90 shadow">
                        <div class="d-flex justify-content-around pb-2">
                            <b-img src="/img/jaklingko-icon.png"></b-img>
                            <b-img src="/img/logo-mrtj.png"></b-img>
                        </div>
                        <div class="text-justify">
                            <p class="font-weight-bold text-primary">
                                Halo Teman MRT !
                            </p>
                            <p>
                                <small>
                                    Tidak terasa ya sudah hampir satu tahun Mass
                                    Rapid Transit (MRT) Jakarta beroperasi
                                    melayani kita semua. Apakah kalian pengguna
                                    aktif MRT Jakarta ? atau bahkan kalian belum
                                    pernah menggunakan moda transportasi publik
                                    yang hits ini? kalau belum, yuk buruan
                                    cobain naik MRT Jakarta dan rasakan jadi
                                    warga ibu kota yang bebas dari kemacetan!
                                    Selain itu yuk ikutan juga survei seru
                                    terkait kualitas pelayanan MRT Jakarta dalam
                                    rangka meningkatkan kualitas fasilitas dan
                                    pelayanan yang diharapkan temen – temen MRT
                                    semua.
                                </small>
                            </p>
                            <p>
                                <small>
                                    Kami berharap temen – temen MRT dapat
                                    berpartisipasi mengisi kuesioner dengan
                                    benar dan jujur. Hasil pengolahan data
                                    survei akan menjadi pertimbangan dan saran
                                    untuk MRT Jakarta.
                                   <!--  Seluruh data dan
                                    informasi yang diberikan akan dijaga
                                    kerahasiaannya dan akan digunakan sepenuhnya
                                    untuk keperluan analisa teknis dalam
                                    perencanaan dan pengembangan kebijakan MRT
                                    Jakarta. -->
                                </small>
                            </p>
                            <p class="font-weight-bold text-primary">
                                Kesempatan emas gak dateng 2x loh!
                            </p>
                            <p class="mb-0">
                                <small>
                                    Yuk langsung isi surveinya dan menangkan
                                    e-wallet senilai Rp. 100.000 untuk 100 orang
                                    beruntung dan hadiah utama
                                    voucher MAP Rp. 2,5 juta untuk 2 orang! Semoga
                                    beruntung Teman MRT !
                                </small>
                            </p>
                        </div>
                    </b-card>
                </b-col>
                <b-col lg="3"></b-col>
                <b-col lg="4" class="d-flex align-items-end pb-3 pb-lg-0">
                    <b-card class="opacity-90 shadow text-justify" >
                        <small>
                            Seluruh data dan informasi yang Responden berikan
                            akan dijaga kerahasiaannya dan akan digunakan
                            sepenuhnya untuk keperluan analisa teknis dalam
                            perencanaan dan pengembangan kebijakan transportasi
                            di masa mendatang.
                        </small>
                    </b-card>
                </b-col>
            </b-row>
        </b-container>
        <div class="w-100 footer-welcome bg-primary text-white text-center py-2">
            <b-container fluid>
                <b-row class="d-flex align-items-center">
                    <b-col md="4">
                        <div>
                            <h4>
                                SURVEI KEBIJAKAN
                            </h4>
                        </div>
                        <div class="text-lg-right">
                            <h4 class="mb-0">
                                PELAYANAN PUBLIK
                            </h4>
                        </div>
                    </b-col>
                    <b-col md="6">
                        <h1  class="mb-0">
                            <div class="display-5">
                                MRT JAKARTA
                            </div>
                        </h1>
                    </b-col>
                    <b-col md="2">
                        <b-btn variant="success" block @click="handleStart">
                            MULAI SURVEI
                        </b-btn>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>
<script>
import { FadeTransition } from "vue2-transitions";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";

export default {
    name: "AppWelcome",
    mixins: [AuthRespondent],
    components: {

    },
    data() {
        return {
            // isChecking: false,

        };
    },
    watch: {},
    created() {
        // this.checkExist()
        // this.$store.dispatch('checkExist')
    },
    methods: {

       handleStart() {
            this.$router.replace({
                name: "SocialData",
                query: {
                    token: this.$route.query.token
                }
            });
        },
    }
};
</script>
<style lang="css" scoped>
.app {
    /* min-height: 100vh;
    height: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #0056bb; */

    min-height: 100vh;
    height: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url(/img/bg-front-cover.jpg);
    /* background-image: radial-gradient(
            circle,
            rgba(14, 14, 15, 0.9) 50%,
            rgba(14, 14, 15, 1) 100%
        ),
        url(/img/bg-front-cover.jpg); */
    /* background-image: radial-gradient(
            circle,
            rgba(14, 14, 15, 0.9) 0%,
            rgba(14, 14, 15, 1) 100%
        ),
        url(/img/bg-front-cover.jpg); */
}
.cover-title {
    max-height: 200px;
}
/* .ripped-top {
    top: -70px;
    left: -69px;
    position: relative;
} */
.welcome-title {
    text-shadow: 1px 1px grey;
}

.footer-welcome {
    box-shadow: 0px -10px 13px -2px rgba(0, 0, 0, 0.75);
    z-index: 100;
}
/* .background-welcome { */
/* height:100%;
    background-position: right;
    background-repeat: repeat-x;
    background-size: auto 100%;
    background-image: url(/img/welcome_banner.svg); */
/* } */
</style>
