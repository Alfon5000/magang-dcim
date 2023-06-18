<script>
import HeaderComponent from "../components/HeaderComponent.vue";
import SidebarComponent from "../components/SidebarComponent.vue";
import { onMounted } from "vue";

export default {
    name: "CCTV",
    components: {
        HeaderComponent,
        SidebarComponent,
    },
    setup() {
        const playCCTV = () => {
            const cctvElement = document.getElementById("cctvElement");
            const streamUrl = "rtsp://host:port/stream-name";
            cctvElement.src = streamUrl;
            cctvElement.onerror = () => {
                console.log("Error occurred while loading the stream.");
            };
        };

        onMounted(() => {
            playCCTV();
        });
    },
};
</script>

<template>
    <div class="wrapper">
        <header-component></header-component>
        <sidebar-component></sidebar-component>
    </div>
    <div class="content-wrapper px-3">
        <div class="content-header">
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
            <!-- <video id="cctvElement" autoplay></video> -->
        </div>
    </div>
</template>
