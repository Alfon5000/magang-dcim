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
                                <div class="col-12 col-sm-4">
                                    <UsersStatus />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <MagneticDoor />
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 bg-navy">
                        <!-- <Alerts /> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
