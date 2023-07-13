<script>
import api from "../api";

export default {
    name: "Profile",
    data() {
        return {
            user: {
                name: "",
                role_id: "",
                image: "",
                email: "",
                password: "",
            },
            token: localStorage.getItem("token"),
        };
    },
    methods: {
        async getUser() {
            await api
                .get("/user", {
                    headers: { Authorization: "Bearer " + this.token },
                })
                .then((response) => {
                    this.user.name = response.data.data.name;
                    this.user.role_id =
                        response.data.data.role_id === 1 ? "Admin" : "Operator";
                    this.user.image = response.data.data.image;
                    this.user.email = response.data.data.email;
                    this.user.password = response.data.data.password;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>Profile</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img :src="user.image" alt="user image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ user.name }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ user.role_id }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ user.email }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
