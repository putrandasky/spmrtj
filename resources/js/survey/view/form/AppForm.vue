<template>
    <b-row class="app pb  mx-0 ">
        <div class="w-100 mb-3">
            <div
                class="bg-white d-block"
                style="height:200px;top: 0;
    left: 0;
    right: 0;
    z-index: 0;
    position: absolute;"
            ></div>
            <b-container fluid class="position-relative">
                <div
                    class="w-100 mt-3 mt-lg-0 d-flex justify-content-between align-items-center mb-3"
                >
                    <img
                        src="/img/logo-mrtj-small.png"
                        class="  d-inline d-lg-none"
                        alt=""
                    />
                    <img
                        src="/img/jaklingko-icon-small.png"
                        class="   d-inline d-lg-none"
                        alt=""
                    />
                </div>
                <b-row class="d-flex justify-content-center">
                    <b-col
                        order-lg="0"
                        lg="3"
                        cols="6"
                        class="justify-content-center pt-lg-3 d-none d-lg-flex"
                    >
                        <img
                            src="/img/logo-mrtj.png"
                            class=" logo-client "
                            alt=""
                        />
                    </b-col>
                    <b-col
                        order-lg="9"
                        lg="3"
                        cols="6"
                        class="justify-content-center pt-lg-3  d-none d-lg-flex"
                    >
                        <img
                            src="/img/jaklingko-icon.png"
                            class=" logo-client  "
                            alt=""
                        />
                    </b-col>
                    <b-col order-lg="3" lg="6" md="8" sm="10" cols="12">
                        <div class="w-100 text-center">

                            <h3 class="text-success sub-title-form font-weight-bold">
                                Survei Preferensi Kebijakan MRT Jakarta
                            </h3>
                             <div>
                                 <b-progress :max="100" height="10px" class="mb-1">
                                     <b-progress-bar :value="progress_new" class="d-flex justify-content-end">

   <!-- <lottie

                            :options="defaultOptions"
                            v-on:animCreated="handleAnimation"
                            :height="100"
                            :width="100"
                            class="align-self-end m-0 position-absolute"
                            style="overflow:visible"
                        /> -->
                                     </b-progress-bar>
                                     </b-progress>
                                     </div>
                            <h4 class="mb-0 text-primary  sub-title-form font-weight-bold py-3">
                                <!-- Bagian I : Data Sosial Ekonomi -->
                                {{title}}
                            </h4>
                        </div>
                        <b-card class="shadow-lg text-center">
                            <h5 v-if="sp_title" slot="header" class="text-primary mb-0  sub-title-form ">
                                {{sp_title}}
                            </h5>
                            <transition name="fade" mode="out-in">
                                <router-view  v-on:childinit="onChildInit"  v-on:spInit="onSpInit"></router-view>
                            </transition>
                        </b-card>
                    </b-col>
                </b-row>
            </b-container>
        </div>

        <loading
            class="text-center"
            :active.sync="$store.state.isLoading"
            :can-cancel="false"
            :opacity="0.9"
            :height="60"
            loader="dots"
            transition="fade"
            background-color="rgba(0,0,0,.85)"
            color="rgba(255,255,255,.9)"
            :is-full-page="true"
        >
            <div
                class="text-center"
                slot="after"
                style="color:rgba(255,255,255,.9)"
            >
                Mohon Tunggu...
            </div>
        </loading>
    </b-row>
</template>

<script>
// import animationData from "@/survey/assets/exclamation-horizontal.js";
// import CarParking from '@'
import countTo from "vue-count-to";
export default {
    name: "AppForm",
    components: { countTo },
    data() {
        return {
            //             defaultOptions: {
            //     animationData: animationData,
            //     loop: true
            // },
            // animationSpeed: 1,
            // isChecking: false,
            title: "",
            progress: 0,
            indexForm: 0,
progress_new:0,
            sp_title:""
        };
    },
    watch: {},
    created() {
        // this.checkExist()
        // this.getCoverageArea();
        // this.$store.dispatch('checkExist')
    },
    methods: {
               handleAnimation: function(anim) {
            this.anim = anim;
        },
        onSpInit(value){
            this.sp_title = value.sp_title
            // console.log(value);

        },
        onChildInit(value) {
            this.title = value.title;
            this.progress = this.progress_new;
            this.progress_new = value.progress;
        },
        handleNext(index) {
            this.indexForm = index;
        },
        getCoverageArea() {
            axios
                .get(`others/coverage`)
                .then(response => {
                    this.$store.dispatch("addCoverageArea", response.data);

                    // console.log(this.$store.state.coverage);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        checkExist() {
            // console.log(typeof this.$route.query.token === 'undefined');
            this.isChecking = true;
            let token =
                typeof this.$route.query.token === "undefined"
                    ? false
                    : this.$route.query.token;
            if (token) {
                axios
                    .get(`survey/form/auth-respondent?token=${token}`)
                    .then(response => {
                        console.log(response.data);
                        if (response.data.status == "exist") {
                            this.$store.dispatch("storeToken", response.data);
                            this.handleRoute(
                                response.data.token,
                                response.data.step.name
                            );
                            this.$store.dispatch("isPageLoaded", true);
                        } else {
                            this.$router.replace({
                                name: "Intro",
                                query: {
                                    token: response.data.token
                                }
                            });
                            this.isChecking = false;
                            this.$store.dispatch("isPageLoaded", true);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                axios
                    .get(`survey/form/auth-respondent`)
                    .then(response => {
                        console.log(response.data);
                        this.handleRoute(response.data.token, "Intro");
                        this.isChecking = false;
                        this.$store.dispatch("isPageLoaded", true);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        handleRoute(token, routeName) {
            this.$router.replace({
                name: routeName,
                query: Object.assign({}, this.$route.query, {
                    token: token
                })
            });
            this.isChecking = false;
        }
    }
};
</script>
<style lang="css" scoped>
/* .app {
    min-height: 100vh;
    height: auto;

} */
.app {
    background-position: bottom;
    background-repeat: no-repeat;
    background-color: #0056bb;
    background-size: 100% auto;
    background-image: url(/img/footer-monumen.png);
    min-height: 100vh;
    height: auto;
}
.footer-survey {
    /* height:100vh;
  width:100%;
  bottom: 0;
    left: 0;
    right: 0;
    z-index: -1;
    /* position: relative; */
    /* position: absolute; */
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: 100% auto;
    /* background-image: url(/img/Background.png); */
    /* margin-top: -503px; */
}
</style>
