<?php


namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule=[
        'username'=>'require',
        'password'=>'require',
        'newpass'=>'require',
        'oldpass'=>'require',
        'newpassagain'=>'require|confirm:newpass',
    ];
    protected $message=[
        'username'=>'用户名必填',
        'password'=>'密码必填',
        'newpass'=>'新密码必填',
        'oldpass'=>'旧密码必填',
        'newpassagain.require'=>'确认密码',
        'newpassagain.confirm'=>'两次密码不一致',
    ];
    protected $scene=[
        'login'=>'username,password',
        'changepass'=>'oldpass,newpass,newpassagain'
    ];
}