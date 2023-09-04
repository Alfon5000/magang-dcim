<script>
import HLSCore from "@cloudgeek/playcore-hls";
import PictureInPicture from "../components/CCTV/PictureInPicture.vue";
import { Vitar } from "@cloudgeek/vitar";

export default {
    name: "CCTV",
    components: {
        PictureInPicture,
        Vitar,
    },
    data() {
        return {
            players: {},
            HLSCore,
            volume: 80,
            srcCam1: "https://stream.dgos.id/cam1/index.m3u8",
            srcCam2: "https://stream.dgos.id/cam2/index.m3u8",
            srcCam3: "https://stream.dgos.id/cam3/index.m3u8",
            srcCam4: "https://stream.dgos.id/acd1/index.m3u8",
        };
    },
    methods: {
        viewCore(id, player) {
            // console.log(id, player);
            this.players[id] = player;
        },
        play(id) {
            // console.log("custom play: id =", id);
            this.players && this.players[id] && this.players[id].play();
        },
        destroy(id) {
            this.players && this.players[id] && this.players[id].destroy();
        },
        playEnded(e) {
            // console.log(e);
            if (e.target === document.pictureInPictureElement) {
                document.exitPictureInPicture();
            }
        },
        volumeUp(id) {
            this.volume += 5;
            if (this.volume > 100) {
                this.volume = 100;
            }
            this.players &&
                this.players[id] &&
                this.players[id].setVolume(this.volume / 100, true);
        },
        volumeDown(id) {
            this.volume -= 5;
            if (this.volume < 0) {
                this.volume = 0;
            }
            this.players &&
                this.players[id] &&
                this.players[id].setVolume(this.volume / 100, true);
        },
        pip(id) {
            // you can also use this.players[id].$video to do what u want just like playEnded
            // console.log(this.players[id].$video);
            this.players &&
                this.players[id] &&
                this.players[id].requestPictureInPicture();
        },
    },
    beforeMount() {
        if (!localStorage.getItem("isAuth")) {
            this.$router.push({ name: "login" });
        }
    },
    mounted() {
        this.play("cam1");
        this.play("cam2");
        this.play("cam3");
        this.play("cam4");
    },
    unmounted() {
        this.destroy("cam1");
        this.destroy("cam2");
        this.destroy("cam3");
        this.destroy("cam4");
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
                <div class="row my-2">
                    <div class="col-12 col-sm-6 my-1">
                        <vue3-video-player
                            :core="HLSCore"
                            :src="srcCam1"
                            title="Access Door 1"
                            resolution="408p"
                            :view-core="viewCore.bind(null, 'cam1')"
                        >
                        </vue3-video-player>
                    </div>
                    <div class="col-12 col-sm-6 my-1">
                        <vue3-video-player
                            :core="HLSCore"
                            :src="srcCam2"
                            title="Outside 1"
                            resolution="408p"
                            :view-core="viewCore.bind(null, 'cam2')"
                        >
                        </vue3-video-player>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12 col-sm-6 my-1">
                        <vue3-video-player
                            :core="HLSCore"
                            :src="srcCam3"
                            title="Outside 2"
                            resolution="408p"
                            :view-core="viewCore.bind(null, 'cam3')"
                        >
                        </vue3-video-player>
                    </div>
                    <div class="col-12 col-sm-6 my-1">
                        <vue3-video-player
                            :core="HLSCore"
                            :src="srcCam4"
                            title="Access Door 2"
                            resolution="408p"
                            :view-core="viewCore.bind(null, 'cam4')"
                        >
                        </vue3-video-player>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 20px;
}
.test-player-wrap {
    width: 720px;
    height: 405px;
    position: relative;
    margin: 20px auto;
}
.btn-play {
    color: white;
    margin-right: 10px;
    cursor: pointer;
}
.btn-play svg {
    width: 16px;
}
</style>
