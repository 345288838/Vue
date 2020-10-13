<template>
    <div>
        <div v-if="category">
        <el-form :model="category" :rules="categoryRules" ref="categoryform">
            <el-form-item label="分类名称" prop="cname">
                <el-input v-model="category.cname" placeholder="请输入分类名称,包括2-6位的数字字母汉字"></el-input>
            </el-form-item>
            <el-form-item label="分类描述" prop="cdesc">
                <el-input v-model="category.cdesc" placeholder="请输入分类描述"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handlerSubmit ">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
    </div>
</template>

<script>
    import {SUCCESS, URL} from "../../../lib/base";
    import axios from "axios";

    export default {
        name: "Categoryedit",
        data(){
            // eslint-disable-next-line no-unused-vars
            let  validateCname =(rule,value,callback)=> {
                if(value===''){
                    callback(new Error('分类名称必填'));
                }else if(!(/[\u4e00-\u9fa5a-z0-9]{2,6}/.test(value))){
                    callback(new Error('分类的名称只能包含2-6位的数字字母汉字'))
                }else {
                    callback();
                }
            }
            return{
                category:null,
                categoryRules: {
                    cname: [
                        {validator:validateCname,trigger:'blur'}
                    ],
                    cdesc: [
                        {required:true,message:"分类描述必填",trigger:'blur'},
                        {min:3,max:20,message: "长度在3-20个字符",trigger:'blur'}
                    ]
                }
            }
        },
        methods:{
            handlerSubmit(){
                this.$refs.categoryform.validate(valid=>{
                    if(valid){
                        let url=URL + "/admin/category/update";
                        let token=sessionStorage.getItem('token');
                        axios({
                            url,
                            method:'POST',
                            data:this.category,
                            headers:{
                                token
                            }
                        }).then(res=>{
                            if (res.status===200&&res.data.code===SUCCESS){
                                this.$message.success(res.data.msg);
                                this.$router.push({path:'/categoryindex',});
                            }
                        }).catch(()=>{
                            this.$message.error('分类添加失败');
                        })
                    }
                })
            },
            initCategory(cid){
                let url=URL+'/admin/category/read';
                let token=sessionStorage.getItem('token');
                axios({
                    method:'GET',
                    url,
                    params:{cid},
                    headers: {
                        token
                    }
                }).then(res=>{
                    if (res.status===200&&res.data.code===SUCCESS){
                        if (res.data.data){
                            this.category=res.data.data;
                        }else {
                            this.$message.error(res.data.msg)
                        }
                    }
                }).catch(()=>{
                    this.$message.error('失败');
                })
            }
        },
        mounted() {
            let {cid}=this.$route.query;
            this.initCategory(cid);
        }
    }
</script>

<style scoped>

</style>