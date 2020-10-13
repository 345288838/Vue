<template>
    <div>
        <div class="back">
            <span class="title1">远方 即 故乡</span>
            <span class="title2">WELCOME HOME</span>
            <span class="title3">小主 等你好久了</span>
        </div>
        <div class="con">
            <div class="login">
                <van-form  @submit="handelSubmit">
                    <div class="inputNum">
                        <div class="inputImg">
                            <i class="iconfont icon-shouji" ></i>
                        </div>
                        <van-field
                                v-model="Logform.phone"
                                class="num"
                                name="phone"
                                autocomplete="off"
                                placeholder="小主，留个电话吧"
                                :rules="[{ validator, message: '请输入正确的手机号' }]"
                        />
<!--                        <input type="text" class="num" placeholder="小主，留个电话吧" autocomplete="off" v-model="Logform.phone">-->
                    </div>
                    <div style="width: 100%">
                        <div class="inputPass">
                            <div class="inputImg">
                                <i class="iconfont icon-suo" ></i>
                            </div>
                            <van-field
                                    v-model="code"
                                    class="pass"
                                    name="pass"
                                    placeholder="我们的秘密"
                                    :rules="[{ required: true, message: '请填写密码' }]"
                            />

                        </div>
                        <!-- <input type="button" value="获取秘密" class="sub"> -->
                        <van-button native-type="button" class="sub" @click="getCode" v-show="!time">获取秘密</van-button>
                        <van-button native-type="button" class="sub sub-time" v-show="time">{{this.time}}s</van-button>
                        <div class="clear"></div>
                    </div>
                    <div class="toreg">
                        <span>没有账号,请  <router-link to="/reg">注册</router-link></span>
                    </div>
                    <van-button native-type="submit" class="logbtn">欢迎回家</van-button>
                </van-form>
            </div>

            <div class="wx">
                <div class="wx-text">
                    <div>
                        <div class="line">
                            <span class="line1"></span>
                            <span class="line2"></span>
                        </div>
                        <div class="text">欢迎使用第三方登录</div>
                        <div class="line">
                            <span class="line2"></span>
                            <span class="line1"></span>

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <button class="wxbtn">微信登录</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Log",
        data(){
            return{
                Logform:{
                    phone:'',
                },
                time:0,
                code:''
            }
        },
        methods:{
            validator(val){
                return /^1[3-9]\d{9}$/.test(val);
            },
            handelSubmit(val){
                let redirect = this.$route.query.redirect || 'index';
                let query=this.$route.query.params||{};
                let obj = Object.assign({},val,{redirect},{query})
                this.$store.dispatch('handleLogin',obj);
            },
            toReg(){
                this.$router.push({path:'/reg'})
            },
            getCode(){
                if (!this.time){
                    this.time=60;
                    this.code = Math.floor(Math.random()*(9999-999)+1000);
                    let t= setInterval(()=>{
                        if (this.time>0){
                            this.time--;
                        }else{
                            clearInterval(t);
                            this.time=0;
                        }
                    },1000)

                }
            }
        }
    }
</script>

<style scoped>
    @import "../../style/admin.css";
</style>