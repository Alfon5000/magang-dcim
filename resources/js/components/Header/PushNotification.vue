<script>
import api from "../../api";

export default {
    name: "PushNotifications",
    data() {
        return {
            notifications: [],
            countUnread: 0,
        };
    },
    methods: {
        async getNotifications() {
            await api
                .get("/notifications", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    this.notifications = response.data.all.filter(
                        (notification) => {
                            return notification.is_read === 0;
                        }
                    );
                    this.countUnread = this.notifications.length;
                })
                .catch((error) => {
                    console.log(error);
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
        isNotRead(read) {
            if (read === 0) {
                return "font-weight-bold";
            }
        },
    },
    mounted() {
        this.getNotifications();
    },
};
</script>

<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span
                v-if="countUnread > 0"
                class="badge badge-danger navbar-badge"
                >{{ countUnread > 99 ? "99+" : countUnread }}</span
            >
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span v-if="countUnread > 0" class="dropdown-item dropdown-header"
                >{{
                    countUnread > 99 ? "99+" : countUnread
                }}
                Notifications</span
            >
            <span v-else class="dropdown-item dropdown-header"
                >No new notifications</span
            >
            <div
                v-for="(notification, index) in notifications.slice(1, 10)"
                :key="index"
            >
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    {{ notification.message.substring(0, 25) }}...
                    <span class="float-right text-muted text-sm">{{
                        timestampToDate(notification.created_at)
                    }}</span>
                </a>
            </div>
            <div class="dropdown-divider"></div>
            <router-link
                :to="{ name: 'notifications' }"
                class="dropdown-item dropdown-footer"
                >See All Notifications</router-link
            >
        </div>
    </li>
</template>
