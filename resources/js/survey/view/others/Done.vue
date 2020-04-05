<template>
    <b-col lg="9" md="10" sm="12">
        <div class="d-flex justify-content-around mb-3">
            <b-img  src="./img/Mrt-Jkt-White-small.png"></b-img>
            <b-img   src="./img/Logo-Jaklingko-white-small.png"></b-img>
        </div>
        <div class="text-center mb-5">
            <p
                class="display-2 font-weight-bold text-white text-shadow title-form"
            >
                TERIMA KASIH
            </p>
            <p class="font-weight-bold text-white text-shadow">
               Survey anda sudah selesai, Terimakasih banyak atas waktu dan jawaban anda.
            </p>
        </div>

  </b-col>
</template>
<script>
  import {
    AuthRespondent
  } from "@/survey/components/mixins/AuthRespondent";
  export default {
    name: 'Done',
    mixins: [AuthRespondent],
    data: function () {
      return {

      }
    },
    created() {
    },
    computed: {

    },
    methods: {

    },
  }

</script>
<style>
</style>
