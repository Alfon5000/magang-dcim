<script>
import api from "../../api";

export default {
    name: "OverallTrend",
    data() {
        return {
            temperatureHumidities: [],
            tableData: [],
            year: new Date().getFullYear(),
            month: new Date().getMonth() + 1,
        };
    },
    methods: {
        async getAggregate(year = this.year, month = this.month) {
            await api
                .get("/temperature-humidities/aggregate", {
                    params: {
                        year,
                        month,
                    },
                })
                .then((response) => {
                    this.temperatureHumidities = response.data.data.avg;
                    this.tableData = this.temperatureHumidities.map((data) => {
                        return [
                            data.date.toString(),
                            data.temperature,
                            data.humidity,
                        ];
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async drawChart() {
            await this.getAggregate();

            const data = new google.visualization.DataTable();
            data.addColumn("string", "Date");
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
