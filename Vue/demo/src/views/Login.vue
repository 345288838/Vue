<template>
<!--    只有一个根元素-->
    <div class="login"  ref="login">
        <div class="login-content">
            <el-form :model="loginForm" ref="loginForm" :rules="rules">
                <el-form-item label="用户名:" prop="username">
                    <el-input v-model="loginForm.username" ></el-input>
                </el-form-item>
                <el-form-item label="密码:" prop="password">
                    <el-input type="password" v-model="loginForm.password"></el-input>
                </el-form-item>
                <el-form-item >
                    <el-button type="primary" @click.prevent="handelLogin">登录</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {URL ,SUCCESS } from "../lib/base";

    export default {
        name: "login",
        data(){
            return{
                loginForm:{
                    username:'',
                    password:''
                },
                rules:{
                    username: [
                        { required: true, message: '请输入用户名称', trigger: 'blur' },
                        { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
                    ],
                    password:[
                        { required: true, message: '请输入密码名称', trigger: 'blur' },
                        { min: 6, message: '最少6位', trigger: 'blur' }
                    ]
                }
            }
        },
        methods:{
            handelLogin(){
                this.$refs.loginForm.validate((validate)=>{
                    if(validate){
                        /*
                        * 同源
                        * 跨域
                        * 1.代理
                        * 2.服务器端
                        * 3.jsonp
                        *
                        * */
                        // let url="http://localhost/thinkphp/public/index.php";
                        axios.post(URL+'/admin/login/check',this.loginForm).then((res)=> {
                            if(res.status===200&&res.data.code===SUCCESS){
                                sessionStorage.setItem('token',res.data.token);
                                sessionStorage.setItem('user',JSON.stringify(res.data.user));
                                let redirect=this.$route.query.redirect||'index';
                                this.$router.push({name:redirect});
                            }else {
                                this.$message.error(res.data.msg);

                            }
                            // console.log(this.loginForm);
                            // this.$router.push({path:'/'})
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }
                })
            }
        }
    }
</script>

<style scoped>
.login{
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background:#f5f5f5;
}
    .login>.login-content{
        width: 400px;
        height: auto;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 15px;
    }
</style>