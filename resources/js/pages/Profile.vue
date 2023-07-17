<script>
import api from "../api";

export default {
    name: "Profile",
    data() {
        return {
            user: {
                id: "",
                name: "",
                role_id: "",
                image: "",
                email: "",
                password: "",
                password_confirmation: "",
                _method: "PUT",
            },
            roles: [],
            errors: [],
        };
    },
    methods: {
        async getAuth() {
            await api
                .get("/user", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.user.id = response.data.id;
                    this.user.name = response.data.name;
                    this.user.role_id = response.data.role_id;
                    this.user.image = response.data.image;
                    this.user.email = response.data.email;
                    this.user.password = response.data.password;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getRoles() {
            await api
                .get("/roles", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.roles = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async updateUser() {
            await api
                .post(`/users/${this.user.id}`, this.user, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    if (response.data.success === true) {
                        this.$router.push({ name: "dashboard" });
                    } else {
                        this.errors = response.data.message;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleFileChange(event) {
            this.user.image = event.target.files[0];
        },
    },
    mounted() {
        this.getAuth();
        this.getRoles();
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
                <div class="row mx-5">
                    <div class="col-12 col-sm-3">
                        <div class="card">
                            <div class="card-header text-center bg-navy">
                                <h4>Profile Picture</h4>
                            </div>
                            <div class="card-body text-center">
                                <img
                                    :src="
                                        user.image !== '' || user.image !== null
                                            ? `storage/images/users/${user.image}`
                                            : `https://cdn-icons-png.flaticon.com/128/3033/3033143.png`
                                    "
                                    width="300"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="card">
                            <div class="card-header text-center bg-navy">
                                <h4>User Information</h4>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="updateUser()">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="User name"
                                            id="name"
                                            v-model="user.name"
                                        />
                                        <div
                                            v-if="errors.name"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.name[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select
                                            class="form-control"
                                            v-model="user.role_id"
                                            id="role"
                                            disabled
                                        >
                                            <option value="">
                                                -- Choose role --
                                            </option>
                                            <option
                                                v-for="(role, index) in roles"
                                                :key="index"
                                                :value="role.id"
                                            >
                                                {{ role.name }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.role_id"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.role_id[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input
                                                    type="file"
                                                    class="custom-file-input"
                                                    id="image"
                                                    @change="
                                                        handleFileChange($event)
                                                    "
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="image"
                                                    >Choose image</label
                                                >
                                            </div>
                                        </div>
                                        <div
                                            v-if="errors.image"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.image[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="User email"
                                            id="email"
                                            v-model="user.email"
                                        />
                                        <div
                                            v-if="errors.email"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.email[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            v-model="user.password"
                                            placeholder="User password"
                                            id="password"
                                        />
                                        <div
                                            v-if="errors.password"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.password[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                            >Password Confirmation</label
                                        >
                                        <input
                                            type="password"
                                            class="form-control"
                                            v-model="user.password_confirmation"
                                            placeholder="User password confirmation"
                                            id="password_confirmation"
                                        />
                                        <div
                                            v-if="errors.password"
                                            class="text-danger mt-2"
                                        >
                                            {{ errors.password[0] }}
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col">
                                                <button
                                                    type="submit"
                                                    class="btn btn-block bg-teal"
                                                >
                                                    <i
                                                        class="fas fa-save mr-2"
                                                    ></i
                                                    >Update
                                                </button>
                                            </div>
                                            <div class="col">
                                                <router-link
                                                    :to="{ name: 'dashboard' }"
                                                    class="btn btn-block btn-danger"
                                                    ><i
                                                        class="fas fa-times mr-2"
                                                    ></i
                                                    >Cancel</router-link
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
