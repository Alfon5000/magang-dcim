<script>
import TemperatureTrendlines from "../components/Reports/TemperatureTrendlines.vue";

export default {
    name: "Reports",
    components: {
        TemperatureTrendlines,
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
                <TemperatureTrendlines />
            </div>
        </div>
    </div>
</template>
