<script>
import OverallTrend from "../components/Reports/OverallTrend.vue";

export default {
    name: "Reports",
    components: {
        OverallTrend,
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
                <OverallTrend />
            </div>
        </div>
    </div>
</template>
