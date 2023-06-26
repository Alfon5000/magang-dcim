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
        };
    },
    methods: {
        login() {
            if (this.user.email && this.user.password) {
                api.get("/sanctum/csrf-cookie").then((response) => {
                    api.post("/login", this.user)
                        .then((response) => {
                            console.log(response);
                            if (response.data.success) {
                                localStorage.setItem("loggedIn", true);
                                localStorage.setItem(
                                    "token",
                                    response.data.token
                                );
                                this.$router.push({ name: "dashboard" });
                            } else {
                                this.loginFailed = true;
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                });
            }
        },
    },
    beforeMount() {
        if (this.loggedIn === "true") {
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
            Digital Otoma Solusi
        </h2>
        <div class="card w-25 mx-auto mt-5">
            <div class="card-header text-center bg-navy">
                <h3>Log In</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="login()">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            v-model="user.email"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            v-model="user.password"
                        />
                    </div>
                    <div class="form-group">
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="form-group mt-3">
                        <button
                            type="submit"
                            class="btn btn-lg btn-block bg-navy"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
