<template>
    <div>
        <div class="footer">
            <router-link to="/" :class=" [index == 1?'active':'']" >
                <van-icon size="0.4rem" class="footer-item-icon" name="wap-home" color="#f1505f"/>
                <span>首页</span>
            </router-link>
            <router-link to="/list" :class=" [index == 2?'active':'']">
                <van-icon size="0.4rem" class="footer-item-icon" name="wap-nav" color="#f1505f"/>
                <span>更多</span>
            </router-link>
            <router-link to="/" :class=" [index == 3?'active':'']">
                <van-icon size="0.4rem" class="footer-item-icon" name="eye" color="#f1505f"/>
                <span>视界</span>
            </router-link>
            <router-link to="/user" :class=" [index == 4?'active':'']">
                <van-icon size="0.4rem" class="footer-item-icon" name="manager" color="#f1505f"/>
                <span>我的</span>
            </router-link>


        </div>
    </div>
</template>

<script>
    export default {
        name: "Tab",
        props:{
            index:{
                type:Number,
                default:1,
            }
        }
    }
</script>

<style scoped>
@import "../../style/tab.css";
</style>