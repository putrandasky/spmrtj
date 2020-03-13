<template>
  <b-col lg="6" md="8" class="align-items-center d-flex justify-content-center"   v-show="!isChecking">

    <b-card no-body class="shadow-lg" img-src="/img/thankyou.png" img-top style="max-width:30rem">
      <div class="card-body p-4" autocomplete="off"
        style="text-align: justify; text-justify: inter-word;overflow-x:auto;max-height:300px">
        <h3>Terimakasih !</h3>
        <b-card-text>
          Survey anda sudah selesai, Terimakasih banyak atas waktu dan jawaban anda
        </b-card-text>
      </div>

    </b-card>
  </b-col>
</template>
<script>
  import {
    AuthRespondent
  } from "@/survey/components/mixins/AuthRespondent";
  export default {
    name: 'CompleteSurvey',
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
