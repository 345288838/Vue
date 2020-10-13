<template>
    <div>
        <div class="back">
            <span class="title1">远方 即 故乡</span>
            <span class="title2">WELCOME HOME</span>
            <span class="title3">小主 等你好久了</span>
        </div>
        <div class="con">
            <div class="login">
                <van-form>
                    <div class="inputNum">
                        <div class="inputImg">
                            <i class="iconfont icon-shouji" ></i>
                        </div>
                        <van-field
                                v-model="registerForm.phone"
                                class="num"
                                name="phone"
                                autocomplete="off"
                                placeholder="小主，留个电话吧"
                                :rules="[{ validator, message: '请输入正确的手机号' }]"
                        />
<!--                        <input type="text" class="num" placeholder="小主，留个电话吧" v-model="registerForm.phone" autocomplete="off">-->
                    </div>
                    <div style="width: 100%;">
                        <div class="inputPass">
                            <div class="inputImg">
                                <img src="../../assets/img/circle.png" alt="">
                            </div>
                            <van-field
                                    v-model="code"
                                    class="pass"
                                    name="pass"
                                    placeholder="我们的秘密"
                            />
<!--                            <input type="text" class="pass" placeholder="我们的秘密" v-model="code">-->

                        </div>
                        <button class="sub" @click="getCode" v-show="!time">获取秘密</button>
                        <button class="sub sub-time" v-show="time">{{this.time}}s</button>
                        <div class="clear"></div>
                    </div>
                    <div class="inputrepass">
                        <div class="inputImg">
                            <i class="iconfont icon-suo" ></i>
                        </div>
                        <van-field
                                v-model="registerForm.password"
                                type="password"
                                class="repass"
                                name="repass"
                                placeholder="我们来交换秘密"
                                :rules="[{ required: true, message: '请填写密码' }]"
                        />
<!--                        <input type="password" class="repass" placeholder="我们来交换秘密" v-model="registerForm.password">-->
                    </div>
                    <div class="radio">
                        <label>
                            <van-checkbox v-model="checked" checked-color="#eb666b" icon-size="0.3rem">已同意并阅读<a href="">《软件许可及服务协议》</a></van-checkbox>
                        </label>
                    </div>
                    <button class="logbtn" @click="handleSubmit">立即注册</button>
                </van-form>

            </div>
        </div>
    </div>
</template>

<script>
    import {userReg} from "../../http";
    import { Toast } from 'vant';

    export default {
        name: "Reg",
        data(){
            return{
                checked:true,
                time:0,
                registerForm:{
                    phone:'',
                    password:'',
                },
                code:'',
                subActive:false,

            }
        },
        methods:{
            validator(val){
                return /^1[3-9]\d{9}$/.test(val);
            },
            handleSubmit(){
                userReg(this.registerForm).then(res=>{
                   if (res.code===200){
                       Toast({
                           message:'注册成功'
                       })
                       setTimeout(()=>{
                           this.$router.push({path:'/log'})
                       },2000)
                   }
                }).catch(error=>{
                    console.log(error);
                })
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
        },
        mounted() {
        }
    }
</script>

<style scoped>
    @import "../../style/reg.css";
</style>