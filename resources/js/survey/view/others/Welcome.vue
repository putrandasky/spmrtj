<template>
    <b-row class="">
        <!-- <b-card no-body class="shadow-lg" > -->
        <!-- <b-card no-body class="shadow-lg" img-src="/img/lrt-jakarta-title.jpg" img-top> -->
        <!-- <b-row class="card-body p-4" autocomplete="off" style="text-align: justify; text-justify: inter-word;overflow-x:auto;max-height:300px"> -->
        <b-col lg="6" class=" text-white text-justify">
            <p class="font-weight-bold text-success">Halo Teman MRT !</p>
            <p>
                Tidak terasa ya sudah hampir satu tahun Mass Rapid Transit (MRT)
                Jakarta beroperasi melayani kita semua. Apakah kalian pengguna
                aktif MRT Jakarta ? atau bahkan kalian belum pernah menggunakan
                moda transportasi publik yang hits ini? kalau belum, yuk buruan
                cobain naik MRT Jakarta dan rasakan jadi warga ibu kota yang
                bebas dari kemacetan! Selain itu yuk ikutan juga survey seru
                terkait kualitas pelayanan MRT Jakarta dalam rangka meningkatkan
                kualitas fasilitas dan pelayanan yang diharapkan temen – temen
                MRT semua.
            </p>
            <p>
                Kami berharap temen – temen MRT dapat berpartisipasi mengisi
                kuesioner dengan benar dan jujur. Hasil pengolahan data survey
                akan menjadi pertimbangan dan saran untuk MRT Jakarta. Seluruh
                data dan informasi yang diberikan akan dijaga kerahasiaannya dan
                akan digunakan sepenuhnya untuk keperluan analisa teknis dalam
                perencanaan dan pengembangan kebijakan MRT Jakarta.
            </p>
            <p class="font-weight-bold text-success">
                Kesempatan emas gak dateng 2x loh!
            </p>
            <p>
                Yuk langsung isi surveynya dan menangkan e-wallet senilai Rp.
                50.000 untuk 100 orang beruntung dan hadiah utama logam mulia
                senilai 5 gram! Semoga beruntung Teman MRT !
            </p>
        </b-col>
        <b-col lg="6" class="d-flex justify-content-center align-items-center">
            <b-row>
                <b-col cols="12">
                    <b-img
                        class="img-fluid"
                        src="/img/mrt-mask-2.png"
                        alt=""
                        style="max-height:400px"
                    />
                </b-col>
                <b-col cols="12">
                    <!-- <div class=" d-flex justify-content-end">
                        <b-img
                            src="/img/ripped-bottom-right.svg"
                            class="img-fluid"
                        />
                    </div> -->
                    <b-button
                        block
                        variant="success"
                        @click="handleStart"
                    >
                        Mulai Survei
                    </b-button>
                </b-col>
            </b-row>
        </b-col>

        <!-- </b-card-text> -->

        <!-- <b-card-body> -->

        <!-- </b-card-body> -->
    </b-row>
    <!-- </b-card> -->
</template>
<script>
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";
export default {
    name: "Intro",
    mixins: [AuthRespondent],
    data: function() {
        return {
            step: 1
        };
    },
    created() {},
    methods: {
        handleStart() {
            this.$router.replace({
                name: "SocialData",
                // query: {
                //     token: this.$route.query.token
                // }
            });
        },
        handleNext() {
            this.step = 2;
        }
    }
};
</script>
<style lang="css" scoped>
.img-mrt {
    position: fixed;
    bottom: 0;
    right: -130px;
}
.floating {
    animation: floating 3s ease infinite;

    will-change: transform;
}

@keyframes floating {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(10px);
    }

    100% {
        transform: translateY(0px);
    }
}
</style>
