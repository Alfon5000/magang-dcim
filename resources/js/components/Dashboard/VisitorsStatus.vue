<script>
import api from "../../api";

export default {
    name: "VisitorsStatus",
    data() {
        return {
            totalVisitors: 0,
        };
    },
    methods: {
        async countVisitors() {
            await api
                .get(`/visitors`)
                .then((response) => {
                    this.totalVisitors = response.data.data.total;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.countVisitors();
    },
};
</script>

<template>
    <div class="small-box bg-indigo">
        <div class="inner">
            <h3>{{ totalVisitors }}</h3>
            <p>Visitors</p>
        </div>
        <div class="icon">
            <i class="fas fa-walking"></i>
        </div>
        <router-link :to="{ name: 'visitors.index' }" class="small-box-footer"
            >More info <i class="fas fa-arrow-circle-right"></i>
        </router-link>
    </div>
</template>
