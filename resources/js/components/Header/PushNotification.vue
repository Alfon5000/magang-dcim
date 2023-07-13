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
                .get("/notifications")
                .then((response) => {
                    this.countUnread = response.data.data.data.filter(
                        (notification) => {
                            return notification.is_read === 0;
                        }
                    ).length;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getUnreadNotifications() {
            await api
                .get("notifications/unread")
                .then((response) => {
                    this.notifications = response.data.data;
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
        this.getUnreadNotifications();
    },
};
</script>

<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span
                v-if="notifications > 0"
                class="badge badge-danger navbar-badge"
                >{{ countUnread > 99 ? "99+" : countUnread }}</span
            >
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span v-if="notifications > 0" class="dropdown-item dropdown-header"
                >{{
                    countUnread > 99 ? "99+" : countUnread
                }}
                Notifications</span
            >
            <span class="dropdown-item dropdown-header" v-else
                >No notifications</span
            >
            <div v-for="(notification, index) in notifications" :key="index">
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
                v-if="notifications.length > 0"
                >See All Notifications</router-link
            >
        </div>
    </li>
</template>
