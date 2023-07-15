import axios from "axios";

const api = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
        "Content-Type": "application/json, multipart/form-data",
    },
});

export default api;
