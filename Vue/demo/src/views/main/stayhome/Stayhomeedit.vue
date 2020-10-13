<template>
    <div>
        <el-form :model="stayhomeform" v-if="stayhomeform">
            <el-form-item label="所属分类">
                <el-select v-model="stayhomeform.cid" placeholder="请选择">
                    <el-option v-for="item in categorys"
                               :key="item.cid"
                               :label="item.cname"
                               :value="item.cid">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="民宿名称">
                <el-input v-model="stayhomeform.sname"></el-input>
            </el-form-item>
            <el-form-item label="民宿描述">
                <el-input type="textarea" v-model="stayhomeform.sdesc"></el-input>
            </el-form-item>
            <el-form-item label="民宿标签" >
                <el-input v-model="stayhomeform.stag"></el-input>
            </el-form-item>
            <el-form-item label="民宿评分">
                <el-input v-model="stayhomeform.score"></el-input>
            </el-form-item>
            <el-form-item label="价格" >
                <el-input v-model="stayhomeform.sprice"></el-input>
            </el-form-item>

            <el-form-item label="民宿省份">
                <el-select v-model="stayhomeform.sprovince" placeholder="请选择">
                    <el-option v-for="(value,index) in province "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="民宿城市">
                <el-select  v-model="stayhomeform.scity" placeholder="请选择">
                    <el-option v-for="(value,index) in cityList "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="民宿区域">
                <el-select  v-model="stayhomeform.sarea" placeholder="请选择">
                    <el-option v-for="(value,index) in areaList "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="民宿地址">
                <el-input v-model="stayhomeform.saddress"></el-input>
            </el-form-item>

            <el-form-item label="民宿缩略图" ></el-form-item>
            <el-form-item>
                <el-upload
                        class="avatar-uploader"
                        :action="uploadurl"
                        :show-file-list="false"
                        :on-success="handleThumbSuccess"
                        :before-upload="beforeThumbUpload">
                    <img v-if="stayhomeform.sthumb" :src="IMGURL+stayhomeform.sthumb" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png/jpeg文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>

            <el-form-item label="民宿轮播图" ></el-form-item>
            <el-form-item>
                <el-upload
                        :action="uploadurl"
                        list-type="picture-card"
                        multiple
                        :limit="5"
                        :on-success="handleBannerSuccess"
                        :file-list="bannerfilelist"
                        :before-upload="beforeThumbUpload"
                        :on-preview="handleBannerPreview"
                        :on-remove="handleBannerRemove">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png/jpeg文件，且不超过2MB,最多只能上传5张</div>
                </el-upload>
                <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>
            </el-form-item>

            <el-form-item label="民宿详情" ></el-form-item>
            <el-form-item>
                <rich-text :value="stayhomeform.sdetail" @rich-change="setSnotice" formfield="sdetail"></rich-text>
            </el-form-item>

            <el-form-item label="民宿入住须知"></el-form-item>
            <el-form-item>
                <rich-text :value="stayhomeform.snotice" @rich-change="setSnotice" formfield="snotice"></rich-text>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="handleSubmit">提交</el-button>
            </el-form-item>

        </el-form>
    </div>
</template>

