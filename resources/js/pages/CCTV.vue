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
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h4>Luar 1</h4>
                        <CCTVPlayer
                            elementID="luar_1"
                            streamURL="rtsp://192.168.11.5"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4>Luar 2</h4>
                        <CCTVPlayer
                            elementID="luar_2"
                            streamURL="rtsp://192.168.11.6"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h4>Access Door</h4>
                        <CCTVPlayer
                            elementID="access_door"
                            streamURL="rtsp://192.168.11.8"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4>Dalam</h4>
                        <CCTVPlayer
                            elementID="dalam"
                            streamURL="rtsp://192.168.11.9"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
