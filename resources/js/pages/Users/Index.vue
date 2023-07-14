<script>
import api from "../../api";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

export default {
    name: "UsersIndex",
    components: {
        Bootstrap4Pagination,
    },
    data() {
        return {
            users: [],
            keyword: "",
        };
    },
    methods: {
        async getUsers(page = 1) {
            await api
                .get(`/users`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                    params: {
                        page,
                        search: this.keyword.length > 0 ? this.keyword : "",
                    },
                })
                .then((response) => {
                    this.users = response.data.data;
                });
        },
        async deleteUser(id) {
            await api
                .delete(`/users/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => this.getUsers());
        },
        timestampToDate(timestamp) {
            const dateTime = new Date(timestamp);
            let date = dateTime.getUTCDate();
            let month = dateTime.getUTCMonth() + 1;
            const year = dateTime.getUTCFullYear();

            if (date.toString().length === 1) {
                date = "0" + date;
            }

            if (month.toString().length === 1) {
                month = "0" + month;
            }

            return `${date}-${month}-${year}`;
        },
    },
    mounted() {
        this.getUsers();
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
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
                        <form @submit.prevent="getUsers()">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control mb-3"
                                    placeholder="Search here..."
                                    v-model="keyword"
                                />
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-navy text-white">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-if="users.total > 0"
                            v-for="(user, index) in users.data"
                            :key="index"
                            class="text-center"
                        >
                            <td>{{ ++index }}</td>
                            <td>
                                <img
                                    :src="`storage/images/users/${user.image}`"
                                    alt="user-image"
                                    width="150"
                                />
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role.name }}</td>
                            <td>{{ timestampToDate(user.created_at) }}</td>
                            <td>
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
                            <td colspan="7" class="text-center">
                                <div class="alert alert-danger mb-0">
                                    User is not available.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Bootstrap4Pagination
                    :data="users"
                    @pagination-change-page="getUsers"
                />
            </div>
        </div>
    </div>
</template>
