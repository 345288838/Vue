<template>
    <div>
        <div class="swiper-container">

            <van-swipe class="swiper-wrapper" :autoplay="3000" indicator-color="white">

                <van-swipe-item v-for="(item,index) in banner" :key="index">
                    <router-link :to="{name:'detail',query:{sid:item.sid}}">
                        <img :src="IMGURL+item.sthumb" alt="">
                    </router-link>
                </van-swipe-item>
            </van-swipe>

            <div class="search">
                <img src="../../assets/img/搜索.png" alt="">
            </div>
        </div>


        <div class="area">
            <div class="search-area">
                <div class="search-area-left">
                    <router-link to="/province"><span style="color: #ed7a7e;">{{indexSearch.province}}</span>
                    </router-link>
                </div>
                <div class="search-area-middle">
                    <input type="text" name="" id="" placeholder="景点 地址 关键字">
                </div>
                <div class="search-area-right">
                    <img src="../../assets/img/position.png" alt="" style="width: 80px">
                </div>
            </div>

            <div class="time-area">
                <router-link class="time-area index-time" to="/calendar" tag="div">
                    <div class="time-day"><span>{{indexSearch.startTime}}</span></div>
                    <div class="week-day"><span>{{indexSearch.startDay}}</span></div>
                    <div class="toright"><img src="../../assets/img/箭头_切换向上.png" alt=""></div>
                    <div class="time-tomorrow"><span>{{indexSearch.endTime}}</span></div>
                    <div class="week-tomorrow"><span>{{indexSearch.endDay}}</span></div>
                </router-link>
                <div class="time-area-day"><span>共一晚</span></div>
            </div>
            <div class="now-search">
                <button @click="search"><span style="font-size: 0.3rem; letter-spacing: 2px;">立即查找</span>
                </button>
            </div>

            <div class="trust">
                <div class="moneybag"><img src="../../assets/img/moneybag.jpg" alt=""><span>信用免押金</span></div>
                <div class="music"><img src="../../assets/img/music.jpg" alt=""><span>24小时客服</span></div>
                <div class="protect"><img src="../../assets/img/protect.jpg" alt=""><span>房源房东认证</span></div>
            </div>
        </div>


        <!-- 优选PRO开始 -->

        <div class="con" v-if="category.length">

            <div class="introduce" style="margin-top: 240px">
                <div class="introduce-title">
                    <span>{{category[0].cname.substring(0,2)}}</span><span>{{category[0].cname.substring(2,3)}}</span><span>{{category[0].cname.substring(3,5)}}</span>
                </div>
                <div class="introduce-text" >{{category[0].cdesc}}</div>
                <van-swipe :show-indicators="false">
                    <van-swipe-item class="pro-item" v-for="(item,index) in pro" :key="index">
                        <router-link :to="{name:'detail',query:{sid:item.sid}}">
                            <img :src="IMGURL+item.sthumb" alt="">
                            <span class="pro-item-name hidden">{{item.sname}}</span>
                            <div class="pro-item-core">
                                <div class="pro-star-container clear-fix">
                                    <div class="pro-star " v-for="(star,index) in item.score" :key="index+1">
                                        <van-image :src="icon.star"></van-image>
                                    </div>
                                    <div class="pro-star " v-for="(star,index) in (5 - item.score)" :key="index">
                                        <van-image :src="icon.star_dim"></van-image>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-item-area">
                                <span class="pro-city">{{item.scity}}</span>
                                <span>.</span>
                                <span class="pro-area">{{item.sarea}}</span>
                            </div>
                            <div class="pro-item-price">
                                <span class="pro-rmb">RMB</span>
                                <span class="pro-price">{{item.sprice}}</span>
                            </div>
                        </router-link>
                    </van-swipe-item>
                </van-swipe>
            </div>

            <div class="sleep">
                <div class="introduce-title">
                    <span>{{category[1].cname.substring(0,3)}}</span><span>{{category[1].cname.substring(3,4)}}</span>
                </div>
                <div class="introduce-text">{{category[1].cdesc}}</div>
                <van-swipe :show-indicators="false">
                    <van-swipe-item class="sleep-item" v-for="(item,index) in sleepform" :key="index">
                        <router-link :to="{name:'detail',query:{sid:item.sid}}">
                            <div class="sleep-item-img">
                                <img :src="IMGURL+item.sthumb" alt="">
                            </div>
                            <div class="sleep-item-title">
                                <span>{{item.sname}}</span><br>
                                <span class="hidden" style="width: 90%">{{item.sdesc}}</span>
                            </div>
                            <div class="sleep-item-tag">
                                <div class="sleep-tag" v-for="(value,index) in item.stag.split(/,|，/)" :key="index">
                                    {{value}}
                                </div>
                            </div>
                        </router-link>
                    </van-swipe-item>
                </van-swipe>
            </div>

            <div class="say">
                <div class="introduce-title">
                    <span>{{category[3].cname.substring(0,3)}}</span><span>{{category[3].cname.substring(3,4)}}</span>
                </div>
                <div class="introduce-text" >{{category[3].cdesc}}</div>

                <router-link :to="{name:'detail',query:{sid:say.sid}}" tag="div" class="say-con">
                    <div class="say-con-img">
                        <img :src="IMGURL+say.sthumb" alt="">
                    </div>
                    <div class="say-con-text">
                        <!--                        <div class="say-con-hot">hot</div>-->
                        <div class="hidden say-text-span">
                            <div class="say-con-hot">hot</div>
                            <span>{{say.sname}}</span>
                        </div>
                        <span class="say-text-desc">{{say.sdesc}}</span>
                    </div>
                </router-link>
            </div>

            <div class="look">
                <div class="introduce-title">
                    <span>{{category[2].cname.substring(0,3)}}</span><span>{{category[2].cname.substring(3,4)}}</span>
                </div>
                <div class="introduce-text" >{{category[2].cdesc}}</div>
                <div class="swiper-container1">
                    <router-link :to="{name:'detail',query:{sid:item.sid}}" tag="div" class="look-item"
                                 v-for="(item,index) in lookform"
                                 :key="index">
                        <div class="look-item-img">
                            <img  :src="IMGURL+item.sthumb" alt="">
                        </div>
                        <div class="heart">
                            <img src="../../assets/img/heart.png" alt="" style="width: 20px; height: 20px;">
                        </div>
                        <div class="look-item-name">{{item.sname}}</div>
                        <div
                                class="look-item-area hidden">{{item.scity}}.{{item.sarea}}
                        </div>
                        <div class="look-item-core">
                            <div class="look-star-container clear-fix">
                                <div class="look-star " v-for="(star,index) in item.score" :key="index+1">
                                    <van-image :src="icon.star"></van-image>
                                </div>
                                <div class="look-star " v-for="(star,index) in (5 - item.score)" :key="index">
                                    <van-image :src="icon.star_dim"></van-image>
                                </div>
                            </div>
                        </div>
                        <div class="look-item-price">
                            <span class="look-RMB">RMB</span>
                            <span class="look-price">{{item.sprice}}</span>
                            <span class="look-item-everynight">每晚</span>
                        </div>
                    </router-link>
                    <div class="clear"></div>
                </div>
            </div>
            <!--不得不看结束-->
        </div>
        <Tab :index="1"></Tab>

    </div>
