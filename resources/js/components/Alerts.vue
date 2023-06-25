<script>
export default {
    name: "Alerts",
    methods: {
        updateTime() {
            const dateElement = document.getElementById("date");
            const timeElement = document.getElementById("time");

            const dateTime = new Date();

            const date = dateTime.toLocaleDateString(undefined, {
                weekday: "short",
                year: "numeric",
                month: "short",
                day: "numeric",
            });

            const time = dateTime.toLocaleTimeString();

            dateElement.innerText = date;
            timeElement.innerText = time;
        },
    },
    mounted() {
        setInterval(this.updateTime, 1000);
    },
};
</script>

<template>
    <div class="container-fluid">
        <div class="container-fluid my-3">
            <div id="datetime-widget">
                <div id="time"></div>
                <div id="date"></div>
            </div>
        </div>
        <hr class="bg-light" />
        <div class="container-fluid my-3">
            <h5 class="text-center mb-3">Alerts</h5>
            <div class="card" style="height: 250px">
                <div class="card-header bg-danger text-center">Important</div>
                <div class="card-body text-danger overflow-auto">
                    <p>Important 1</p>
                    <hr class="bg-danger" />
                    <p>Important 2</p>
                    <hr class="bg-danger" />
                    <p>Important 3</p>
                    <hr class="bg-danger" />
                    <p>Important 4</p>
                    <hr class="bg-danger" />
                    <p>Important 5</p>
                </div>
            </div>
            <div class="card" style="height: 250px">
                <div class="card-header bg-warning text-center">Warning</div>
                <div class="card-body text-warning overflow-auto">
                    <p>Warning 1</p>
                    <hr class="bg-warning" />
                    <p>Warning 2</p>
                    <hr class="bg-warning" />
                    <p>Warning 3</p>
                    <hr class="bg-warning" />
                    <p>Warning 4</p>
                    <hr class="bg-warning" />
                    <p>Warning 5</p>
                </div>
            </div>
            <div class="card" style="height: 250px">
                <div class="card-header bg-info text-center">Informational</div>
                <div class="card-body text-info overflow-auto">
                    <p>Informational 1</p>
                    <hr class="bg-info" />
                    <p>Informational 2</p>
                    <hr class="bg-info" />
                    <p>Informational 3</p>
                    <hr class="bg-info" />
                    <p>Informational 4</p>
                    <hr class="bg-info" />
                    <p>Informational 5</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#datetime-widget {
    width: 100%;
    text-align: center;
}

#time {
    font-size: 20px;
    font-weight: bold;
}

#date {
    font-size: 14px;
}
</style>
