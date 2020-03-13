<template>
      <div class="w-100 text-center">
            <slot name="above"></slot>

        <h5 class="font-weight-bold pt-3">
            <slot name="text"></slot>
        </h5>
            <slot name="bottom"></slot>
      </div>
</template>
<script>
  export default {
    name: 'QuestionArea',
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
