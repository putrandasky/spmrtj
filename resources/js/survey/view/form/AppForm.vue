<template>
    <b-row class="app  py-5 mx-0">
        <b-col
            order-lg="0"
            lg="3"
            cols="6"
            class="d-flex justify-content-center"
        >
            <img src="/img/Mrt-Jkt-White.png" class=" logo-client " alt="" />
        </b-col>
        <b-col
            order-lg="9"
            lg="3"
            cols="6"
            class="d-flex justify-content-center"
        >
            <img
                src="/img/Logo-Jaklingko-white.png"
                class=" logo-client  "
                alt=""
            />
        </b-col>
        <b-col order-lg="3" lg="6" cols="12" class=" w-100">
            <b-card class="shadow-lg text-center">
                <div class="">
                    <h2 class="title-form text-success font-weight-bold">
                        Survei Preferensi Kebijakan MRT Jakarta
                    </h2>
                </div>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </b-card>
        </b-col>
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
// import CarParking from '@'
export default {
    name: "AppForm",
    components: {},
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
        // this.getCoverageArea();
        // this.$store.dispatch('checkExist')
    },
    methods: {
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
    min-height: 100vh;
    height: auto;
    background-color: #0056bb;
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
