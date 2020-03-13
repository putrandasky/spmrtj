<template>
    <transition name="fade" mode="out-in">
        <router-view></router-view>
    </transition>
</template>
<script>
export default {
    name: "App",
    data: function() {
        return {};
    },
    created() {},
    methods: {}
};
</script>
<style>
/* .app{ */
/* display: flex; */
/* min-height: 100%; */
/* background-image:linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%), url(/img/lrt-jakarta.jpg); */
/* background-image:url(/img/LRT_Survey_Background.png); */
/* height: 100%; */
/* background-position: center;
    background-repeat: no-repeat;
    background-size: cover; */
/* } */
/* .card{
   filter:opacity(95%)
} */

.btn-group-vertical.block,
.btn-group.block {
    display: flex;
}

.block .btn {
    flex: 1;
}
.btn.focus,
.btn:focus {
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
}
.btn {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;;
}
.spinner-border.inside-input {
    position: relative;
    right: 10px;
    top: -32px;
    z-index: 4;
    float: right;
}
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration {
    display: none;
}
@media only screen and (max-width: 576px) {
    /* For mobile phones: */
    .title-form {
        font-size: 1.5rem;
    }
    .sub-title-form {
        font-size: 1.3rem;
    }
}
</style>
