<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;


/*1.验证权限
 * 2.验证请求方式
 * 3.接收前台数据
 * 4.前台数据验证
 * 5.处理验证逻辑
 * */
class Login extends Controller
{
    public function check(){
        $method = $this->request->method();//获取请求方式
        if($method != 'POST'){
            return json([
               'code'=>404,
               'msg'=>'请求方式错误'
            ]);
        }
        $data=$this->request->post();
        $validate=validate('Login');
        $flag=$validate->scene('login')->check($data);
        if(!$flag){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $whereArr=['username'=>$data['username']];
        $user=Db::table('admin')->where($whereArr)->find();
        if($user){
            $password=md5(crypt($data['password'],config('salt')));
            if($password===$user['password']){
                $payload=[
                    'id'=>$user['id'],
                    'username'=>$user['username'],
                ];
                $token=JWT::getToken($payload,config('jwtkey'));
                return json([
                    'code'=>200,
                    'msg'=>'登陆成功',
                    'token'=>$token,
                    'user'=>$payload
                ]);
            }else{
                return json([
                    'code'=>404,
                    'msg'=>'用户名或密码不匹配'
                ]);
            }
        }else{
            return json([
                'code'=>404,
                'msg'=>'用户名不存在'
            ]);
        }
    }

    public function updatepass(){
        checkToken();
        if(!$this->request->isPost()){
            return json([
                'code'=>404,
                'msg'=>'请求方式错误'
            ]);
        }
        $data=$this->request->post();
        $validate=validate('Login');
        if(!$validate->scene('changepass')->check($data)){
            return json([
                'code'=>404,
                'msg'=>$validate->getError()
            ]);
        }
        $id=$this->request->id;
        $oldpass=secretPassword($data['oldpass']);
        $newpass=secretPassword($data['newpass']);
        if ($oldpass==$newpass){
            return json([
                'code'=>404,
                'msg'=>'新密码和原密码不能相同'
            ]);
        }
        $result=Db::table('admin')->field('password')->where('id',$id)->find();
        $password=$result['password'];
        if ($password!=$oldpass){
            return json([
                'code'=>404,
                'msg'=>'原密码不匹配'
            ]);
        }
        $result=Db::table('admin')->where('id',$id)->update(['password'=>$newpass]);
        if($result){
            return json([
                "code"=>200,
                "msg"=>'修改成功',
            ]);
        }else{
            return json([
                "code"=>404,
                "msg"=>'修改失败'
            ]);
        }

    }
}