<template>
    <div v-if="person">
        <div class="header">
            <div class="avatar">
                <img :src="IMGURL+person.avatar" alt="">
            </div>
            <div class="uname">
                <span>{{person.nickname}}</span>
            </div>
            <div class="vipcenter">
                <div class="viplogo">
                    <img src="../../assets/img/viplogo.png" alt="">
                </div>
                <span class="viptitle">会员中心</span>
                <a href="" class="vipname">
                    <img src="../../assets/img/go.png" alt="">
                    <span>五品小主</span>
                </a>
            </div>
            <div class="info">
                <a href="">
                    <img src="../../assets/img/info.png" alt="">
                </a>
            </div>
        </div>
        <!-- 我的订单开始 -->
        <div class="order">
            <div class="ordertitle">
                <span>我的订单</span>
            </div>
            <div class="line"></div>
            <div class="view" @click="toorder">
                <img src="../../assets/img/goon.png" alt="">
                <span>查看全部订单</span>
            </div>
            <div class="ordermenu">
                <ul>
                    <li>
                        <img src="../../assets/img/done.png" alt="">
                        <div class="orderbtn">
                            <span>已完成</span>
                        </div>
                    </li>
                    <li>
                        <img src="../../assets/img/pay.png" alt="">
                        <div class="orderbtn">
                            <span>待付款</span>
                        </div>
                    </li>
                    <li>
                        <img src="../../assets/img/live.png" alt="">
                        <div class="orderbtn">
                            <span>待入住</span>
                        </div>
                    </li>
                    <li>
                        <img src="../../assets/img/refund.png" alt="">
                        <div class="orderbtn">
                            <span>退款</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 菜单页开始 -->
        <div class="menu">
            <ul>
                <li>
                    <img src="../../assets/img/circle.png" alt="">
                    <span>红包</span>
                    <img src="../../assets/img/goon.png" alt="" style="margin-left: 6.26rem;">
                </li>
                <li>
                    <img src="../../assets/img/circle.png" alt="">
                    <span>设置</span>
                    <img src="../../assets/img/goon.png" alt="" style="margin-left: 6.26rem;">
                </li>
                <li>
                    <router-link to="/collection">
                        <img src="../../assets/img/circle.png" alt="">
                        <span>我的收藏</span>
                        <img src="../../assets/img/goon.png" alt="" style="margin-left: 6.26rem;">
                    </router-link>
                </li>
                <li>
                    <img src="../../assets/img/circle.png" alt="">
                    <span>积分商城</span>
                    <img src="../../assets/img/goon.png" alt="" style="margin-left: 6.26rem;">
                </li>
                <li>
                    <img src="../../assets/img/circle.png" alt="">
                    <span>帮助与反馈</span>
                    <img src="../../assets/img/goon.png" alt="" style="margin-left: 6.26rem;">
                </li>
            </ul>
        </div>
        <!-- 提交按钮开始 -->
        <div class="btn-con">
            <div class="btn">
                <span>成为房东</span>
            </div>
        </div>
        <!-- 底部开始 -->
        <tab :index="4"></tab>
    </div>
</template>

<script>
    import Tab from "../tab/Tab";
    import {user} from "../../http";
    import {IMGURL} from "../../lib/base";

    export default {
        name: "User",
        components: {
            Tab
        },
        data() {
            return {
                person: null,
                IMGURL
            }
        },
        methods: {
            toorder() {
                this.$router.push({path: '/order'})
            },
            initUser() {
                user().then(res => {
                    this.person = res.data;
                }).catch(error => {
                    console.log(error);
                })
            }

        },
        mounted() {
            this.initUser();
        }
    }
</script>

<style scoped>
    @import "../../style/user.css";
</style>