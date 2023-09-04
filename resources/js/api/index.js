import axios from "axios";

const api = axios.create({
    baseURL: "http://localhost:8000",
});

// api.defaults.headers.common["Accept"] = "application/json";
// api.defaults.headers.common["Authorization"] =
//     "Bearer " + localStorage.getItem("token");
// api.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
// api.defaults.withCredentials = true;

export default api;
