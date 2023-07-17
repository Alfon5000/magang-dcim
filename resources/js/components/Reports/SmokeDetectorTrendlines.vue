<script>
import api from "../../api";

export default {
    name: "SmokeDetectorTrendlines",
    data() {
        return {
            year: new Date().getFullYear(),
            month: new Date().getMonth() + 1,
            years: [],
            months: [],
            tableData: [],
        };
    },
    methods: {
        async getAll() {
            await api
                .get("/smoke-detectors", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
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
        async getAggregate(year = this.year, month = this.month) {
            await api
                .get("/smoke-detectors/aggregate", {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                    params: {
                        year,
                        month,
                    },
                })
                .then((response) => {
                    this.tableData = response.data.data.map((td) => {
                        return [td.day, td.count];
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
            data.addColumn("number", "Smoky");

            data.addRows(this.tableData);

            const options = {
                chart: {
                    curveType: "function",
                },
            };

            const chart = new google.charts.Line(
                document.getElementById("smoke_detector_trendlines")
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
                    return "November";
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
    <div class="card p-3">
        <div class="card-header">
            <form @submit.prevent="drawChart()">
                <div class="row">
                    <div class="col text-center">
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
                    <div class="col text-center">
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
                    <div class="col text-center">
                        <label>Filter</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="smoke_detector_trendlines"></div>
        </div>
    </div>
</template>
