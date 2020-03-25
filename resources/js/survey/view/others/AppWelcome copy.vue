<template>
    <b-row class="app d-flex justify-content-center align-items-start mx-0 pb-3">
            <b-col lg="4" class="pl-0">
                <b-img src="/img/ripped-with-logo-fixed.svg" class="img-fluid" />
            </b-col>
            <b-col lg="8" class="d-flex justify-content-center align-items-self py-3">
                <b-img class="img-fluid cover-title" src="/img/cover-title.png" />
            </b-col>
        <!-- <div class="w-100 mb-3 d-flex justify-content-between">
            <div class="">
                <b-img src="/img/ripped-with-logo-fixed.svg" class="img-fluid" />
            </div>
            <div class="  d-flex justify-content-center align-items-center">

                <b-img class="img-fluid cover-title" src="/img/cover-title.png" />
            </div>
        </div> -->
        <div class="w-100 ">
            <b-container >
                <b-row class=" d-flex justify-content-center  mx-0">
                    <transition name="fade" mode="out-in">
                        <router-view
                            class="clearfix"
                            v-on:childinit="onChildInit"
                        ></router-view>
                    </transition>
                </b-row>
            </b-container>
        </div>

        <!-- <router-view v-show="!isChecking"></router-view> -->
        <!-- <div class="w-100 text-center mt-auto mb-2">
      <img src="img/logo_aecom.gif" alt="" style="max-height:1.5rem" class=" shadow-lg">
    </div> -->
    </b-row>
</template>
<script>
import { FadeTransition } from "vue2-transitions";
// import PersonalData from "./AppFormPersonalData"
// import TravelMap from "./AppFormTravelMap"
// import TravelData from "./AppFormTravelData"
export default {
    name: "AppIntro",
    components: {
        // PersonalData,
        // TravelMap,
        // TravelData
    },
    data() {
        return {
            // isChecking: false,
            title: "",
            progress: 0,
            indexForm: 0
        };
    },
    watch: {},
    created() {
        // this.checkExist()
        // this.$store.dispatch('checkExist')
    },
    methods: {
        onChildInit(value) {
            this.title = value.title;
            this.progress = value.progress;
        },
        handleNext(index) {
            this.indexForm = index;
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
                            console.log("exist");
                            this.$store.dispatch("storeToken", response.data);
                            this.handleRoute(
                                response.data.token,
                                response.data.step.name
                            );
                            this.$store.dispatch("isPageLoaded", true);
                        } else {
                            console.log("new");
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
                        console.log("new");
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
     background-image: radial-gradient(circle, rgba(14, 14, 15, 0.9)0%, rgba(14, 14, 15, 1)100%), url(/img/bg-front-cover.jpg);

}
.cover-title{
    max-height:200px;
}
/* .ripped-top {
    top: -70px;
    left: -69px;
    position: relative;
} */
.welcome-title {
    text-shadow: 1px 1px grey;
}

/* .background-welcome { */
/* height:100%;
    background-position: right;
    background-repeat: repeat-x;
    background-size: auto 100%;
    background-image: url(/img/welcome_banner.svg); */
/* } */
</style>
