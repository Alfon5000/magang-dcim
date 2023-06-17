<script>
import HeaderComponent from "../../components/HeaderComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../api";

export default {
    name: "UsersEdit",
    components: {
        HeaderComponent,
        SidebarComponent,
    },
    setup() {
        const route = useRoute();
        const router = useRouter();

        const name = ref("");
        const email = ref("");
        const role = ref("");
        const password = ref("");
        const errors = ref([]);

        onMounted(async () => {
            await api.get(`/users/${route.params.id}`).then((response) => {
                name.value = response.data.data.name;
                email.value = response.data.data.email;
                role.value = response.data.data.role;
                password.value = response.data.data.password;
            });
        });

        const updateUser = async () => {
            let formData = new FormData();

            formData.append("name", name.value);
            formData.append("email", email.value);
            formData.append("role", role.value);
            formData.append("password", password.value);
            formData.append("_method", "PUT");

            await api
                .post(`/users/${route.params.id}`, formData)
                .then((response) => {
                    router.push({ name: "users.index" });
                    console.log(response);
                })
                .catch((error) => {
                    errors.value = error.data.errors;
                    console.log(error);
                });
        };

        return {
            name,
            email,
            role,
            password,
            errors,
            route,
            router,
            updateUser,
        };
    },
};
</script>

<template>
    <div class="wrapper">
        <header-component></header-component>
        <sidebar-component></sidebar-component>
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
                            v-model="name"
                            placeholder="User name"
                        />
                        <div v-if="errors.name" class="alert alert-danger mt-2">
                            <span>{{ errors.name[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            v-model="email"
                            placeholder="User email"
                        />
                        <div
                            v-if="errors.email"
                            class="alert alert-danger mt-2"
                        >
                            <span>{{ errors.email[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="role"
                            placeholder="User role"
                        />
                        <div v-if="errors.role" class="alert alert-danger mt-2">
                            <span>{{ errors.role[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            v-model="password"
                            placeholder="User password"
                        />
                        <div
                            v-if="errors.password"
                            class="alert alert-danger mt-2"
                        >
                            <span>{{ errors.password[0] }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn bg-teal mr-2">
                            <i class="fas fa-save mr-2"></i>
                            Update
                        </button>
                        <RouterLink
                            :to="{ name: 'users.index' }"
                            class="btn btn-danger"
                            ><i class="fas fa-times mr-2"></i>Cancel</RouterLink
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
