<script>
import TemperatureTrendlines from "../components/Reports/TemperatureTrendlines.vue";
import HumidityTrendlines from "../components/Reports/HumidityTrendlines.vue";

export default {
    name: "Reports",
    components: {
        TemperatureTrendlines,
        HumidityTrendlines,
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
                <h4 class="pt-5">Temperature Trendlines</h4>
                <TemperatureTrendlines />
                <h4 class="pt-5">Humidity Trendlines</h4>
                <HumidityTrendlines />
            </div>
        </div>
    </div>
</template>
