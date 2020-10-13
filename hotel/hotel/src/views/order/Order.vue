<template>
    <div style="padding:0 0.48rem 1rem">
        <div class="header">

            <div class="title">
                <div class="order-back" @click="toback">
                    <img src="../../assets/img/user-back.png" alt="">
                </div>
                <span>全部订单</span>
            </div>
            <div class="search">
                <input type="text" placeholder=" 关键词 名称 地点">
                <img src="../../assets/img/search.png" alt="">
            </div>
            <div class="search-btn">
                <ul>
                    <li>
                        <div class="btn active">
                            <div class="circle"></div>
                            全部
                        </div>
                    </li>
                    <li>
                        <div class="btn">
                            <div class="circle"></div>
                            待付
                        </div>
                    </li>
                    <li>
                        <div class="btn">
                            <div class="circle"></div>
                            已付
                        </div>
                    </li>
                    <li>
                        <div class="btn">
                            <div class="circle"></div>
                            退款
                        </div>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
        </div>
        <div class="list">
            <ul>
                <li>
                    <div class="item" style="background-image: url(../../assets/img/list1.png);background-size: 100%;">
                        <div class="time">
                            <span class="date">4.19</span>
                            <span class="week">SUN</span>
                            <div class="arrow">
                                <img src="../../assets/img/arrow.png" alt="">
                            </div>
                            <span class="date" style="left: 2.86rem;">4.20</span>
                            <span class="week" style="left: 4.02rem;">SUN</span>
                            <span class="status">待付款</span>
                        </div>
                        <div class="info">
                            <span class="stname">森岚民宿</span>
                            <span class="RMB">RMB</span>
                            <span class="price">158.00</span>
                            <div class="line"></div>
                            <div class="cancelbtn">
                                <span>取消订单</span>
                            </div>
                            <div class="enterbtn">
                                <span>立即付款</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="margin:0.47rem 0">
                    <div class="item" style="background-image: url(../../assets/img/list2.png);background-size: 100%;">
                        <div class="time">
                            <span class="date">3.15</span>
                            <span class="week">SUN</span>
                            <div class="arrow">
                                <img src="../../assets/img/arrow.png" alt="">
                            </div>
                            <span class="date" style="left: 2.86rem;">3.17</span>
                            <span class="week" style="left: 4.02rem;">SUN</span>
                            <span class="status">已付款</span>
                        </div>
                        <div class="info">
                            <span class="stname">隐海小院</span>
                            <span class="RMB">RMB</span>
                            <span class="price">285.00</span>
                            <div class="line"></div>
                            <div class="cancelbtn">
                                <span>取消订单</span>
                            </div>
                            <div class="enterbtn">
                                <span>立即付款</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item" style="background-image: url(../../assets/img/list3.png);background-size: 100%;">
                        <div class="time">
                            <span class="date">2.16</span>
                            <span class="week">SUN</span>
                            <div class="arrow">
                                <img src="../../assets/img/arrow.png" alt="">
                            </div>
                            <span class="date" style="left: 2.86rem;">2.17</span>
                            <span class="week" style="left: 4.02rem;">SUN</span>
                            <span class="status">已付款</span>
                        </div>
                        <div class="info">
                            <span class="stname">我和猫的故事</span>
                            <span class="RMB">RMB</span>
                            <span class="price">195.00</span>
                            <div class="line"></div>
                            <div class="cancelbtn">
                                <span>取消订单</span>
                            </div>
                            <div class="enterbtn">
                                <span>立即付款</span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Order",
        methods:{
            toback(){
                this.$router.back();
            }
        }
    }
</script>

<style scoped>
    @import "../../style/order.css";
</style>