<script>
import api from "../../api";

export default {
    name: "OverallTrend",
    data() {
        return {
            temperatureHumidities: [],
            tableData: [],
        };
    },
    methods: {
        async getAvg() {
            await api
                .get("/temperature-humidities/avg")
                .then((response) => {
                    this.temperatureHumidities = response.data.data;
                    this.tableData = this.temperatureHumidities.map((data) => {
                        return [data.date, data.temperature, data.humidity];
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getMin() {
            await api
                .get("/temperature-humidities/min")
                .then((response) => {
                    this.temperatureHumidities = response.data.data;
                    this.tableData = this.temperatureHumidities.map((data) => {
                        return [data.date, data.temperature, data.humidity];
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getMax() {
            await api
                .get("/temperature-humidities/max")
                .then((response) => {
                    this.temperatureHumidities = response.data.data;
                    this.tableData = this.temperatureHumidities.map((data) => {
                        return [data.date, data.temperature, data.humidity];
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async drawChart() {
            await this.getAvg();
            await this.getMin();
            await this.getMax();

            const data = new google.visualization.DataTable();
            data.addColumn("date", "Date");
            data.addColumn("number", "Temperature");
            data.addColumn("number", "Humidity");

            data.addRows(this.tableData);

            const options = {
                chart: {
                    title: "Overall Trend",
                },
            };

            const chart = new google.charts.Line(
                document.getElementById("overall")
            );

            chart.draw(data, google.charts.Line.convertOptions(options));
        },
    },
    mounted() {
        google.charts
            .load("current", { packages: ["line"] })
            .then(this.drawChart);
    },
};
</script>

<template>
    <div id="overall"></div>
</template>
