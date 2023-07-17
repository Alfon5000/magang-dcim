<script>
import CCTVPlayer from "../components/CCTV/CCTVPlayer.vue";

export default {
    name: "CCTV",
    components: {
        CCTVPlayer,
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>CCTV</h2>
            </div>
            <div class="content">
                <video controls autoplay>
                    <source
                        src="rtsp://admin:admin@192.168.101.42:554/Streaming/Channels/101"
                    />
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</template>
