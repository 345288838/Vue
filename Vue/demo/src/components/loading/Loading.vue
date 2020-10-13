<template>
    <div class="loading" v-show="isshow">
        <div class="loading-container">
            <div class="loading-item"></div>
            <div class="loading-item"></div>
            <div class="loading-item"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Loading",
        props:{
            isshow:{
                type:Boolean,
                default:false,
            }
        }
    }
</script>

<style scoped>
    .loading {
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        background-color: rgba(0, 0, 0, 0.2);
    }

    .loading-container {
        position: absolute;
        width: 50px;
        height: 10px;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        margin: auto;
    }

    .loading-item {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #606266;
        float: left;
        margin-right: 5px;
        animation: loading 1200ms infinite;
    }

    @keyframes loading {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    .loading-item:nth-child(1) {
        animation-delay: 0ms;
    }

    .loading-item:nth-child(2) {
        animation-delay: 400ms;
    }

    .loading-item:nth-child(3) {
        animation-delay: 800ms;
    }
</style>