<?php


namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule=[
        'phone'=>'require|regex:/^1[3-9]\d{9}$/',
        'password'=>'require',
    ];
    protected $message=[
        'phone.require'=>'手机号必填',
        'phone.regex'=>'填入正确的手机号',
        'password'=>'密码必填',
    ];

}