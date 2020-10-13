<template>
    <div>
        <div class="collection-title">
            <van-nav-bar
                    title="我的收藏"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <div class="collection-con" v-if="collection.length">

            <router-link :to="{name:'detail',query:{sid:item.sid}}" tag="div" class="collection-item" v-for="(item,index) in collection" :key="index">
                <van-card
                        :price="item.sprice"
                        :desc="item.sdesc"
                        :title="item.sname"
                        :thumb="item.sthumb"
                >
                    <template #tags>
                        <van-tag plain type="danger" v-for="(item,index) in item.stag" :key="index">{{item}}</van-tag>
                    </template>
                </van-card>
            </router-link>
        </div>
    </div>
</template>

<script>
    import {getCollection} from "../../http";
    import {IMGURL} from "../../lib/base";

    export default {
        name: "Collection",
        data() {
            return {
                collection: [],
                IMGURL
            }
        },
        methods: {
            onClickLeft() {
                this.$router.back();
            },
            initCollections() {
                getCollection().then(res => {
                    let collection = res.data;
                    collection.map(ele => {
                        ele.sthumb = IMGURL + ele.sthumb;
                        ele.stag = ele.stag.split(/,|，/);
                        return ele;
                    });
                    this.collection = collection;
                }).catch(error => {
                    console.log(error);
                })
            }

        },
        mounted() {
            this.initCollections();
        }

    }
</script>

<style scoped>
    .collection-item {
        text-align: left;
        margin-bottom: 10px;
    }

    .collection-con {
        margin-top: 20px;
    }

</style>