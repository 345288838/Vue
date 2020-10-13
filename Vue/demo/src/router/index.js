import Vue from 'vue'
import VueRouter from "vue-router";

Vue.use(VueRouter)

import Main from "../views/main/Main";
import Login from "../views/Login";
import Categoryadd from "../views/main/category/Add";
import Categoryindex from "../views/main/category/Index";
import Categoryedit from "../views/main/category/Categoryedit";
import Changepass from "../views/main/pass/Changepass";
import Stayhomeadd from "../views/main/stayhome/Stayhomeadd";
import Stayhomeshow from "../views/main/stayhome/Stayhomeshow";
import Stayhomeedit from "../views/main/stayhome/Stayhomeedit";
import Echarts from "../views/main/echarts/Echarts";
let router=new VueRouter({
    routes:[
        {path:'/',component:Main,name:'index',redirect:'/ehcarts',
            meta:{
                auth:true,title:'首页'
            },children:[
                {
                    path:"categoryadd",component:Categoryadd,
                    name:"categoryadd",
                    meta:{
                        title:"分类添加",
                        auth:true
                    }
                },
                {
                    path:"categoryindex",component:Categoryindex,
                    name:"categoryindex",
                    meta:{
                        title:"分类查看",
                        auth:true
                    }
                },
                {
                    path:"categoryedit",component:Categoryedit,
                    name:"categoryedit",
                    meta:{
                        title:"分类编辑",
                        auth:true
                    }
                },
                {
                    path:"changepass",component:Changepass,
                    name:"changepass",
                    meta:{
                        title:"修改密码",
                        auth:true
                    }
                },
                {
                    path:"stayhomeadd",component:Stayhomeadd,
                    name:"stayhomeadd",
                    meta:{
                        title:"民宿添加",
                        auth:true
                    }
                },
                {
                    path:"stayhomeshow",component:Stayhomeshow,
                    name:"stayhomeshow",
                    meta:{
                        title:"民宿查看",
                        auth:true
                    }
                },
                {
                    path:"stayhomeedit/:id",component:Stayhomeedit,
                    name:"stayhomeedit",
                    meta:{
                        title:"民宿编辑",
                        auth:true
                    }
                },
                {
                    path:"ehcarts",component:Echarts,
                    name:"ehcarts",
                    meta:{
                        title:"民宿编辑",
                        auth:true
                    }
                },
            ]},
        {path:'/login',component:Login,name:'login',meta:{
                auth:false,title:'登录'
            }},

    ]
})

router.beforeEach((to,from,next)=>{
    let title=to.meta.title||'首页';
    document.title=title;
    if(to.meta.auth){
        let token=sessionStorage.getItem('token');
        token=token&&token.trim();
        if(token){
            next();
        }else{
            next({name:'login',query:{redirect:to.name}});
        }
    }else {
        next();
    }
});

export default router;