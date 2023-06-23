import "./bootstrap";
import "./adminlte";
import { createApp } from "vue";
import App from "./App.vue";
import Header from "./components/Header.vue";
import Sidebar from "./components/Sidebar.vue";
import router from "./router";

const app = createApp(App);

app.component("Header", Header);
app.component("Sidebar", Sidebar);

app.use(router);

app.mount("#app");
