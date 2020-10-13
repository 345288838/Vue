<template>
    <div class="body">
        <loading :isshow="showLoading"></loading>
        <el-form :inline="true">
            <el-form-item label="省份" prop="sprovince">
                <el-select v-model="search.sprovince" placeholder="请选择">
                    <el-option v-for="(item,index) in province"
                               :key="index"
                               :label="item"
                               :value="item">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="民宿名称">
                <el-input v-model="search.scity" placeholder="所在城市"></el-input>
            </el-form-item>

            <el-form-item label="民宿名称">
                <el-input v-model="search.sname" placeholder="民宿名称"></el-input>
            </el-form-item>


            <el-form-item>
                <el-button type="primary" @click="handlerSearch">搜索</el-button>
            </el-form-item>
        </el-form>
        <el-table :data="stayhomes">
            <el-table-column prop="sid" label="ID"></el-table-column>
            <el-table-column prop="cid" label="所属分类">
            </el-table-column>
            <el-table-column prop="sname" label="民宿名称"></el-table-column>
            <el-table-column prop="sdesc" label="民宿描述"></el-table-column>
            <el-table-column label="民宿标签">
                <template slot-scope="scope">
                    <el-button type="success" round size="mini" v-for="item in scope.row.stag"
                               :key="item">{{item}}
                    </el-button>
                </template>
            </el-table-column>
            <el-table-column prop="score" label="民宿评分"></el-table-column>
            <el-table-column prop="sprice" label="民宿价格"></el-table-column>
            <el-table-column label="位置">
                <template slot-scope="scope">
                    <span>{{scope.row.sprovince}}{{scope.row.scity}}{{scope.row.sarea}}</span>
                </template>
            </el-table-column>
            <el-table-column prop="sthumb" label="略缩图">
                <template slot-scope="scope"  >
                    <el-image
                            style="width: 100px; height: 100px"
                            :src="scope.row.sthumb"
                            :fit=fit>
                    </el-image>
                </template>
            </el-table-column>
            <el-table-column prop="status" label="状态"></el-table-column>
            <el-table-column prop="ctime" label="时间" >
                <template slot-scope="scope">
                    <span>{{scope.row.ctime|formateTime}}</span>
                </template>
            </el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button type="text" size="small">
                        <router-link :to="{name:'stayhomeedit', params:{id:scope.row.sid}}">编辑</router-link></el-button>
                    <el-button @click="handlerDel(scope.row.sid)" type="text" size="small">删除</el-button>
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
    import instance from "../../../http/http";
    import {SUCCESS, IMGURL} from "../../../lib/base";
    import Loading from "../../../components/loading/Loading";
    import city from "../../../lib/city.json";
    import {categoryIndex} from "../../../http/category";

    export default {
        name: "Stayhomeshow",
        components: {
            Loading
        },
        data() {
            return {
                IMGURL,
                fit:"cover",
                showLoading: '',
                search: {sname: '', scity: '',sprovince:''},
                paginate: {
                    page: 1,
                    limit: 5
                },
                city,
                province:[],
                stayhomes: [],
                total: 0,
                categorys:[],
            }
        },
        methods: {
            initCategory(){
                categoryIndex().then(res=>{
                    this.categorys=res.data;
                }).catch((error)=>{
                    console.log(error);
                })
            },
            initStayhome() {
                this.showLoading = true;
                let params = Object.assign({}, this.paginate, this.search);
                instance.get('api/stayhome', {params}).then(res => {
                    if (res.code === SUCCESS) {
                        this.showLoading = false;
                        if (res.data){
                            let data=res.data;
                            data=data.map(ele=>{
                                ele.stag=ele.stag.split(/,|，/);
                                ele.sthumb=IMGURL+ele.sthumb;
                                // let date=new Date(ele.ctime*1000);
                                // ele.ctime=[date.getFullYear(),date.getMonth()+1,date.getDate()].join('/');
                                return ele;
                            })
                            this.stayhomes =data;
                            this.total = res.total;
                        }

                    } else {
                        this.showLoading = false;
                        this.$message.error('暂无数据');
                    }
                })
            },
            handlerSearch() {
                this.paginate.page = 1;
                this.initStayhome();
                this.search.scity='';
            },
            handlerDel(sid) {
                instance.delete('api/stayhome'+'/'+sid).then(res=>{
                    if (res.code===SUCCESS){
                        this.initStayhome();
                    }else {
                        this.$message.error('删除失败');
                    }

                })
            },
            handlerCurrentPageChange(val) {
                this.paginate.page = val;
                this.initStayhome();
            },
            setProvince(){
                this.province=this.city.map(ele=>ele.name);
            },
        },
        mounted() {
            this.initStayhome();
            this.setProvince();
            this.initCategory();
        }
    }
</script>

<style>
    .body {
        margin-top: 30px;
    }

    .paginate {
        margin-top: 20px;
        text-align: right;
    }

</style>