<template>
    <div>
        <loading :isshow="showLoading"></loading>
        <el-form :model="stayhomeform" :rules="stayhomerules" ref="stayhomeform">
            <el-form-item label="所属分类" prop="cid">
                <el-select v-model="stayhomeform.cid" placeholder="请选择">
                    <el-option v-for="item in categorys"
                               :key="item.cid"
                               :label="item.cname"
                               :value="item.cid">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="民宿名称" prop="sname">
                <el-input v-model="stayhomeform.sname"></el-input>
            </el-form-item>
            <el-form-item label="民宿描述" prop="sdesc">
                <el-input type="textarea" v-model="stayhomeform.sdesc"></el-input>
            </el-form-item>
            <el-form-item label="民宿标签" prop="stag">
                <el-input v-model="stayhomeform.stag"></el-input>
            </el-form-item>
            <el-form-item label="民宿评分" prop="score">
                <el-input v-model="stayhomeform.score"></el-input>
            </el-form-item>
            <el-form-item label="价格" prop="sprice">
                <el-input v-model="stayhomeform.sprice"></el-input>
            </el-form-item>

            <el-form-item label="民宿省份" prop="sprovince">
                <el-select v-model="stayhomeform.sprovince" placeholder="请选择">
                    <el-option v-for="(value,index) in province "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="民宿城市" prop="scity">
                <el-select  v-model="stayhomeform.scity" placeholder="请选择">
                    <el-option v-for="(value,index) in cityList "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="民宿区域" prop="sarea">
                <el-select  v-model="stayhomeform.sarea" placeholder="请选择">
                    <el-option v-for="(value,index) in areaList "
                               :key="index"
                               :label="value"
                               :value="value">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="民宿地址" prop="saddress">
                <el-input v-model="stayhomeform.saddress"></el-input>
            </el-form-item>

            <el-form-item label="民宿缩略图" prop="sthumb"></el-form-item>
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

            <el-form-item label="民宿轮播图" prop="sbanner"></el-form-item>
            <el-form-item>
                <el-upload
                        :action="uploadurl"
                        list-type="picture-card"
                        multiple
                        :limit="5"
                        :on-success="handleBannerSuccess"
                        :before-upload="beforeThumbUpload"
                        :on-preview="handlePreview"
                        :on-remove="handleBannerRemove">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png/jpeg文件，且不超过500kb,最多只能上传5张</div>
                </el-upload>
                <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>
            </el-form-item>

            <el-form-item label="民宿详情" prop="sdetail"></el-form-item>
            <el-form-item>
                <div id="sdetail"></div>
            </el-form-item>

            <el-form-item label="民宿入住须知" prop="snotice"></el-form-item>
            <el-form-item>
                <rich-text value="民宿入住须知" @rich-change="setSnotice" formfield="snotice"></rich-text>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="handleSubmit">提交</el-button>
            </el-form-item>

        </el-form>
    </div>
</template>

<script>
    import Loading from "../../../components/loading/Loading";
    import instance from "../../../http/http";
    import {SUCCESS, URL, IMGURL} from "../../../lib/base";
    import RichText from "../../../components/rich-text/RichText";
    import city from "../../../lib/city.json";

    export default {
        name: "Stayhomeadd",
        components: {
            Loading,
            RichText
        },
        data() {
            return {
                IMGURL,
                showLoading: '',
                categorys: [],
                uploadurl: URL + '/admin/upload/index',
                stayhomeform: {
                    sname: '',
                    sdesc: "",
                    sthumb: '',
                    sprice: "",
                    stag: '',
                    sprovince:'',
                    scity: '',
                    sarea: '',
                    saddress: '',
                    sbanner: '',
                    snotice: '',
                    sdetail: '',
                    cid: '',
                    score: ''
                },
                stayhomerules:{
                    cid: [
                        { required: true, message: '请选择所属分类', trigger: 'blur' }
                    ],
                    sname: [
                        { required: true, message: '请输入民宿名称', trigger: 'blur' }
                    ],
                    sdesc: [
                        { required: true, message: '请输入民宿描述', trigger: 'blur' }
                    ],
                    sthumb: [
                        { required: true, message: '请上传民宿略缩图', trigger: 'blur' }
                    ],
                    sprice: [
                        { required: true, message: '请输入民宿价格', trigger: 'blur' }
                    ],
                    stag: [
                        { required: true, message: '请输入民宿标签', trigger: 'blur' }
                    ],
                    sprovince: [
                        { required: true, message: '请选择民宿省份', trigger: 'blur' }
                    ],
                    scity: [
                        { required: true, message: '请选择民宿城市', trigger: 'blur' }
                    ],
                    sarea: [
                        { required: true, message: '请选择民宿地区', trigger: 'blur' }
                    ],
                    saddress: [
                        { required: true, message: '请输入民宿地址', trigger: 'blur' }
                    ],
                    sbanner: [
                        { required: true, message: '请上传民宿轮播图', trigger: 'blur' }
                    ],
                    snotice: [
                        { required: true, message: '请输入民宿入住须知', trigger: 'blur' }
                    ],
                    sdetail: [
                        { required: true, message: '请输入民宿详情', trigger: 'blur' }
                    ],
                    score: [
                        { required: true, message: '请输入民宿评分', trigger: 'blur' }
                    ],

                },
                bannerArr: [],
                dialogImageUrl: '',
                dialogVisible: false,
                city,
                province:[],
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
        methods: {
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
                let uploadType = ['image/jpg', 'image/png','image/jpeg'];
                let sizeFlag = true, typeFlag = true;
                sizeFlag = size < uploadMaxSize;
                typeFlag = uploadType.some(ele => ele == type);

                if (!typeFlag) {
                    this.$message.error('上传头像图片只能是 JPG,PNG 格式!');
                }
                if (!sizeFlag) {
                    this.$message.error('上传头像图片大小不能超过2MB!');
                }

                return sizeFlag && typeFlag;
            },
            handleBannerSuccess(res) {
                this.bannerArr.push(res.imgpath);
                this.stayhomeform.sbanner = this.bannerArr.join(',');
            },
            handleBannerRemove(file) {
                let url = file.response.imgpath;
                this.bannerArr = this.bannerArr.filter(ele => ele != url);
                this.stayhomeform.sbanner = this.bannerArr.join(',');
            },
            handlePreview(file) {
                let url = IMGURL + file.response.imgpath;
                console.log(url);
                this.dialogImageUrl = url;
                this.dialogVisible = true;
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
            setSnotice(filed,html){
                this.stayhomeform[filed]=html;
            },

            setProvince(){
                this.province=this.city.map(ele=>ele.name);
            },

            handleSubmit(){
                instance.post('api/stayhome',this.stayhomeform).then(res=>{
                    if (res.code===SUCCESS){
                        this.$message.success("添加成功");
                        this.$router.push({path:'/stayhomeshow'})
                    }else {
                        this.$message.error("添加失败");
                    }
                })
            }

        },
        mounted() {
            this.initCategory();
            this.initRichText();
            this.setProvince();
        }
    }
</script>

<style>
    .el-upload {
        background: #fff;
    }

    .el-icon-plus.avatar-uploader-icon {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }

    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }

    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }

    .el-upload__tip {
        color: #ff6900 !important;
    }
</style>