import Vue from "vue";
import Router from "vue-router";

import AppForm from "@/survey/view/form/AppForm.vue";
import AppDone from "@/survey/view/others/AppDone.vue";
import AppWelcome from "@/survey/view/others/AppWelcome.vue";
import Welcome from "@/survey/view/others/Welcome.vue";
import SocialData from "@/survey/view/form/SocialData.vue";
import TravelData from "@/survey/view/form/TravelData.vue";
import SurveyPreference from "@/survey/view/form/SurveyPreference.vue";
import AdditionalData from "@/survey/view/form/AdditionalData.vue";
import Done from "@/survey/view/others/Done.vue";
import Errors from "@/survey/view/others/AppErrors.vue";
import AppGeneral from "@/survey/view/others/AppGeneral.vue";
import Completed from "@/survey/view/others/Complete.vue";
import SurveyPreferenceAlter from "@/survey/view/form/SurveyPreferenceAlter.vue";
import CarPark from "@/survey/view/form/SurveyPreferenceCarParking.vue";

Vue.use(Router);

export default new Router({
    // mode: 'history',
    base: "",
    linkActiveClass: "open active",
    // scrollBehavior: () => ({
    //   y: 0
    // }),
    routes: [
        {
            path: "",
            redirect: "/welcome",
            component: AppForm,
            children: [
                {
                    path: "/social-data",
                    name: "SocialData",
                    component: SocialData,
                    props: {
                        routerData: {
                            title: "Data Sosial Ekonomi Responden",
                            progress: 0
                        }
                    },
                    meta: {
                        checkStep: true
                    }
                },
                {
                    path: "/travel-data",
                    name: "TravelData",
                    component: TravelData,
                    props: {
                        routerData: {
                            title: "Data Perjalanan Responden",
                            progress: 25
                        }
                    },
                    meta: {
                        checkStep: true
                    }
                },
                {
                    path: "/survey-preference",
                    name: "SurveyPreference",
                    component: SurveyPreference,
                    props: {
                        routerData: {
                            title: "Survei Preferensi Responden",
                            progress: 50
                        }
                    },
                    meta: {
                        checkStep: true
                    }
                },
                {
                    path: "/additional-data",
                    name: "AdditionalData",
                    component: AdditionalData,
                    props: {
                        routerData: {
                            title: "Informasi Tambahan",
                            progress: 75
                        }
                    },
                    meta: {
                        checkStep: true
                    }
                },
                {
                    path: "/survey-preference-alt/:component",
                    name: "SurveyPreferenceAlt",
                    component: SurveyPreferenceAlter,
                    props: {
                        routerData: {
                            title: "Survei Preferensi Responden",
                            progress: 50
                        }
                    },
                    meta: {
                        checkStep: true
                    },
                    // children: [
                    //     {
                    //         path: "/car-park",
                    //         name: "CarPark",
                    //         component: CarPark
                    //     }
                    // ]
                }
            ]
        },
        {
            path: '/completed',
            component: AppGeneral,
            children: [
                {
                    path: '',
                    name: 'Completed',
                    component: Completed,
                    meta: {
                        checkStep: true
                    }
                },
                {
                  path: 'done',
                  name: 'Done',
                  component: Done,
                  meta: {
                    checkStep: true
                  }
                }
            ]
        },
        {
            path: '/welcome',
            component: AppWelcome,
            children: [
                {
                    path: '',
                    name: 'Welcome',
                    component: Welcome,
                    meta: {
                        checkStep: true
                    }
                }
            ]
        },
        // {
        //     path: "*",
        //     redirect: "/welcome"
        // },
        {
            path: "/errors",
            name: "errors",
            component: Errors
        }
    ]
});
