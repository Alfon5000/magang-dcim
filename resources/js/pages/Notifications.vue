<script>
import api from "../api";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

export default {
    name: "Notifications",
    components: {
        Bootstrap4Pagination,
    },
    data() {
        return {
            notifications: [],
            intervalId: null,
        };
    },
    methods: {
        async getNotifications(page = 1) {
            await api
                .get("/api/notifications", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                    params: {
                        page,
                    },
                })
                .then((response) => {
                    this.notifications = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async readAll() {
            await api
                .put("/api/notifications/read", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getNotifications();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async unreadAll() {
            await api
                .put("/api/notifications/unread", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getNotifications();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async readOne(id) {
            await api
                .put(`/api/notifications/read/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getNotifications();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async unreadOne(id) {
            await api
                .put(`/api/notifications/unread/${id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then(() => {
                    this.getNotifications();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async deleteAll() {
            Swal.fire({
                title: "Delete Confirmation",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    api.delete("/api/notifications", {
                        headers: {
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    })
                        .then(() => {
                            Swal.fire({
                                title: "Delete Successful",
                                icon: "success",
                            });
                            this.getNotifications();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
        async deleteOne(id) {
            Swal.fire({
                title: "Delete Confirmation",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    api.delete(`/api/notifications/${id}`, {
                        headers: {
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    })
                        .then(() => {
                            Swal.fire({
                                title: "Delete Successful",
                                icon: "success",
                            });
                            this.getNotifications();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
        timestampToDateTime(timestamp) {
            const dateTime = new Date(timestamp);
            let date = dateTime.getUTCDate();
            let month = dateTime.getUTCMonth() + 1;
            const year = dateTime.getUTCFullYear();
            const hour = dateTime.getUTCHours();
            const minute = dateTime.getUTCMinutes();
            const second = dateTime.getUTCSeconds();

            if (date.toString().length === 1) {
                date = "0" + date;
            }

            if (month.toString().length === 1) {
                month = "0" + month;
            }

            return `${date}-${month}-${year} ${hour}:${minute}:${second}`;
        },
        isNotRead(read) {
            if (read === 0) {
                return "font-weight-bold";
            }
        },
    },
    beforeMount() {
        if (!localStorage.getItem("isAuth")) {
            this.$router.push({ name: "login" });
        }
    },
    mounted() {
        this.getNotifications();
        // this.intervalId = setInterval(this.getNotifications, 2000);
    },
    unmounted() {
        // clearInterval(this.intervalId);
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header d-flex justify-content-between py-3">
                <h2>Notifications</h2>
                <div class="d-flex" v-if="notifications.total > 0">
                    <button
                        @click.prevent="readAll()"
                        class="btn btn-primary mr-2"
                    >
                        Mark all as read
                    </button>
                    <button
                        @click.prevent="unreadAll()"
                        class="btn btn-warning mr-2"
                    >
                        Mark all as unread
                    </button>
                    <button @click.prevent="deleteAll()" class="btn btn-danger">
                        Delete all
                    </button>
                </div>
            </div>
            <div class="content">
                <ul v-if="notifications.total > 0" class="list-group">
                    <li
                        v-for="(notification, index) in notifications.data"
                        :key="index"
                        class="list-group-item list-group-item-action"
                    >
                        <div class="row">
                            <div class="col-6 text-left">
                                <span
                                    :class="isNotRead(notification.is_read)"
                                    >{{ notification.message }}</span
                                >
                            </div>
                            <div class="col-3 text-center">
                                <span
                                    :class="isNotRead(notification.is_read)"
                                    >{{
                                        timestampToDateTime(
                                            notification.created_at
                                        )
                                    }}</span
                                >
                            </div>
                            <div class="col-3 text-right">
                                <button
                                    @click.prevent="readOne(notification.id)"
                                    class="btn btn-sm btn-outline-primary"
                                    v-if="notification.is_read === 0"
                                >
                                    Mark as read
                                </button>
                                <button
                                    @click.prevent="unreadOne(notification.id)"
                                    class="btn btn-sm btn-outline-warning"
                                    v-if="notification.is_read === 1"
                                >
                                    Mark as unread
                                </button>
                                <button
                                    @click.prevent="deleteOne(notification.id)"
                                    class="btn btn-sm btn-outline-danger ml-2"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-else class="alert alert-danger text-md">
                    No notifications
                </div>
                <div class="py-3 w-100 overflow-auto">
                    <Bootstrap4Pagination
                        :data="notifications"
                        @pagination-change-page="getNotifications"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
