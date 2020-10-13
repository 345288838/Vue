<template>
    <div>
        <el-form :model="passform" :rules="passrules" ref="passform">
            <el-form-item label="旧密码" prop="oldpass">
                <el-input type="password" v-model="passform.oldpass" placeholder="请输入原来的密码" autocomplete="off" autofocus="on"></el-input>
            </el-form-item>
            <el-form-item label="新密码" prop="newpass">
                <el-input type="password" v-model="passform.newpass" placeholder="请输入新密码" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="newpassagain">
                <el-input type="password" v-model="passform.newpassagain" placeholder="确认密码" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item >
                <el-button type="primary" @click="handlerSubmit">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    // eslint-disable-next-line no-unused-vars
    import {SUCCESS,URL} from "../../../lib/base";
    import axios from 'axios';
    export default {
        name: "Changepass",
        data(){
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (this.passform.newpassagain !== '') {
                        this.$refs.passform.validateField('newpassagain');
                    }
                    callback();
                }
            };
            var validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.passform.newpass) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return{
                passform:{
                    oldpass:'',
                    newpass:'',
                    newpassagain:'',
                },
                passrules:{
                    oldpass: [
                        { required: true, message: '请输入旧密码', trigger: 'blur' }
                        ],
                    newpass: [
                        {validator:validatePass,trigger:'blur'}
                    ],
                    newpassagain: [
                        {validator:validatePass2,trigger: 'blur'}
                    ]
                }
            }
        },
        methods:{
            handlerSubmit(){
                let url=URL+'/admin/login/updatepass';
                let token=sessionStorage.getItem('token');
                axios({
                    method:'POST',
                    url,
                    data:this.passform,
                    headers:{
                        token
                    }
                }).then(res=>{
                    if (res.status===200 && res.data.code===SUCCESS){
                        console.log("1");
                        this.$message.success(res.data.msg);
                        sessionStorage.clear();
                        this.$router.push('/login');
                    }
                }).catch(()=>{
                    console.log("修改失败");
                })
            }
        }
    }
</script>

<style scoped>

</style>