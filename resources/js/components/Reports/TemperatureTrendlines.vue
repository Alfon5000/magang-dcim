<script>
import api from "../../api";

export default {
    name: "TemperatureTrendlines",
    data() {
        return {
            id: 6,
            year: new Date().getFullYear(),
            month: new Date().getMonth() + 1,
            ids: [],
            years: [],
            months: [],
            tableData: [],
        };
    },
    methods: {
        async getAll() {
            await api
                .get("/temperature-humidities")
                .then((response) => {
                    this.ids = response.data.sensor_id.map((id) => {
                        return id.sensor_id;
                    });

                    this.years = response.data.years.map((year) => {
                        return year.year;
                    });

                    this.months = response.data.months.map((month) => {
                        return month.month;
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async getAggregate(id = this.id, year = this.year, month = this.month) {
            await api
                .get("/temperature-humidities/temperature-aggregate", {
                    params: {
                        id,
                        year,
                        month,
                    },
                })
                .then((response) => {
                    this.tableData = response.data.data.map((td) => {
                        return [td.day, td.min, td.max, td.avg];
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async drawChart() {
            await this.getAggregate();

            const data = new google.visualization.DataTable();
            data.addColumn("number", "Day");
            data.addColumn("number", "Min");
            data.addColumn("number", "Max");
            data.addColumn("number", "Avg");

            data.addRows(this.tableData);

            const options = {
                chart: {
                    title: "Temperature Trendlines",
                    curveType: "function",
                },
            };

            const chart = new google.charts.Line(
                document.getElementById("temperature_trendlines")
            );

            chart.draw(data, google.charts.Line.convertOptions(options));
        },
        convertNumberToMonth(number) {
            switch (number) {
                case 1:
                    return "January";
                case 2:
                    return "February";
                case 3:
                    return "March";
                case 4:
                    return "April";
                case 5:
                    return "May";
                case 6:
                    return "June";
                case 7:
                    return "July";
                case 8:
                    return "August";
                case 9:
                    return "September";
                case 10:
                    return "October";
                case 11:
                    return "Nopember";
                case 12:
                    return "December";
            }
        },
    },
    mounted() {
        this.getAll();

        google.charts
            .load("current", { packages: ["line"] })
            .then(this.drawChart);
    },
};
</script>

<template>
    <div class="card">
        <div class="card-header">
            <form @click.prevent="drawChart()">
                <div class="row">
                    <div class="col">
                        <label for="id">Sensor ID</label>
                        <select class="form-control" id="id" v-model="id">
                            <option
                                :value="id"
                                v-for="(id, index) in ids"
                                :key="index"
                            >
                                {{ id }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="year">Year</label>
                        <select class="form-control" id="year" v-model="year">
                            <option
                                :value="year"
                                v-for="(year, index) in years"
                                :key="index"
                            >
                                {{ year }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="month">Month</label>
                        <select class="form-control" id="month" v-model="month">
                            <option
                                :value="month"
                                v-for="(month, index) in months"
                                :key="index"
                            >
                                {{ convertNumberToMonth(month) }}
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="temperature_trendlines"></div>
        </div>
    </div>
</template>
