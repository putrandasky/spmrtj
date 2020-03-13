<template>
  <b-row class="app d-flex justify-content-center align-items-start mx-0">
    <div class="w-100 text-center my-3">
      <img src="img/logo_company.gif" alt style="max-height:3rem" />
    </div>
    <div class="flex-center position-ref full-height">
      <div class="code">404</div>

      <div class="message" style="padding: 10px;">Not Found</div>
    </div>
    <div class="w-100 text-center mt-auto mb-2">
      <img src="img/logo_aecom.gif" alt style="max-height:1.5rem" class="shadow-lg" />
    </div>
    <div class="footer-custom d-block mt-auto container-fluid text-center font-weight-bold">
      <b-row>
        <b-col md="3" cols="6" class="bg-primary pb-1 mb-md-2 pt-2 first-footer">
          <i
            class="fa fa-envelope text-primary circle-icon rounded-circle"
            style="background-color:#F9AF43;padding: 6px 6px;
    font-size: 12px;"
          ></i> bptj@dephub.go.id
        </b-col>
        <b-col md="3" cols="6" class="text-primary pb-1 pt-2 second-footer text-md-right">
          <i
            class="fa fa-instagram circle-icon rounded-circle bg-white"
            style="color:#D2267F;padding: 6px 7px;
    font-size: 12px;"
          ></i> @bptjkemenhub
        </b-col>
        <b-col
          md="3"
          cols="6"
          class="text-primary pb-1 mb-2 mb-sm-0 pt-2 third-footer text-md-left"
        >
          <i
            class="fa fa-twitter circle-icon rounded-circle bg-white"
            style="color:#7F98BD;padding: 6px 7px;
    font-size: 12px;"
          ></i>
          <i
            class="fa fa-facebook-square circle-icon rounded-circle bg-white"
            style="color:#45588E;padding: 6px 7px;
    font-size: 12px;"
          ></i>
          <i
            class="fa fa-youtube-play circle-icon rounded-circle bg-white"
            style="color:#BF2E3A;padding: 6px 7px;
    font-size: 12px;"
          ></i>
          bptj151
        </b-col>
        <b-col md="3" cols="6" class="bg-white text-primary pb-1 mb-md-2 pt-2 fourth-footer">
          <i
            class="fa fa-phone circle-icon rounded-circle bg-primary text-white"
            style="padding: 6px 8px;
    font-size: 12px;"
          ></i>
          +6221 2279 1412
        </b-col>
      </b-row>
    </div>
  </b-row>
</template>
<script>
export default {
  name: "AppErrors",
  data: function() {
    return {};
  },
  created() {},
  methods: {}
};
</script>
<style lang="css" scoped>
.app {
  background-position: bottom;
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-image: url(/img/Background.png);
  min-height: 100vh;
  height: auto;
}

.flex-center {
  align-items: center;
  display: flex;
  justify-content: center;
}

.position-ref {
  position: relative;
}

.code {
  border-right: 2px solid;
  font-size: 26px;
  padding: 0 15px 0 15px;
  text-align: center;
}

.message {
  font-size: 18px;
  text-align: center;
}
</style>
