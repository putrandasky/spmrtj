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
.slide-shrink-fade-enter-active {
    transition: all 0.1s ease;
}
.slide-shrink-fade-leave-active {
    transition: all 0.1s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-shrink-fade-enter,
.slide-shrink-fade-leave-to {
    /* transform: translateX(10px); */
    opacity: 0;
    /* height: 0%; */
    font-size: 99%;
}
.text-shadow {
    text-shadow: 0px 4px 10px #000000;
}
  .travel-map-mymap {
    min-height: 350px;
    height: 100%;
    width: 100%;
    /* padding: .5rem; */
  }
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration {
    display: none;
}
@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    .title-form {
        font-size: 3.5rem!important;
    }
    /* .sub-title-form {
        font-size: 1.2rem!important;
    } */
}
@media only screen and (max-width: 576px) {
    /* For mobile phones: */
    .title-form {
        font-size: 3rem!important;
    }
    .sub-title-form {
        font-size: 1.2rem!important;
    }
}
@media only screen and (max-width: 480px) {
    /* For mobile phones: */
    .title-form {
        font-size: 2.5rem!important;
    }
    .sub-title-form {
        font-size: 1rem!important;
    }
}
</style>
