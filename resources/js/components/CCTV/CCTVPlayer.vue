<script>
export default {
    name: "CCTVPlayer",
    props: ["elementID", "streamUrl"],
    data() {
        return {
            elementID: this.elementID,
            streamURL: this.streamUrl,
        };
    },
    methods: {
        playCCTV() {
            const cctvElement = document.getElementById(this.elementID);
            const streamUrl = this.streamURL;
            cctvElement.src = streamUrl;
            cctvElement.onerror = () =>
                console.log("Error occurred while loading the stream.");
        },
    },
    mounted() {
        this.playCCTV();
    },
};
</script>

<template>
    <video :id="elementID"></video>
</template>
