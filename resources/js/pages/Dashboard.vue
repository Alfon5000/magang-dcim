<script>
import Alerts from "../components/Alerts.vue";
import MagneticDoor from "../components/Dashboard/MagneticDoor.vue";
import SmokeDetector from "../components/Dashboard/SmokeDetector.vue";
import TemperatureHumidity from "../components/Dashboard/TemperatureHumidity.vue";
import UsersStatus from "../components/Dashboard/UsersStatus.vue";
import VisitorsStatus from "../components/Dashboard/VisitorsStatus.vue";

export default {
    name: "Dashboard",
    components: {
        Alerts,
        MagneticDoor,
        TemperatureHumidity,
        UsersStatus,
        VisitorsStatus,
        SmokeDetector,
    },
    mounted() {
        if (
            localStorage.getItem("loggedIn") === null &&
            localStorage.getItem("token") === null
        ) {
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
                                <div class="col-12 col-sm-6">
                                    <UsersStatus
                                        title="Admins"
                                        color="bg-teal"
                                        icon="fas fa-user-cog"
                                        role_id="1"
                                    />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <UsersStatus
                                        title="Operators"
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
                                        title="Waiting"
                                        color="bg-secondary"
                                        icon="fas fa-walking"
                                        status="1"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus
                                        title="Accepted"
                                        color="bg-primary"
                                        icon="fas fa-walking"
                                        status="2"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <VisitorsStatus
                                        title="Rejected"
                                        color="bg-danger"
                                        icon="fas fa-walking"
                                        status="3"
                                    />
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h4 class="px-2">Magnetic Door</h4>
                                    <MagneticDoor />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h4 class="px-2">Smoke Detector</h4>
                                    <SmokeDetector />
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="px-2">Temperature & Humidity</h4>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="6"
                                        element_id="th1"
                                        title="Upper Back"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="7"
                                        element_id="th2"
                                        title="Lower Back"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="8"
                                        element_id="th3"
                                        title="Lower Front"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="9"
                                        element_id="th4"
                                        title="Upper Front"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="10"
                                        element_id="th5"
                                        title="Front Top"
                                    />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <TemperatureHumidity
                                        sensor_id="11"
                                        element_id="th6"
                                        title="Back Top"
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
