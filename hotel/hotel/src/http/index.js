import instance from "./http";
import {SUCCESS} from "../lib/base";

function index() {
    return new Promise(((resolve, reject) => {
        instance.get('/index/Index').then(res=>{
            if (res.code===SUCCESS){
                resolve(res);
            }
        }).catch((error)=>{
            reject(error);
        })
    }))
}
function detail(sid) {
    return new Promise((resolve, reject) => {
        instance.get('index/detail/'+sid).then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })
}
function list(params) {
    return new Promise((resolve, reject) => {
        instance.get('/index/lists',{
            params
        }).then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
    })
    })
}
function userReg(data) {
    return new Promise((resolve, reject) => {
        instance.post('/index/user',data).then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })

}
function login(data) {
    return new Promise((resolve, reject) => {
        instance.post('/index/login',data).then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })

}

function collection(collection) {
    return new Promise((resolve, reject) => {
        instance.post('/index/collection',{collection}).then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })
}

function user() {
    return new Promise((resolve, reject) => {
        instance.get('/index/user/1').then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })
}

function getCollection() {
    return new Promise((resolve, reject) => {
        instance.get('index/collection').then(res=>{
            resolve(res);
        }).catch(error=>{
            reject(error);
        })
    })
}

export {index,detail,list,userReg,login,collection,user,getCollection}