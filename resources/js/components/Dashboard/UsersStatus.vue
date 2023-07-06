<script>
import api from "../../api";

export default {
    name: "UsersStatus",
    props: ["title", "color", "icon", "role_id"],
    data() {
        return {
            title: this.title,
            color: this.color,
            icon: this.icon,
            role_id: this.role_id,
            users: [],
            total: 0,
        };
    },
    methods: {
        async countUsers() {
            await api
                .get(`/users`)
                .then((response) => {
                    this.users = response.data.all;
                    this.total = this.users.filter((user) => {
                        return user.role_id == this.role_id;
                    }).length;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.countUsers();
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
        <router-link :to="{ name: 'users.index' }" class="small-box-footer"
            >More info <i class="fas fa-arrow-circle-right"></i>
        </router-link>
    </div>
</template>
