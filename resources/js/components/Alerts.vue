<script>
import api from "../api";

export default {
    name: "Alerts",
    data() {
        return {
            notifications: [],
            intervalId: null,
        };
    },
    methods: {
        createDateTime() {
            if (this.$route.name === "dashboard") {
                const dateElement = document.getElementById("date");
                const timeElement = document.getElementById("time");

                const dateTime = new Date();

                const date = dateTime.toLocaleDateString(undefined, {
                    weekday: "short",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                });

                const time = dateTime.toLocaleTimeString();

                dateElement.innerText = date;
                timeElement.innerText = time;
            }
        },
        updateTime() {
            setInterval(this.createDateTime, 1000);
        },
        async getNotifications() {
            await api
                .get("/api/notifications", {
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
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        timestampToDateTime(timestamp) {
            const dateTime = new Date(timestamp);
            let day = dateTime.getUTCDate();
            let month = dateTime.getUTCMonth() + 1;
            const year = dateTime.getUTCFullYear();
            const hour = dateTime.getUTCHours();
            const minute = dateTime.getUTCMinutes();
            const second = dateTime.getUTCSeconds();

            if (day.toString().length === 1) {
                day = "0" + day;
            }

            if (month.toString().length === 1) {
                month = "0" + month;
            }

            return `${day}-${month}-${year} ${hour}:${minute}:${second}`;
        },
    },
    mounted() {
        this.updateTime();
        // this.intervalId = setInterval(this.getNotifications, 2000);
    },
    unmounted() {
        // clearInterval(this.intervalId);
    },
};
</script>

<template>
    <div class="container-fluid">
        <div class="container-fluid my-3">
            <div id="datetime-widget">
                <div id="time"></div>
                <div id="date"></div>
            </div>
        </div>
        <hr class="bg-light" />
        <div class="container-fluid my-3">
            <h5 class="text-center text-light my-3">Alerts</h5>
            <ul class="list-group text-navy">
                <li
                    v-if="notifications.length > 0"
                    v-for="(notification, index) in notifications.slice(0, 10)"
                    :key="index"
                    class="list-group-item text-danger"
                >
                    {{ notification.message }} at
                    {{ timestampToDateTime(notification.created_at) }}
                </li>
                <span v-else class="alert alert-primary text-center"
                    >No alerts</span
                >
            </ul>
            <router-link
                :to="{ name: 'notifications' }"
                v-show="notifications.length > 0"
                class="btn btn-primary btn-block mt-3"
                >See more alerts</router-link
            >
        </div>
    </div>
</template>

<style scoped>
#datetime-widget {
    width: 100%;
    text-align: center;
}

#time {
    font-size: 20px;
    font-weight: bold;
}

#date {
    font-size: 14px;
}
</style>
