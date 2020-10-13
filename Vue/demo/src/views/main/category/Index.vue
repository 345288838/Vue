<template>
    <div class="con">
        <el-form :inline="true">
            <el-form-item label="分类名称">
                <el-input v-model="search.cname" placeholder="分类名称"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handlerSearch">搜索</el-button>
            </el-form-item>
        </el-form>
        <el-table :data="categories">
            <el-table-column prop="cid" label="ID"></el-table-column>
            <el-table-column prop="cname" label="分类名称"></el-table-column>
            <el-table-column prop="cdesc" label="分类描述"></el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button @click="handlerEdit(scope.row.cid)" type="text" size="small">编辑</el-button>
                    <el-button @click="handlerDel(scope.row.cid)" type="text" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="paginate">
            <el-pagination
            :total="total"
            :page-size.sync="paginate.limit"
            :current-page.sync="paginate.page"
            layout="total,prev,pager,next,jumper"
            @current-change="handlerCurrentPageChange"
            >

            </el-pagination>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {URL ,SUCCESS} from "../../../lib/base";
    export default {
        name: "Index",
        data(){
            return{
                search:{cname:''},
                paginate:{
                    page:1,
                    limit:5
                },
                categories:[],
                total:0
            }
        },
        methods:{
            initCategory(){
                let url=URL+'/admin/category/select';
                let token=sessionStorage.getItem('token');
                let params = Object.assign({},this.paginate,this.search);//合并对象
                axios({
                    method:'GET',
                    url,
                    params,
                    headers:{
                        token
                    }
                }).then(res=>{
                    if (res.status && res.data.code===SUCCESS){
                        if (res.data.data){
                            this.categories=res.data.data;
                            this.total=res.data.total;
                        }else {
                            this.$message.info(res.data.msg);
                        }
                    }
                }).catch(()=>{
                    this.$message.error('查询失败');
                })
            },
            handlerCurrentPageChange(val){
                this.paginate.page=val;
                this.initCategory();
            },
            handlerSearch(){
                this.paginate.page=1;
                this.initCategory();
            },
            handlerEdit(cid){
                this.$router.push({path:'/categoryedit',query:{cid}});
            },
            handlerDel(cid){
                let url=URL+'/admin/category/del';
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
                        this.initCategory();
                    }
                }).catch(()=>{
                    this.$message.error('失败');
                })
            }

        },
        mounted(){
            this.initCategory();
        }
    }

</script>

<style scoped>
    .paginate{
        margin-top: 20px;
        text-align: right;
    }
</style>