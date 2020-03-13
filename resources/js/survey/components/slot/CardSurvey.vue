<template>
<b-card no-body class="shadow-lg w-100 px-0 mb-3">
  <b-card-body>

          <h5 class=" text-primary"><slot name="question"></slot></h5>
  </b-card-body>
  <b-card-body class="pt-0">

          <slot name="choices"></slot>
  </b-card-body>
</b-card>
</template>
<script>
  export default {
    name: 'CardSurvey',
    data: function () {
      return {
      }
    },
    created(){
    },
    methods:{
    },
  }
</script>
<style>
</style>
