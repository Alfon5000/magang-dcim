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
            role_id: 0,
            users: [],
            keyword: "",
        };
    },
    methods: {
        async getAuthUser() {
            await api
                .get("/user")
                .then((response) => {
                    this.role_id = response.data.data.role_id;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getUsers(page = 1) {
            await api
                .get("/users", {
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
            Swal.fire({
                title: "Delete Confirmation",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    api.delete(`/users/${id}`).then(() => {
                        Swal.fire({
                            title: "Delete Successful",
                            icon: "success",
                        });
                        this.getUsers();
                    });
                }
            });
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
        this.getAuthUser();
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
                            <th scope="col" v-show="role_id === 1">Actions</th>
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
                                    v-if="user.image !== null"
                                    :src="`storage/images/users/${user.image}`"
                                    width="150"
                                />
                                <img
                                    v-else
                                    src="../../../../public/images/user.jpg"
                                    width="150"
                                />
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role.name }}</td>
                            <td>{{ timestampToDate(user.created_at) }}</td>
                            <td v-show="role_id === 1">
                                <div class="row mb-1">
                                    <router-link
                                        :to="{
                                            name: 'users.edit',
                                            params: { id: user.id },
                                        }"
                                        class="btn bg-indigo btn-block"
                                        ><i class="fas fa-edit mr-2"></i
                                        >Edit</router-link
                                    >
                                </div>
                                <div class="row">
                                    <button
                                        @click.prevent="deleteUser(user.id)"
                                        class="btn bg-pink btn-block"
                                    >
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-danger mb-0">
                                    Users is not available
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
