<script>
import { ref } from "vue";
import api from "../api";
import { useRouter } from "vue-router";

export default {
    name: "Login",
    setup() {
        const email = ref("");
        const password = ref("");
        const router = useRouter();

        const login = async () => {
            let formData = new FormData();
            formData.append("email", email.value);
            formData.append("password", password.value);

            await api
                .post("/login", formData)
                .then(() => {
                    router.push({ name: "dashboard" });
                })
                .catch((error) => {
                    console.log(error);
                });
        };

        return {
            email,
            password,
            router,
            login,
        };
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
