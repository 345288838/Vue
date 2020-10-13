import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";
import router from "../router";
import {login} from "../http";

Vue.use(Vuex);

const store = new Vuex.Store({
    //唯一数据来源
    state:{
        indexSearch:{
            province:'',
            address:'',
            startTime:'',
            endTime:'',
            startDay: '',
            endDay: '',

        },
        token:'',
        collection:[],
    },
    //getters ===> computed
    getters:{
        isCollection(state){
            return function (sid) {
                let flag=false;
                if (state.collection.length){
                    flag = state.collection.some(ele=>
                        ele == sid
                    )
                }
                return flag;
            }
        }

    },
    //修改state的唯一方法(同步)
    mutations:{
        setTime(state,payload){
            let weekArr=['SUN','MON','TUE','WED','THU','FRI','SAT'];
            let {start,end,startDay,endDay} = payload;
            let date = new Date();
            let startTime = start?start:date.getMonth()+1+'.'+date.getDate();
            let endTime = end?end:date.getMonth()+1+'.'+date.getDate() + 2;
            startDay=startDay===undefined ?date.getDay():startDay;
            endDay=endDay===undefined ?startDay+2:endDay;

            state.indexSearch.startDay=weekArr[startDay];
            state.indexSearch.endDay=weekArr[endDay];
            state.indexSearch.startTime = startTime;
            state.indexSearch.endTime = endTime;
        },
        setProvince(state,payload){
            state.indexSearch.province = payload;
        },
        setToken(state,payload){
            state.token=payload;
        },
        setCollection(state,payload){
            state.collection=payload
        },
        toCollection(state,sid){
            let flag=state.collection.indexOf(sid);
            if (flag>-1){
                state.collection.splice(flag,1);
            }else{
                state.collection.push(sid);
            }
        }
    },
    //actions：异步方法，提交mutations
    actions:{
        handleLogin({commit},payload){
            let redirect = payload.redirect;
            let query=payload.query;
            delete payload.redirect;
            delete payload.query;
            login(payload).then(res=>{
                sessionStorage.setItem('token',res.token);
                commit('setToken',res.token);
                res.collection && commit('setCollection',res.collection.map(ele=>ele*1));
                router.replace({name:redirect,query:query});
            }).catch(error=>{
                console.log(error);
            })
        }
    },
    modules:{

    },
    plugins: [createPersistedState()],
})

export default store;