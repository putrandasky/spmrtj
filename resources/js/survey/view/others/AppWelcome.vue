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
                                    Gimana kabar kalian semua? Semoga selalu sehat yaa dan terlindung dari paparan virus corona atau COVID-19. Yuk sambil mengisi aktivitas work from home nya, bantu kami mengisi survei seru berhadiah terkait kualitas pelayanan MRT Jakarta dalam rangka meningkatkan kualitas fasilitas dan pelayanan yang diharapkan teman – teman MRT semua. Sudah pernah naik MRT Jakarta belum? Atau bahkan kalian pengguna aktif MRT Jakarta? Bagi kalian yang belum pernah, yuk buruan cobain naik MRT Jakarta dan rasakan jadi warga ibu kota yang bebas dari kemacetan!
                            </p>
                            <p>
                                    Yuk Teman, isi survei dengan benar dan jujur yaa. Hasil pengolahan data survei akan menjadi pertimbangan dan saran untuk MRT Jakarta.
                            </p>
                            <p class="font-weight-bold text-primary">
                                Kesempatan emas gak dateng 2x loh!
                            </p>
                            <p class="mb-0">
                                    Kapan lagi bisa isi survei dan berkesempatan memenangkan e-wallet senilai Rp. 100.000 untuk 100 orang beruntung dan hadiah utama voucher MAP dengan total Rp  5 Juta rupiah untuk 2 orang masing – masing @ Rp. 2,5 juta untuk 2 orang! Semoga beruntung Teman MRT !
                            </p>
                        </div>
                    </b-card>
                </b-col>
                <b-col lg="3"></b-col>
                <b-col lg="4" class="d-flex align-items-end pb-3 pb-lg-0">
                    <b-card class="opacity-90 shadow text-justify" >
                        <small>
                            Seluruh data dan informasi yang diberikan akan dijaga kerahasiaannya dan akan digunakan sepenuhnya untuk keperluan analisa teknis dalam perencanaan dan pengembangan kebijakan MRT Jakarta.
                        </small>
                    </b-card>
                </b-col>
            </b-row>
        </b-container>
        <div class="w-100 footer-welcome bg-primary text-white text-center py-2">
            <b-container fluid>
                <b-row class="d-flex align-items-center">
                    <b-col md="4">
                        <div  class="text-lg-right">
                            <h4 class="mb-0">
                                SURVEI PREFERENSI KEBIJAKAN
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
