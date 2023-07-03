<script>
import api from "../../api";

export default {
    name: "UsersEdit",
    data() {
        return {
            user: {
                name: "",
                role_id: "",
                image: "",
                email: "",
                password: "",
            },
            roles: [],
            errors: [],
            config: {
                headers: {
                    "content-type": "multipart/form-data",
                },
            },
        };
    },
    methods: {
        async getUser() {
            await api
                .get(`/users/${this.$route.params.id}`)
                .then((response) => {
                    this.user.name = response.data.data.name;
                    this.user.email = response.data.data.email;
                    this.user.role_id = response.data.data.role.id;
                    this.user.password = response.data.data.password;
                    this.user.image = response.data.data.image;
                });
        },
        async getRoles() {
            await api
                .get("/roles")
                .then((response) => {
                    this.roles = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async updateUser() {
            await api
                .put(`/users/${this.$route.params.id}`, this.user, this.config)
                .then((response) => {
                    if (response.data.success === true) {
                        this.$router.push({ name: "users.index" });
                    } else {
                        this.errors = response.data.message;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getUser();
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
                <h2>Edit User</h2>
            </div>
            <div class="content">
                <form @submit.prevent="updateUser()">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="user.name"
                            placeholder="User name"
                        />
                        <div v-if="errors.name" class="text-danger mt-2">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            v-model="user.email"
                            placeholder="User email"
                        />
                        <div v-if="errors.email" class="text-danger mt-2">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select class="form-control" v-model="user.role_id">
                            <option
                                v-for="(role, index) in roles"
                                :key="index"
                                :value="role.id"
                            >
                                {{ role.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <input
                            type="file"
                            class="form-control"
                            @change="handleFileChange($event)"
                        />
                        <div v-if="errors.image" class="text-danger mt-2">
                            {{ errors.image[0] }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            v-model="user.password"
                            placeholder="User password"
                        />
                        <div v-if="errors.password" class="text-danger mt-2">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn bg-teal mr-2">
                            <i class="fas fa-save mr-2"></i>
                            Update
                        </button>
                        <router-link
                            :to="{ name: 'users.index' }"
                            class="btn btn-danger"
                            ><i class="fas fa-times mr-2"></i
                            >Cancel</router-link
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
