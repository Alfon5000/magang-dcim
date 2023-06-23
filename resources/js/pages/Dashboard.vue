<script>
import Alerts from "../components/Alerts.vue";
// import MagneticDoor from "../components/Dashboard/MagneticDoor.vue";
// import TemperatureHumidity from "../components/Dashboard/TemperatureHumidity.vue";

export default {
    name: "Dashboard",
    components: {
        Alerts,
        // MagneticDoor,
        // TemperatureHumidity,
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
                            <!-- <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 1</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureOne />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 2</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureTwo />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 3</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureThree />
                    </div>
                  </div>
                </div>
              </div> -->
                            <!-- <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 4</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureFour />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 5</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureFive />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 6</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureSix />
                    </div>
                  </div>
                </div>
              </div> -->
                            <!-- <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 7</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureSeven />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 8</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureEight />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="card">
                    <div class="card-header text-center bg-navy">
                      <h5>Sensor 9</h5>
                    </div>
                    <div class="card-body">
                      <TemperatureHumidity
                        sensor-id="6"
                        element-id="temperature-one"
                      />
                    </div>
                  </div>
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