</template>


<script>
    import {index} from "../../http";
    import {IMGURL} from "../../lib/base";
    import Tab from "../tab/Tab";
    import star from '@/assets/img/star.png';
    import star_dim from '@/assets/img/star-dim.png';

    export default {
        name: "index",
        data() {
            return {
                banner: [],
                category: [],
                pro: [],
                sleepform: [],
                lookform: [],
                say: {},
                IMGURL,
                current: 0,
                icon: {
                    star,
                    star_dim
                }
            }
        },
        components: {
            Tab
        },
        computed: {
            indexSearch() {
                return this.$store.state.indexSearch;
            }

        },
        methods: {
            initSearch() {
                this.$store.dispatch('setTime');
                this.$store.dispatch('setProvince', '山西');
                index().then(res => {
                    this.banner = res.data.banner;
                    this.category = res.data.category;
                    this.sleepform = res.data.category[1].children;
                    let pro = res.data.category[0].children;
                    pro.map(ele => {
                        ele.score = Math.floor(ele.score);
                        return ele;
                    })
                    this.pro = pro;
                    let lookform = res.data.category[2].children;
                    lookform.map(ele => {
                        ele.score = Math.floor(ele.score);
                        return ele;
                    })
                    this.lookform = lookform;
                    this.say = res.data.category[3].children[0];
                }).catch((error) => {
                    console.log(error);
                })
            },
            search(){

            }

        },
        mounted() {
            this.initSearch();
        }
    }
</script>


<style scoped lang="sass">
    @import "../../style/index.css"
</style>