import Vue from 'vue'
import VueRouter from 'vue-router'
// import store from "../store";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Index',
    component:()=>import('../views/index/Index'),
    meta:{title:'首页'}
  },
  {
    path: '/province',
    name: 'Province',
    component:()=>import('../views/province/Province'),
    meta:{title:'省份'}
  },
  {
    path: '/calendar',
    name: 'Calendar',
    component:()=>import('../views/calendar/Calendar')
  },
  {
    path: '/tab',
    name: 'Tab',
    component:()=>import('../views/tab/Tab')
  },
  {
    path: '/detail',
    name: 'detail',
    component:()=>import('../views/detail/Detail'),
    meta:{title:'详情' }
  },
  {
    path: '/list',
    name: 'List',
    component:()=>import('../views/list/List'),
    meta:{title:'列表'}
  },
  {
    path: '/user',
    name: 'User',
    component:()=>import('../views/user/User'),
    meta:{title:'个人中心', auth: true}
  },
  {
    path: '/order',
    name: 'Order',
    component:()=>import('../views/order/Order'),
    meta:{title:'全部订单'}
  },
  {
    path: '/reg',
    name: 'Reg',
    component:()=>import('../views/user/Reg'),
    meta:{title:'注册'}
  },
  {
    path: '/log',
    name: 'Log',
    component:()=>import('../views/user/Log'),
    meta:{title:'登录'}
  },
  {
    path: '/collection',
    name: 'Collection',
    component:()=>import('../views/collection/Collection'),
    meta:{title:'收藏'}
  },
  {
    path: '/orders',
    name: 'Orders',
    component:()=>import('../views/orders/Orders'),
    meta:{title:'立即下单'}
  },


]

const router = new VueRouter({
  routes
})

router.beforeEach((to,from,next)=>{
  let {title,auth} = to.meta;
  document.title = title || '一家民宿';
  if(auth){
    let token =sessionStorage.getItem('token');
    if(token){
      next();
    }else{
      next({name:'Log',query:{redirect:to.name}})
    }
  }else {
    next();
  }
})

export default router
