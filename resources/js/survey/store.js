import Vue from 'vue';
import Vuex from 'vuex';
// import Cookies from "js-cookie";
// import router from './router/index';

Vue.use(Vuex);

const RESPONDENT = "RESPONDENT";
const ISLOADING = "ISLOADING";
const ISPAGELOADED = "ISPAGELOADED";
const COVERAGE = "COVERAGE";

export const store = new Vuex.Store({
  state: {
    isLoading:false,
    isPageLoaded:false,
    coverage:{},
    respondent: {
      id: null,
      token: null,
      category:"",
      saving_time:null,
      sp_type:null,
      transportation_mode_id:null,
      step:{
        id:null,
        name:""
      }
    }
  },
  mutations: {

    [RESPONDENT](state, n) {
      state.respondent.id = n.id;
      state.respondent.token = n.token;
      state.respondent.category = n.category;
      state.respondent.sp_type = n.sp_type;
      state.respondent.saving_time = n.saving_time;
      state.respondent.step = n.step;
      state.respondent.transportation_mode_id = n.transportation_mode_id;
    },
    [ISLOADING](state, n) {
      state.isLoading = n;
    },
    [ISPAGELOADED](state, n) {
      state.isPageLoaded = n;
    },
    [COVERAGE](state, n) {
      state.coverage = n;
    },

  },
  actions: {
    isLoading({
      commit
    }, isLoading) {
      commit(ISLOADING, isLoading)
    },
    isPageLoaded({
      commit
    }, isPageLoaded) {
      commit(ISPAGELOADED, isPageLoaded)
    },
    addCoverageArea({
      commit
    }, area) {
      commit(COVERAGE, area)
    },
    storeToken({
      commit
    }, creds) {
      let respondent_data ={
        token : creds.token,
        id : creds.respondent_id,
        category: creds.category,
        sp_type: creds.sp_type,
        saving_time: creds.saving_time,
        step: creds.step,
        transportation_mode_id: creds.transportation_mode_id,
      }
      console.log(creds);
      commit(RESPONDENT, respondent_data);
    },
          checkExist({commit}) {
            // console.log(typeof this.$route.query.token === 'undefined');
            let token = typeof store.state.route.query.token === 'undefined' ? false : store.state.route.query.token
            if (token) {
              axios.get(`survey/form/auth-respondent?token=${token}`)
                .then((response) => {
                  console.log(response.data)
                  if (response.data.status == "exist") {
                    console.log('exist');
                    store.dispatch('storeToken', response.data)
                    // this.handleRoute(response.data.token, response.data.step.name)
                  } else {
                    console.log('new');
                    store.dispatch('storeToken', response.data)

                  }
                })
                .catch((error) => {
                  console.log(error);
                })
            } else {
              axios.get(`survey/form/auth-respondent`)
                .then((response) => {
                  console.log('new');
                    store.dispatch('storeToken', response.data)

                })
                .catch((error) => {
                  console.log(error);
                })


            }

          },


  },
  getters: {
    category: state => {
      return state.respondent.category
    },
    transportation_mode_id: state => {
      return state.respondent.transportation_mode_id
    },
    token: state => {
      return state.respondent.token
    },
    sp_type: state => {
      return state.respondent.sp_type
    },
    saving_time: state => {
      return state.respondent.saving_time
    },
    step: state => {
      return state.respondent.step
    },
  }
});

