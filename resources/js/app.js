import "./bootstrap";
import "./adminlte";
import { createApp } from "vue";
import App from "./App.vue";
import Header from "./components/Header.vue";
import Sidebar from "./components/Sidebar.vue";
import router from "./router";
import Vue3VideoPlayer from "@cloudgeek/vue3-video-player";
import "@cloudgeek/vue3-video-player/dist/vue3-video-player.css";

const app = createApp(App);

app.component("Header", Header);
app.component("Sidebar", Sidebar);

const myLang = {
    dashboard: {
        btn: {
            play: "播放",
            pause: "Pause",
            fullscreen: "Tela inteira",
            exitFullscreen: "Sair da tela inteira",
            mute: "Mute",
            unmute: "Unmute",
            back: "Back",
            pip: "ピクチャインピクチャ",
        },
        settings: {
            autoplay: "Autoplay",
            loop: "ループプレイ",
            speed: "Speed",
            resolution: "Resolution",
        },
    },
    layers: {
        error: {
            title: "Error!",
            2404: "Video Source Undefined",
            2502: "Media Network Error",
            2503: "Video Cannot DECODE",
            2504: "Video Cannot Play!",
            601: "Live video Cannot Play!",
        },
        loading: {
            msg: "Loading ...",
        },
    },
};

app.use(router);

app.use(Vue3VideoPlayer, {
    lang: myLang,
});

app.mount("#app");
