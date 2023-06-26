<script>
import api from "../../api";

export default {
    name: "UsersStatus",
    data() {
        return {
            totalUsers: 0,
        };
    },
    methods: {
        async countUsers() {
            await api
                .get(`/users`)
                .then((response) => {
                    this.totalUsers = response.data.data.total;
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
    <div class="small-box bg-teal">
        <div class="inner">
            <h3>{{ totalUsers }}</h3>
            <p>Users</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</template>
