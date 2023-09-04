<script>
import api from "../../api";

export default {
    name: "SmokeDetector",
    data() {
        return {
            status: "No Smoke",
            color: "bg-success",
            icon: "fas fa-smoking-ban",
            intervalId: null,
        };
    },
    methods: {
        async readData() {
            await api
                .get("/api/smoke-detectors/one", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    if (response.data.success === true) {
                        if (response.data.data.status === 1) {
                            this.status = response.data.data.description;
                            this.color = "bg-danger";
                            this.icon = "fas fa-smoking";
                        } else {
                            this.status = response.data.data.description;
                            this.color = "bg-success";
                            this.icon = "fas fa-smoking-ban";
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.intervalId = setInterval(this.readData, 1000);
    },
    unmounted() {
        clearInterval(this.intervalId);
    },
};
</script>

<template>
    <div class="small-box" :class="color">
        <div class="inner">
            <h3>{{ status }}</h3>
            <p>Smoke Detector</p>
        </div>
        <div class="icon">
            <i :class="icon"></i>
        </div>
        <router-link :to="{ name: 'reports' }" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </router-link>
    </div>
</template>
