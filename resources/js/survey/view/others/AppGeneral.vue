<template>
    <div class="app py-5">
        <b-container fluid class="h-100">
            <b-row class=" d-flex justify-content-center  h-100">
                <router-view></router-view>
            </b-row>
        </b-container>
    </div>
</template>
<script>
export default {
    name: "AppGeneral",
    data: function() {
        return {};
    },
    created() {},
    methods: {}
};
</script>
<style scoped>
.app {
    background-position: bottom;
    background-repeat: no-repeat;
    background-color: #0056bb;
    background-size: 100% auto;
    background-image: url(/img/footer-monumen.png);
    min-height: 100vh;
    height: auto;
}
</style>
