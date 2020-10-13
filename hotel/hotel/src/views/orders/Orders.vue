<template>
    <div class="orders-con">
        <header>
            <div class="orders-back">
                <i class="iconfont icon-left"></i>
            </div>
            <div class="orders-title">
                <span>订单填写</span>
            </div>
        </header>
        <div class="orders-card">
            <van-card
                    price="2.00"
                    desc="描述信息"
                    title="商品标题"
                    thumb="https://img.yzcdn.cn/vant/ipad.jpeg"
            >
                <template #tags>
                    <van-tag plain type="danger">标签</van-tag>
                    <van-tag plain type="danger">标签</van-tag>
                </template>
            </van-card>
        </div>

        <div class="orders-list">
            <van-list>
                <van-cell>
                    <div class="order-list-date">
                        <div class="date-line1">
                            <span>入离日期</span>
                            <span>修改日期<i class="iconfont icon-xiangyou"></i></span>
                        </div>
                        <div class="date-line2">

                        </div>
                    </div>
                </van-cell>
                <van-cell>
                    <div class="orders-pernum">
                        <span>入住人数</span>
                        <span><i class="iconfont icon-wuuiconsuoxiao"></i> 1人 <i class="iconfont icon-jia"></i></span>
                    </div>
                </van-cell>
                <van-cell>
                    <div class="orders-perinfo">
                        <div class="perinfo-title">
                            <span>住客信息</span>
                            <span>添加/编辑</span>
                        </div>
                        <div class="perinfo-body">

                        </div>
                    </div>
                </van-cell>
                <van-cell>
                    <div class="orders-relate">
                        <span>联系方式 <span>+86</span></span>
                        <span>132555555555</span>
                    </div>
                </van-cell>
                <van-cell>
                    <div class="orders-price">
                        <span>房费</span>
                        <span>197.00</span>
                    </div>
                </van-cell>
                <van-cell>
                    <div class="orders-plant">
                        <span>平台优惠</span>
                        <span><span>立减</span>39.00</span>
                    </div>
                </van-cell>
            </van-list>

            <div class="orders-end-price">
                <span>本单需付<span>￥158.00</span></span>
                <span>已享受最大优惠组合 共省<span>￥39.00</span></span>
            </div>

            <div class="orders-info">
                <div class="orders-info-item">
                    <span>退订政策</span>
                    <span>入住前1天12:00前退订 可获得100%退款 之后退订不退款</span>
                </div>
                <div class="orders-info-item">
                    <span>入离时间</span>
                    <span>14:00之后可入住 12:00之前需退房</span>
                </div>
                <div class="orders-info-item">
                    <span>提供发票</span>
                    <span>不支持开发票 如果需要请与房东协商</span>
                </div>

            </div>
        </div>
        <footer>
            <div class="footer-icon">
                <i class="iconfont icon-liaotianshezhi"></i>
            </div>
            <div class="footer-price">
                <span>158.00</span>
                <div class="footer-button">提交订单</div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "Orders",
        data(){

        }
    }
</script>

<style scoped>
    @import "../../style/orders.css";

</style>