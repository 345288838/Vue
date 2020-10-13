<template>
    <div>
        <div class="list-con">
            <ul class="list-nav">
                <li v-for="(item,index) in orderArr" :key="index" :class="{active:order.field===item.field} "
                    @click="handlerOrder(item.field)">{{item.text}}<i :class="['iconfont',item.icon
            ]"></i></li>
            </ul>
            <div class="list">
                <van-pull-refresh v-model="isPullrefresh" @refresh="handlerPullrefresh">
                    <van-list v-model="isUpper" :finished="upperFinished" :immediate-check="false" @load="handlerUpper">
                        <div class="list-list">
                            <router-link :to="{name:'detail',query:{sid:item.sid}}" tag="div" class="list-list-item"
                                         v-for="(item,index) in stayhome" :key="index">
                                <div class="list-item-img">
                                    <img :src="item.sthumb" alt="">
                                </div>
                                <div class="list-item-text">
                                    <div class="hidden">{{item.sname}}</div>
                                    <div class="hidden">{{item.scity}}·{{item.sarea}}</div>
                                </div>
                                <div class="list-item-star">
                                    <div class="list-star" v-for="(star,index) in item.score" :key="index+1">
                                        <img :src="icon.star" alt="">
                                    </div>
                                    <div class="list-star" v-for="(star,index) in (5 - item.score)" :key="index">
                                        <img :src="icon.star_dim" alt="">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="list-item-price">
                                    <div class="list-RMB">RMB</div>
                                    <div class="list-price">{{item.sprice}}</div>
                                    <div class="list-every">每晚</div>
                                    <div class="clear"></div>
                                </div>
                            </router-link>
                            <div class="clear"></div>
                        </div>
                    </van-list>
                </van-pull-refresh>
            </div>
        </div>
        <tab :index="2"></tab>
    </div>
</template>

<script>
    import {list} from "../../http";
    import {IMGURL} from "../../lib/base";
    import {Toast} from 'vant';
    import star from '@/assets/img/star.png';
    import star_dim from '@/assets/img/star-dim.png';
    import Tab from "../tab/Tab";

    export default {

        name: "List",
        components: {
            Tab
        },

        data() {
            return {
                orderArr: [
                    {text: '综合', icon: "icon-xiajiantou", field: 'sid'},
                    {text: '位置', icon: "icon-xiajiantou", field: 'score'},
                    {text: '时间', icon: "icon-xiajiantou", field: 'ctime'},
                    {text: '价格', icon: "icon-xiajiantou", field: 'sprice'},
                ],
                icon: {
                    star,
                    star_dim
                },
                isPullrefresh: false,
                isUpper: false,
                upperFinished: false,
                paginate: {
                    page: 0,
                    limit: 8
                },
                // 综合 sid , 位置score  时间 ctime 价格 sprice
                order: {
                    field: 'sid',
                    type: 'desc'
                },
                stayhome: [],
                total: 0
            }
        },
        methods: {
            handlerPullrefresh() {
                this.upperFinished = false;
                this.paginate.page = 0;
                this.stayhome = [];
                this.total = 0;
                this.handlerUpper();
                Toast({
                    message: '刷新成功 '
                })
                this.isPullrefresh = false;
            },
            handlerUpper() {
                this.paginate.page++;
                let params = Object.assign({}, this.paginate, this.order)
                list(params).then(res => {
                    if (res.data) {
                        !this.total && (this.total = res.total);
                        let data = res.data.map(ele => {
                            ele.sthumb = IMGURL + ele.sthumb;
                            ele.score = Math.floor(ele.score);
                            return ele;
                        })
                        this.stayhome = this.stayhome.concat(data);
                        if (this.stayhome.length >= res.total) {
                            this.upperFinished = true;
                        }
                    } else {
                        Toast({
                            message: '暂无数据'
                        })

                    }
                    this.isUpper = false;
                }).catch(error => {
                    console.log(error);
                })
            },
            handlerOrder(field) {
                this.order.field = field;
                this.upperFinished = false;
                this.paginate.page = 0;
                this.stayhome = [];
                this.total = 0;
                this.handlerUpper();
            }
        },
        mounted() {
            this.handlerUpper()
        }
    }
</script>

<style scoped>
    @import url('../../style/list.css');
</style>