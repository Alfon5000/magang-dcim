<script>
import TemperatureTrendlines from "../components/Reports/TemperatureTrendlines.vue";
import HumidityTrendlines from "../components/Reports/HumidityTrendlines.vue";
import MagneticDoorTrendlines from "../components/Reports/MagneticDoorTrendlines.vue";

export default {
    name: "Reports",
    components: {
        TemperatureTrendlines,
        HumidityTrendlines,
        MagneticDoorTrendlines,
    },
};
</script>

<template>
    <div class="wrapper">
        <Header />
        <Sidebar />
        <div class="content-wrapper px-3">
            <div class="content-header">
                <h2>Reports</h2>
            </div>
            <div class="content">
                <h4 class="mt-4 mb-2">Temperature Trendlines</h4>
                <TemperatureTrendlines />
                <h4 class="mt-4 mb-2">Humidity Trendlines</h4>
                <HumidityTrendlines />
                <h4 class="mt-4 mb-2">Magnetic Door Trendlines</h4>
                <MagneticDoorTrendlines />
            </div>
        </div>
    </div>
</template>
