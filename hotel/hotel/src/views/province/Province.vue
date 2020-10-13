<template>
    <div>


        <div v-for="item in provinceKeys" :key="item">
            <van-index-bar>
                <van-index-anchor>{{item}}</van-index-anchor>
                <ul>
                    <li v-for="(city,index) in province[item]" :key="index" @click="handleProvince(city.province)">
                        <van-cell-group>
                            <van-cell>{{city.province}}</van-cell>
                        </van-cell-group>

                    </li>
                </ul>
            </van-index-bar>
        </div>
    </div>
</template>

<script>
    import city from '../../lib/city.json';

    export default {
        name: "Province",
        data() {
            return {
                province: {},
            }
        },
        computed: {
            provinceKeys() {
                let arr = [];
                if (JSON.stringify(this.province) != '{}') {
                    arr = Object.keys(this.province).sort();
                }
                return arr;
            }
        },
        methods: {
            initProvince() {
                city.province.forEach(ele => {
                    let firstChar = ele.enp.charAt(0).toUpperCase();
                    if (!this.province[firstChar]) {
                        this.$set(this.province, firstChar, []);
                    }
                    this.province[firstChar].push(ele);
                })
            },
            handleProvince(province) {
                this.$store.commit('setProvince',province);
                this.$router.back();
            }
        },
        mounted() {
            this.initProvince();
        }
    }
</script>

<style scoped>

</style>