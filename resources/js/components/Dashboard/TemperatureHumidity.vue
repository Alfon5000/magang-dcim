<script>
import api from "../../api";

export default {
    name: "TemperatureHumidity",
    props: ["sensor_id", "element_id", "title"],
    data() {
        return {
            sensorId: this.sensor_id,
            elementId: this.element_id,
            temperature: 0,
            humidity: 0,
        };
    },
    methods: {
        async readData() {
            await api
                .get(`temperature-humidity/${this.sensorId}`)
                .then((response) => {
                    this.temperature = response.data.data.temperature;
                    this.humidity = response.data.data.humidity;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        drawChart() {
            const data = google.visualization.arrayToDataTable([
                ["Label", "Value"],
                ["Temp (°C)", this.temperature],
                ["Hum (%)", this.humidity],
            ]);

            const options = {
                greenFrom: 0,
                greenTo: 35,
                yellowFrom: 36,
                yellowTo: 70,
                redFrom: 71,
                redTo: 100,
            };

            const chart = new google.visualization.Gauge(
                document.getElementById(this.elementId)
            );

            chart.draw(data, options);

            setInterval(() => {
                this.readData();
                data.setValue(0, 1, this.temperature);
                data.setValue(1, 1, this.humidity);
                chart.draw(data, options);
            }, 2000);
        },
    },
    mounted() {
        google.charts
            .load("current", { packages: ["gauge"] })
            .then(this.drawChart);
    },
};
</script>

<template>
    <div class="card">
        <div class="card-header text-center bg-navy">
            <h5>{{ title }}</h5>
        </div>
        <div class="card-body">
            <div :id="elementId"></div>
        </div>
    </div>
</template>
