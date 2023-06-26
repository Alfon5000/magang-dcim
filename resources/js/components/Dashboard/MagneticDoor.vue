<script>
import api from "../../api";

export default {
    name: "MagneticDoor",
    data() {
        return {
            status: "Closed",
            color: "bg-success",
            icon: "fas fa-door-closed",
        };
    },
    methods: {
        async readData() {
            await api
                .get(`/magnetic-door`)
                .then((response) => {
                    if (response.data.success === true) {
                        if (response.data.data.status === 0) {
                            this.status = "Open";
                            this.color = "bg-danger";
                            this.icon = "fas fa-door-open";
                        } else {
                            this.status = "Closed";
                            this.color = "bg-success";
                            this.icon = "fas fa-door-closed";
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        setInterval(this.readData, 1000);
    },
};
</script>

<template>
    <div class="small-box" :class="color">
        <div class="inner">
            <h3>{{ status }}</h3>
            <p>Magnetic Door</p>
        </div>
        <div class="icon">
            <i :class="icon"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</template>
