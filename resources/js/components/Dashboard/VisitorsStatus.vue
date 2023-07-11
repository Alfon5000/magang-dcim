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

                    if (this.status == "1") {
                        this.total = this.visitors.filter((visitor) => {
                            return visitor.status_id === 1;
                        }).length;
                    } else if (this.status == "2") {
                        this.total = this.visitors.filter((visitor) => {
                            return visitor.status_id === 2;
                        }).length;
                    } else if (this.status == "3") {
                        this.total = this.visitors.filter((visitor) => {
                            return visitor.status_id === 3;
                        }).length;
                    }
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
