<template>
  <b-row class="app  justify-content-center mx-0">
 <div class="w-100 mb-3">
      <vue-progress-bar style="opacity:1"></vue-progress-bar>

      <b-container class="pt-3 position-relative">
        <div class="w-100 d-flex justify-content-between align-items-center mb-3">
          <img src="/img/kemenhub.png" class=" logo-client-small d-inline d-md-none" alt="">
          <img src="/img/bptj.png" class=" logo-client-small  d-inline d-md-none" alt="">

        </div>
        <div class="w-100 d-flex justify-content-between align-items-center">
          <img src="/img/kemenhub.png" class=" logo-client d-md-block d-none" alt="">
          <div class="text-center w-100">

            <h3 class="font-riffic  font-gradient-theme">Survei Asal Tujuan (O-D) Perjalanan Jabodetabek 2019</h3>
          </div>
          <img src="/img/bptj.png" class=" logo-client  d-md-block d-none" alt="">
        </div>
        <div class="w-100 text-center">

        </div>
        <b-row class="justify-content-center mt-3">
          <transition name="fade" mode="out-in">
            <router-view ></router-view>
          </transition>
        </b-row>
      </b-container>
    </div>
    <!-- <loading class="text-center" :active.sync="$store.state.isLoading" :can-cancel="false" :opacity="0.9" :height="60"
      loader='dots' transition='fade' background-color="rgba(0,0,0,.85)" color="rgba(255,255,255,.9)"
      :is-full-page="true">
      <div class="text-center" slot="after" style="color:rgba(255,255,255,.9)">Mohon Tunggu...</div>
    </loading> -->
    <div class="footer-custom d-block mt-auto container-fluid text-center font-weight-bold">
      <b-row>
        <b-col md="3" cols="6" class="bg-primary pb-1 mb-md-2 pt-2 first-footer">
          <i class="fa fa-envelope text-primary circle-icon rounded-circle" style="background-color:#F9AF43;padding: 6px 6px;
    font-size: 12px;"></i> bptj@dephub.go.id
        </b-col>
        <b-col md="3" cols="6" class="text-primary pb-1  pt-2 second-footer text-md-right">
          <i class="fa fa-instagram circle-icon rounded-circle bg-white" style="color:#D2267F;padding: 6px 7px;
    font-size: 12px;"></i> @bptjkemenhub
        </b-col>
        <b-col md="3" cols="6" class="text-primary pb-1 mb-2 mb-sm-0 pt-2 third-footer text-md-left">
          <i class="fa fa-twitter circle-icon rounded-circle bg-white" style="color:#7F98BD;padding: 6px 7px;
    font-size: 12px;"></i>
          <i class="fa fa-facebook-square circle-icon rounded-circle bg-white" style="color:#45588E;padding: 6px 7px;
    font-size: 12px;"></i>
          <i class="fa fa-youtube-play circle-icon rounded-circle bg-white" style="color:#BF2E3A;padding: 6px 7px;
    font-size: 12px;"></i>
          bptj151
        </b-col>
        <b-col md="3" cols="6" class="bg-white text-primary pb-1  mb-md-2  pt-2 fourth-footer">
          <i class="fa fa-phone circle-icon rounded-circle bg-primary text-white" style="padding: 6px 8px;
    font-size: 12px;"></i>

          +6221 2279 1412
        </b-col>
      </b-row>

    </div>
  </b-row>
</template>
<script>
  export default {
    name: 'AppDone',
    data: function () {
      return {}
    },
    created() {},
    methods: {},
  }

</script>
<style lang="css" scoped>
  .app {
    min-height: 100vh;
    height: auto;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: radial-gradient(circle, rgba(28, 31, 79, 0.9)0%, rgba(28, 31, 79, 1)100%), url(/img/content.jpg);
    /* background-image:linear-gradient(90deg, rgba(0,0,0,0.8) 100%, rgba(0,0,0,0.2) 100%), url(/img/content.jpg) */
  }
</style>
