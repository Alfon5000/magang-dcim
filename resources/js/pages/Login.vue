<script>
import api from "../api";

export default {
    name: "Login",
    data() {
        return {
            user: {
                email: "",
                password: "",
            },
            isAuth: localStorage.getItem("isAuth"),
            token: localStorage.getItem("token"),
            errors: [],
            message: "",
        };
    },
    methods: {
        async login() {
            await api
                .get("/sanctum/csrf-cookie")
                .then(async () => {
                    await api
                        .post("/api/login", this.user)
                        .then((response) => {
                            if (response.data.success === true) {
                                localStorage.setItem("isAuth", true);
                                localStorage.setItem(
                                    "token",
                                    response.data.token
                                );
                                this.$router.push({ name: "dashboard" });
                            } else {
                                this.errors = [];
                                this.message = "";
                                this.errors = response.data.message;
                            }
                        })
                        .catch((error) => {
                            this.errors = [];
                            this.message = "";
                            this.message = error.response.data.message;
                        });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    beforeMount() {
        if (this.isAuth) {
            this.$router.push({ name: "dashboard" });
        }
    },
};
</script>

<template>
    <div class="container-fluid pt-5">
        <h2 class="text-center">
            Data Center Infrastructure Management
            <br />
            PT Digital Otoma Solusi
        </h2>
        <div class="card mx-auto mt-5" style="width: 350px">
            <div class="card-header text-center bg-navy">
                <h5>Please log In</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="login()">
                    <div class="form-group mt-3">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            v-model="user.email"
                        />
                        <div v-if="errors.email" class="text-danger mt-2">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            v-model="user.password"
                        />
                        <div v-if="errors.password" class="text-danger mt-2">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button
                            type="submit"
                            class="btn btn-lg btn-block bg-navy"
                        >
                            Log in
                        </button>
                    </div>
                    <div v-show="message" class="text-danger text-center mt-3">
                        {{ message }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