<script>
    import {stayhomeread,stayhomeedit} from "../../../http/stayhome";
    import RichText from "../../../components/rich-text/RichText";
    import {IMGURL, SUCCESS, URL} from "../../../lib/base";
    import city from "../../../lib/city.json";
    import instance from "../../../http/http";

    export default {
        name: "stayhomeedit",
        data(){
            return{
                IMGURL,
                uploadurl: URL + '/admin/upload/index',
                bannerfilelist:[],
                stayhomeform:null,
                province:[],
                city,
                bannerArr:[],
                categorys: [],
                dialogImageUrl: '',
                dialogVisible: false,
            }
        },
        components:{
            RichText
        },
        methods:{
            initStayhome(sid){
                stayhomeread(sid).then(res=>{
                    if (res.data){
                        this.stayhomeform=res.data;
                        this.bannerArr=res.data.sbanner1;
                        this.bannerfilelist=res.data.sbanner1.map(ele=>({name:res.data.sname,url:this.IMGURL + ele}));
                    }

                }).catch(error=>{
                    console.log(error);
                })
            },
            initCategory() {
                this.showLoading = true;
                instance('admin/category/indexall').then(res => {
                    this.showLoading = false;
                    if (res.code === SUCCESS) {
                        this.categorys = res.data;
                    }
                })
            },
            handleThumbSuccess(res) {
                if (res.code === SUCCESS) {
                    this.stayhomeform.sthumb = res.imgpath;
                }
            },
            beforeThumbUpload(file) {
                let {size, type} = file;
                let uploadMaxSize = 2*1024 * 1024;
                let uploadType = ['image/jpg', 'image/png','image/jpeg','image/webp'];
                let sizeFlag = true, typeFlag = true;
                sizeFlag = size < uploadMaxSize;
                typeFlag = uploadType.some(ele => ele == type);

                if (!typeFlag) {
                    this.$message.error('上传图片只能是JPG,PNG格式!');
                }
                if (!sizeFlag) {
                    this.$message.error('上传图片大小不能超过 2MB!');
                }

                return sizeFlag && typeFlag;
            },
            handleBannerSuccess(res) {
                this.bannerArr.push(res.imgpath);
                this.stayhomeform.sbanner = this.bannerArr.join(',');
            },
            handleBannerRemove(file) {
                let url = file.response?file.response.imgpath:file.url;
                this.bannerArr = this.bannerArr.filter(ele =>!url.includes(ele));
                this.stayhomeform.sbanner = this.bannerArr.join(',');
            },
            handleBannerPreview(file){
                this.dialogVisible = true;
                let url;
                if (file.response){
                    url = IMGURL + file.response.imgpath;
                }else {
                    url=file.url;
                }
                this.dialogImageUrl = url;
            },
            handlePreview(file) {
                let url = IMGURL + file.response.imgpath;
                this.dialogImageUrl = url;
                this.dialogVisible = true;
            },
            setSnotice(filed,html){
                this.stayhomeform[filed]=html;
            },
            setProvince(){
                this.province=this.city.map(ele=>ele.name);
            },
            initRichText() {
                let that =this;
                var E = require('wangeditor');
                var editor = new E('#sdetail');
                editor.customConfig.showLinkImg = false;
                editor.customConfig.uploadImgServer =this.uploadurl;
                editor.customConfig.uploadFileName = 'file';
                editor.customConfig.onchange=(html)=>{
                    this.stayhomeform.sdetail=html;
                }
                editor.customConfig.uploadImgHooks={
                    customInsert: function (insertImg, result) {
                        insertImg(that.IMGURL+result.imgpath);
                    }
                }
                editor.create();
            },
            handleSubmit(){
                delete (this.stayhomeform['sbanner1']);
                stayhomeedit(this.stayhomeform.sid,this.stayhomeform).then(res=>{
                    this.$message.success(res.msg);
                    this.$router.push({path:'/stayhomeshow'})
                }).catch((error)=>{
                    console.log(error);
                })
            }
        },
        computed:{
            cityList(){
                let cityList=[];
                let current=this.city.find(ele=>ele.name == this.stayhomeform.sprovince);
                if (current){
                    cityList=current.city.map(ele=>ele.name);
                }
                return cityList;
            },
            areaList(){
                let areaList=[];
                let current=this.city.find(ele=>ele.name == this.stayhomeform.sprovince);
                if(current){
                    let city=current.city.find(ele=>ele.name == this.stayhomeform.scity);
                    if (city){
                        areaList=city.area;
                    }
                }

                return areaList;
            }
        },
        mounted() {
            let $sid=this.$route.params.id;
            this.initCategory();
            this.initStayhome($sid);
            this.setProvince();
            this.initRichText();
        }
    }
</script>

<style scoped>

</style>