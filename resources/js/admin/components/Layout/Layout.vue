<template>
    <div
        :class="[{ root: true, sidebarClose, sidebarStatic }, 'sing-dashboard']"
    >
        <Sidebar />
        <!-- <Helper /> -->
        <div class="wrap">
            <Header />
            <v-touch
                class="content"
                @swipe="handleSwipe"
                :swipe-options="{ direction: 'horizontal' }"
            >
                <!-- <breadcrumb-history></breadcrumb-history> -->
                <transition name="router-animation">
                    <router-view />
                </transition>
                <footer class="contentFooter">
                    Developed by
                    <a
                        href="https://alterfingers.com"
                        rel="nofollow noopener noreferrer"
                        target="_blank"
                        >Alterfingers</a
                    >
                </footer>
            </v-touch>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
const { mapState, mapActions } = createNamespacedHelpers("layout");

import Sidebar from "@/admin/components/Sidebar/Sidebar";
import Header from "@/admin/components/Header/Header";
import Helper from "@/admin/components/Helper/Helper";
// import BreadcrumbHistory from "@/admin/components/BreadcrumbHistory/BreadcrumbHistory";

import "./Layout.scss";

export default {
    name: "Layout",
    components: { Sidebar, Header, Helper
    ,
    // BreadcrumbHistory
     },
    methods: {
        ...mapActions([
            "switchSidebar",
            "handleSwipe",
            "changeSidebarActive",
            "toggleSidebar"
        ]),
        handleWindowResize() {
            const width = window.innerWidth;

            if (width <= 768 && this.sidebarStatic) {
                this.toggleSidebar();
                this.changeSidebarActive(null);
            }
        }
    },
    computed: {
        ...mapState(["sidebarClose", "sidebarStatic"])
    },
    created() {
        const staticSidebar = JSON.parse(localStorage.getItem("sidebarStatic"));

        if (staticSidebar) {
            this.$store.state.layout.sidebarStatic = true;
        } else if (!this.sidebarClose) {
            setTimeout(() => {
                this.switchSidebar(true);
                this.changeSidebarActive(null);
            }, 0);
        }

        this.handleWindowResize();
        window.addEventListener("resize", this.handleWindowResize);
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.handleWindowResize);
    }
};
</script>

<style src="./Layout.scss" lang="scss" />
