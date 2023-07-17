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
            loggedIn: localStorage.getItem("loggedIn"),
            token: localStorage.getItem("token"),
            loginFailed: null,
            errors: [],
        };
    },
    methods: {
        async login() {
            if (this.user.email && this.user.password) {
                await api.get("/sanctum/csrf-cookie").then(async () => {
                    await api
                        .post("/login", this.user)
                        .then((response) => {
                            if (response.data.success === true) {
                                localStorage.setItem("loggedIn", true);
                                localStorage.setItem(
                                    "token",
                                    response.data.token
                                );
                                this.$router.push({ name: "dashboard" });
                            } else {
                                this.errors = response.data.message;
                                this.loginFailed = true;
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                });
            }
        },
    },
    mounted() {
        if (this.loggedIn === "true") {
            this.$router.push({ name: "dashboard" });
        }
    },
};
</script>

<template>
    <div class="container-fluid mt-5">
        <h1 class="text-center">
            Data Center Infrastructure Management
            <br />
            Digital Otoma Solusi
        </h1>
        <div class="card w-25 mx-auto mt-5">
            <div class="card-header text-center bg-navy py-4">
                <h3>Please log in</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="login()">
                    <div class="form-group mt-3">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            class="form-control form-control-lg"
                            id="email"
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
                            class="form-control form-control-lg"
                            id="password"
                            placeholder="Enter your password"
                            v-model="user.password"
                        />
                        <div v-if="errors.password" class="text-danger mt-2">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <button
                            type="submit"
                            class="btn btn-lg btn-block bg-navy py-3"
                        >
                            <span class="text-lg">Log in</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
