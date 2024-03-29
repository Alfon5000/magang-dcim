<script>
import api from "../../api";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

export default {
    name: "VisitorsIndex",
    components: {
        Bootstrap4Pagination,
    },
    data() {
        return {
            visitors: [],
            keyword: "",
        };
    },
    methods: {
        async getVisitors(page = 1) {
            await api
                .get("/api/visitors", {
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
                    this.visitors = response.data.data;
                });
        },
        async deleteVisitor(id) {
            Swal.fire({
                title: "Delete Confirmation",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    api.delete(`/api/visitors/${id}`, {
                        headers: {
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    }).then(() => {
                        Swal.fire({
                            title: "Delete Successful",
                            icon: "success",
                        });
                        this.getVisitors();
                    });
                }
            });
        },
        async confirmation(id) {
            Swal.fire({
                title: "Change Status",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Accept",
                cancelButtonText: "Reject",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.acceptVisitor(id);
                } else {
                    this.rejectVisitor(id);
                }
            });
        },
        async acceptVisitor(id) {
            await api
                .put(`/api/visitors/accept/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getVisitors();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async rejectVisitor(id) {
            await api
                .put(`/api/visitors/reject/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getVisitors();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        timestampToDate(timestamp) {
            const dateTime = new Date(timestamp);
            const year = dateTime.getUTCFullYear();
            let month = dateTime.getUTCMonth() + 1;
            let date = dateTime.getUTCDate();

            if (date.toString().length === 1) {
                date = "0" + date;
            }

            if (month.toString().length === 1) {
                month = "0" + month;
            }

            return `${date}-${month}-${year}`;
        },
        setBadgeColor(status_id) {
            if (status_id === 1) {
                return "badge-secondary";
            } else if (status_id === 2) {
                return "badge-primary";
            } else if (status_id === 3) {
                return "badge-danger";
            } else {
                return "badge-dark";
            }
        },
    },
    beforeMount() {
        if (!localStorage.getItem("isAuth")) {
            this.$router.push({ name: "login" });
        }
    },
    mounted() {
        this.getVisitors();
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>Visitor List</h2>
            </div>
            <div class="content">
                <div class="overflow-auto">
                    <div class="float-left ml-0">
                        <router-link
                            :to="{ name: 'visitors.create' }"
                            class="btn bg-teal mb-3"
                            ><i class="fas fa-plus mr-2"></i>Create</router-link
                        >
                    </div>
                    <div class="float-right">
                        <form @submit.prevent="getVisitors()">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control mb-3 mr-2"
                                    placeholder="Search here..."
                                    v-model="keyword"
                                />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-navy text-white">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Application Date</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Application Letter</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-if="visitors.total > 0"
                                v-for="(visitor, index) in visitors.data"
                                :key="index"
                                class="text-center"
                            >
                                <td>{{ ++index }}</td>
                                <td>{{ visitor.name }}</td>
                                <td>{{ visitor.category.name }}</td>
                                <td>
                                    {{ timestampToDate(visitor.created_at) }}
                                </td>
                                <td>
                                    {{ timestampToDate(visitor.start_date) }}
                                </td>
                                <td>{{ timestampToDate(visitor.end_date) }}</td>
                                <td>
                                    <a
                                        v-if="
                                            visitor.application_letter !== '' ||
                                            visitor.application_letter !== null
                                        "
                                        :href="`api/visitors/download/${visitor.application_letter}`"
                                        target="_blank"
                                        ><i class="fas fa-download"></i
                                    ></a>
                                    <span v-else>No application letter</span>
                                </td>
                                <td
                                    class="text-left text-break"
                                    style="max-width: 500px"
                                >
                                    {{ visitor.description }}
                                </td>
                                <td>
                                    <span
                                        class="badge badge-pill"
                                        :class="
                                            setBadgeColor(visitor.status_id)
                                        "
                                    >
                                        {{ visitor.status.name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="row mb-1">
                                        <button
                                            @click.prevent="
                                                confirmation(visitor.id)
                                            "
                                            class="btn btn-info btn-block"
                                        >
                                            <i class="fas fa-question mr-2"></i>
                                            Status
                                        </button>
                                    </div>
                                    <div class="row mb-1">
                                        <router-link
                                            :to="{
                                                name: 'visitors.edit',
                                                params: { id: visitor.id },
                                            }"
                                            class="btn bg-indigo btn-block"
                                            ><i class="fas fa-edit mr-2"></i
                                            >Edit</router-link
                                        >
                                    </div>
                                    <div class="row mb-1">
                                        <button
                                            @click.prevent="
                                                deleteVisitor(visitor.id)
                                            "
                                            class="btn bg-pink btn-block"
                                        >
                                            <i class="fas fa-trash-alt mr-2"></i
                                            >Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="10" class="text-center">
                                    <div class="alert alert-danger mb-0">
                                        Visitor is not available
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Bootstrap4Pagination
                    :data="visitors"
                    @pagination-change-page="getVisitors"
                />
            </div>
        </div>
    </div>
</template>
