<script>
import Alerts from "../components/Alerts.vue";
import MagneticDoor from "../components/Dashboard/MagneticDoor.vue";
import TemperatureHumidity from "../components/Dashboard/TemperatureHumidity.vue";
import UsersStatus from "../components/Dashboard/UsersStatus.vue";
import VisitorsStatus from "../components/Dashboard/VisitorsStatus.vue";

export default {
    name: "Dashboard",
    data() {
        return {
            loggedIn: localStorage.getItem("loggedIn"),
            token: localStorage.getItem("token"),
        };
    },
    components: {
        Alerts,
        MagneticDoor,
        TemperatureHumidity,
        UsersStatus,
        VisitorsStatus,
    },
    beforeMount() {
        if (this.loggedIn === null && this.token === null) {
            this.$router.push({ name: "login" });
        }
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row vh-100">
                    <div class="col-12 col-sm-8 col-md-9 px-3">
                        <div class="content-header">
                            <h2>Dashboard</h2>
                        </div>
                        <div class="content">
                            <div class="row">
                                <h4 class="px-2">Total Users</h4>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <UsersStatus
                                        title="Admin"
                                        color="bg-teal"
                                        icon="fas fa-user-cog"
                                        role_id="1"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <UsersStatus
                                        title="User"
                                        color="bg-indigo"
                                        icon="fas fa-users"
                                        role_id="2"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="px-2">Total Visitors</h4>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus
                                        title="Not Visited"
                                        color="bg-danger"
                                        icon="fas fa-walking"
                                        status="-1"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus
                                        title="On Visiting"
                                        color="bg-secondary"
                                        icon="fas fa-walking"
                                        status="0"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus
                                        title="Visited"
                                        color="bg-success"
                                        icon="fas fa-walking"
                                        status="1"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="px-2">Magnetic Door</h4>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <MagneticDoor />
                                </div>
                            </div>
                            <!-- <div class="row">
                                <h4 class="px-2">Temperature & Humidity</h4>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="6"
                                        element_id="th1"
                                        title="Temperature Humidity 1"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="7"
                                        element_id="th2"
                                        title="Temperature Humidity 2"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="8"
                                        element_id="th3"
                                        title="Temperature Humidity 3"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="9"
                                        element_id="th4"
                                        title="Temperature Humidity 4"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="10"
                                        element_id="th5"
                                        title="Temperature Humidity 5"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="11"
                                        element_id="th6"
                                        title="Temperature Humidity 6"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="12"
                                        element_id="th7"
                                        title="Temperature Humidity 7"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="13"
                                        element_id="th8"
                                        title="Temperature Humidity 8"
                                    />
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 bg-navy">
                        <Alerts />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
