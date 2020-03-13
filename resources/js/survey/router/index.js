import Vue from 'vue'
import Router from 'vue-router'


import AppForm from '@/survey/view/form/AppForm.vue'
import AppDone from '@/survey/view/others/AppDone.vue'
import AppWelcome from '@/survey/view/others/AppWelcome.vue'
import Welcome from '@/survey/view/others/Welcome.vue'
import SocialData from '@/survey/view/form/SocialData.vue'
import TravelData from '@/survey/view/form/TravelData.vue'
import SurveyPreference from '@/survey/view/form/SurveyPreference.vue'
import AdditionalData from '@/survey/view/form/AdditionalData.vue'
import Completed from '@/survey/view/form/CompleteSurvey.vue'
import Done from '@/survey/view/others/Done.vue'
import Errors from '@/survey/view/others/AppErrors.vue'


Vue.use(Router)

export default new Router({
  // mode: 'history',
  base: '',
  linkActiveClass: 'open active',
  // scrollBehavior: () => ({
  //   y: 0
  // }),
  routes: [{
      path: '',
      redirect: '/welcome',
      component: AppForm,
        children:[

           {
            path:'/social-data',
            name:'SocialData',
            component: SocialData,
            props:{
              routerData: {
                title: 'Data Sosial Ekonomi Responden',
                progress: 60
              }
            },
              meta: {
                checkStep: true
              },
          },
          {
            path:'/travel-data',
            name:'TravelData',
            component: TravelData,
            props: {
              routerData: {
                title: 'Data Perjalanan Responden',
                progress: 0
              }
            },
              meta: {
                checkStep: true
              },
          },
          {
            path:'/survey-preference',
            name: 'SurveyPreference',
            component: SurveyPreference,
            props: {
              routerData: {
                title: 'Survei Preferensi Responden',
                progress: 90
              }
              },
              meta: {
                checkStep: true
              },
          },
          {
            path:'/additional-data',
            name: 'AdditionalData',
            component: AdditionalData,
            props: {
              routerData: {
                title: 'Informasi Tambahan',
                progress: 90
              }
              },
              meta: {
                checkStep: true
              },
          },
          {
            path:'/completed',
            name: 'Completed',
            component: Completed,
            props: {

              },
              meta: {
                checkStep: true
              },
          },

        ]

    },
    // {
    //   path:'/completed',
    //   component:AppDone,
    //   children:[
    //       {
    //         path: '',
    //         name: 'Completed',
    //         component: Completed,
    //         meta: {
    //           checkStep: true
    //         },
    //       },
    //     {
    //       path: '/done',
    //       name: 'Done',
    //       component: Done,
    //       meta: {
    //         checkStep: true
    //       },
    //     }
    //   ]
    // },
    {
      path:'/welcome',
      component:AppWelcome,
      children:[
          {
            path: '',
            name: 'Welcome',
            component: Welcome,
            meta: {
              checkStep: true
            },
          },
      ]
    },
        {
          path: '*',
          redirect: '/errors',
        },
            {
              path: '/errors',
              name: 'errors',
              component: Errors,
            },
  ]
})
