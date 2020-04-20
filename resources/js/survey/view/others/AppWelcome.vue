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
                                    Gimana kabar kalian semua? Semoga selalu sehat yaa dan terlindung dari paparan virus corona atau COVID-19. Yuk sambil mengisi aktivitas <em>work from home</em>  nya, bantu kami mengisi survei seru berhadiah terkait kualitas pelayanan MRT Jakarta dalam rangka meningkatkan kualitas fasilitas dan pelayanan yang diharapkan teman – teman MRT semua. Sudah pernah naik MRT Jakarta belum? Atau bahkan kalian pengguna aktif MRT Jakarta? Bagi kalian yang belum pernah, yuk buruan cobain naik MRT Jakarta dan rasakan jadi warga ibu kota yang bebas dari kemacetan!
                            </p>
                            <p>
                                    Yuk Teman, isi survei dengan benar dan jujur yaa. Hasil pengolahan data survei akan menjadi pertimbangan dan saran untuk MRT Jakarta.
                            </p>
                            <p class="font-weight-bold text-primary">
                                Kesempatan emas gak dateng 2x loh!
                            </p>
                            <p class="mb-0">
                                    Kapan lagi bisa isi survei dan berkesempatan memenangkan <em>e-wallet</em>  senilai Rp. 100.000 untuk 100 orang beruntung dan hadiah utama voucher MAP dengan total Rp  5 Juta rupiah untuk 2 orang masing – masing @ Rp. 2,5 juta untuk 2 orang! Semoga beruntung Teman MRT !
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


    min-height: 100vh;
    height: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url(/img/bg-front-cover.jpg);

}
.cover-title {
    max-height: 200px;
}

.welcome-title {
    text-shadow: 1px 1px grey;
}

.footer-welcome {
    box-shadow: 0px -10px 13px -2px rgba(0, 0, 0, 0.75);
    z-index: 100;
}

@media only screen  and (max-height: 800px)  and (orientation: landscape) {

    .app {
        font-size: 80%!important;
    }
}
@media only screen  and (min-height: 1000px)  and (orientation: landscape){

    .app {
        font-size: 140%!important;
    }
}
@media only screen  and (min-height: 1200px)  and (orientation: landscape){
    h1,h2,h3,h4,h5,h6 {
        font-size: 120%!important;
    }
    .app {
        font-size: 160%!important;
    }
}
@media only screen  and (min-height: 1400px)  and (orientation: landscape){
    h1,h2,h3,h4,h5,h6 {
        font-size: 140%!important;
    }
    .app {
        font-size: 180%!important;
    }
}
@media only screen  and (min-height: 1600px)  and (orientation: landscape){
    h1,h2,h3,h4,h5,h6,.btn {
        font-size: 160%!important;
    }
    .app {
        font-size: 200%!important;
    }
}
</style>
