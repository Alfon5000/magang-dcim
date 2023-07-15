<script>
import api from "../../api";

export default {
    name: "UsersCreate",
    data() {
        return {
            user: {
                name: "",
                role_id: "",
                image: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            roles: [],
            errors: [],
        };
    },
    methods: {
        async storeUser() {
            await api
                .post("/users", this.user)
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
        handleFileChange(event) {
            this.user.image = event.target.files[0];
        },
    },
    mounted() {
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
                <h2>Create User</h2>
            </div>
            <div class="content">
                <form @submit.prevent="storeUser()">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="User name"
                            id="name"
                            v-model="user.name"
                        />
                        <div v-if="errors.name" class="text-danger mt-2">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select
                            class="form-control"
                            v-model="user.role_id"
                            id="role"
                        >
                            <option value="">-- Choose role --</option>
                            <option
                                v-for="(role, index) in roles"
                                :key="index"
                                :value="role.id"
                            >
                                {{ role.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="image"
                                    @change="handleFileChange($event)"
                                />
                                <label class="custom-file-label" for="image"
                                    >Choose image</label
                                >
                            </div>
                        </div>

                        <div v-if="errors.image" class="text-danger mt-2">
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
                        <div v-if="errors.email" class="text-danger mt-2">
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
                        <div v-if="errors.password" class="text-danger mt-2">
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
                        <div v-if="errors.password" class="text-danger mt-2">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-teal mr-2">
                            <i class="fas fa-save mr-2"></i>Save
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
