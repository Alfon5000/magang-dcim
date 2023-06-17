<script>
import HeaderComponent from "../components/HeaderComponent.vue";
import SidebarComponent from "../components/SidebarComponent.vue";

export default {
    name: "CCTV",
    components: {
        HeaderComponent,
        SidebarComponent,
    },
};
</script>

<template>
    <div class="wrapper">
        <header-component></header-component>
        <sidebar-component></sidebar-component>
    </div>
    <div class="content-wrapper px-3">
        <div class="content-headerComponent">
            <h2>CCTV</h2>
        </div>
        <div class="content">
            <iframe
                width="720"
                height="405"
                src="https://www.youtube.com/embed/ClMX6TXvh_o?autoplay=1&mute=1"
                frameborder="1"
                allowfullscreen
            >
            </iframe>
        </div>
    </div>
</template>
