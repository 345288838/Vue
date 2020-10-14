<?php


namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule=[
        'cid'=>'require|number',
        'cname'=>'require|chsAlphaNum',
        'cdesc'=>'require|chsAlphaNum'
    ];
    protected $message=[
        'cid.require'=>'cid必填',
        'cid.number'=>'cid只能是数字',
        'cname.require'=>'分类名称必填',
        'cname.chsAlphaNum'=>'分类名称只能是汉字、数字或字母',
        'cdesc.require'=>'分类描述必填',
        'cdesc.chsAlphaNum'=>'分类描述只能是汉字、数字或字母',
    ];
    protected $scene=[
        'add'=>'cname,cdesc',
        'read'=>'cid',
        'update'=>'cid,cname,cdesc',
        'del'=>'cid'
    ];
}