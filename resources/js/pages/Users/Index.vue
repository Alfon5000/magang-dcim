<script>
import HeaderComponent from "../../components/HeaderComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import api from "../../api";
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";

export default {
    name: "UsersIndex",
    components: {
        HeaderComponent,
        SidebarComponent,
    },
    setup() {
        const users = ref([]);

        const getUsers = async () => {
            await api.get("/users").then((response) => {
                users.value = response.data.data.data;
            });
        };

        const deleteUser = async (id) => {
            await api.delete(`/users/${id}`).then(() => {
                getUsers();
            });
        };

        onMounted(() => {
            getUsers();
        });

        return {
            users,
            getUsers,
            deleteUser,
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
                <h2>User List</h2>
            </div>
            <div class="content">
                <div class="overflow-auto">
                    <div class="float-left">
                        <router-link
                            :to="{ name: 'users.create' }"
                            class="btn bg-teal mb-3"
                            ><i class="fas fa-plus mr-2"></i>Create</router-link
                        >
                    </div>
                    <div class="float-right">
                        <form>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control mb-3"
                                    placeholder="Search here..."
                                />
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-navy text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-if="users.length > 0"
                            v-for="(user, index) in users"
                            :key="index"
                        >
                            <td>{{ ++index }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role }}</td>
                            <td>{{ user.created_at }}</td>
                            <td class="d-flex">
                                <router-link
                                    :to="{
                                        name: 'users.edit',
                                        params: { id: user.id },
                                    }"
                                    class="btn bg-indigo mr-2"
                                    ><i class="fas fa-edit mr-2"></i
                                    >Edit</router-link
                                >
                                <button
                                    @click.prevent="deleteUser(user.id)"
                                    class="btn bg-pink"
                                >
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-danger mb-0">
                                    User is not available.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
