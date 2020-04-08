<template>
<div>
     <h1 class="page-title">Dashboard</h1>
    <b-row>
      <b-col lg="3" sm="6" xs="12">
        <div class="pb-xlg h-100">
          <Widget class="h-100 mb-0" title="Valid Respondent">
            <div class="d-flex justify-content-between align-items-center mb-lg">
              <h2>2.000</h2>
              <i class="la la-arrow-right text-primary la-lg rotate-315" />
            </div>
            <div class="d-flex flex-wrap justify-content-between">
              <div class="mt">
                <h6>3.000</h6><p class="text-muted mb-0 mr"><small>Total</small></p>
              </div>
              <div class="mt">
                <h6>4000</h6><p class="text-muted mb-0"><small>Target</small></p>
              </div>
              <div class="mt">
                <h6>2000</h6><p class="text-muted mb-0 mr"><small>Remaining</small></p>
              </div>
            </div>
          </Widget>
        </div>
      </b-col>
    </b-row>
</div>
</template>
<script>
    export default {
        name: 'Dashboard2',
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
