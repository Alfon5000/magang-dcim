<script>
import api from "../../api";

export default {
    name: "VisitorsStatus",
    props: ["title", "color", "icon", "status"],
    data() {
        return {
            title: this.title,
            color: this.color,
            icon: this.icon,
            status: this.status,
            visitors: [],
            total: 0,
        };
    },
    methods: {
        async countVisitors() {
            await api
                .get(`/visitors`)
                .then((response) => {
                    this.visitors = response.data.all;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        visitorsStatus() {
            switch (this.status) {
                case "-1":
                    this.total = this.visitors.filter((visitor) => {
                        return visitor.end_start < Date();
                    }).length;
                    break;
                case "0":
                    this.total = this.visitors.filter((visitor) => {
                        return (
                            visitor.start_date >= Date() &&
                            visitor.end_date <= Date()
                        );
                    }).length;
                    break;
                case "1":
                    this.total = this.visitors.filter((visitor) => {
                        return visitor.end_date > Date();
                    }).length;
                    break;
            }
        },
    },
    mounted() {
        this.countVisitors();
        this.visitorsStatus();
    },
};
</script>

<template>
    <div class="small-box" :class="color">
        <div class="inner">
            <h3>{{ total }}</h3>
            <p>{{ title }}</p>
        </div>
        <div class="icon">
            <i :class="icon"></i>
        </div>
        <router-link :to="{ name: 'visitors.index' }" class="small-box-footer"
            >More info <i class="fas fa-arrow-circle-right"></i>
        </router-link>
    </div>
</template>
