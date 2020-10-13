<template>
    <div>
    <el-container class="main-box">
        <el-header >
            <div class="nav">
                <img src="../../assets/logo.png" alt="">
            </div>
            <div class="info">
                <el-menu mode="horizontal">
                    <el-menu-item index="1" style="border-right: 1px solid #e5e5e5;width: 100px;">指南</el-menu-item>
                    <el-submenu index="2" style="border-right: 1px solid #e5e5e5">
                        <template slot="title">admin</template>
                        <el-menu-item index="2-1">
                            <router-link to="/changepass">修改密码</router-link>
                        </el-menu-item>
                        <el-menu-item index="2-2" @click="handlerExit">退出登录</el-menu-item>
                    </el-submenu>
                </el-menu>
            </div>
        </el-header>
        <el-container>
            <el-aside width="200px">
                <el-menu style="background: none;border-bottom: 1px solid #fff">
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-s-unfold"></i>
                            <span slot="title">分类管理</span>
                        </template>
                        <el-menu-item>
                            <router-link to="/categoryadd">分类添加</router-link>
                        </el-menu-item>
                        <el-menu-item>
                            <router-link :to="{path:'/categoryindex'}">分类查看</router-link>
                        </el-menu-item>

                    </el-submenu>
                </el-menu>
                <el-menu style="background: none;border-bottom: 1px solid #fff">
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-s-unfold"></i>
                            <span slot="title">民宿管理</span>
                        </template>
                        <el-menu-item>
                            <router-link to="/stayhomeadd">民宿添加</router-link>
                        </el-menu-item>
                        <el-menu-item>
                            <router-link to="/stayhomeshow">民宿查看</router-link>
                        </el-menu-item>

                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-container>
                <el-main>
                    <router-view></router-view>
                </el-main>
            </el-container>
        </el-container>
    </el-container>
    </div>
</template>

<script>

    export default {
        name: "Main",
        methods:{
            handlerExit(){
                sessionStorage.clear();
                this.$router.push('/login');
            }
        }
    }
</script>

<style scoped>
    .main-box{
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }
    .el-header{
        background-color: #fff;
        color: #333;
        text-align: center;
        line-height: 60px;
    }
    .el-header{
        display: flex;
        justify-content: space-between;
    }
    .el-header .nav{
        width: 200px;
        height: 60px;
        text-align: center;
    }
    .el-header .nav img{
        width: 60px;
        height: 60px;
    }
    .el-header .info{
        width: 200px;
        height: 100%;
        background-color: #42b983;
    }

    .el-aside {
        background-color: #D3DCE6;
        color: #333;
        text-align: center;
        line-height: 200px;
    }

    .el-main {
        background-color: #E9EEF3;
        color: #333;
    }

</style>