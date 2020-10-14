<?php

namespace app\admin\validate;


use think\Validate;
class Stayhome extends Validate{
    protected $rule=[
        'cid'=>'require|number',
        'sname'=>'require',
        'sdesc'=>'require',
        'sthumb'=>'require',
        'stag'=>'require',
        'score'=>'require|number',
        'sprice'=>'require|number',
        'sprovince'=>'require',
        'scity'=>'require',
        'sarea'=>'require',
        'saddress'=>'require',
        'sbanner'=>'require',
        'sdetail'=>'require',
        'snotice'=>'require',
    ];
    protected $message=[
        'cid.require'=>'cid必填',
        'cid.number'=>'cid只能是数字',

        'sname.require'=>'民宿名称必填',

        'sdesc.require'=>'民宿描述必填',

        'sthumb.require'=>'略缩图必填',

        'stag.require'=>'民宿标签必填',

        'score.require'=>'民宿评分必填',
        'score.number'=>'民宿评分只能是数字',

        'sprice.require'=>'民宿价格必填',
        'sprice.number'=>'民宿价格只能是数字',

        'sprovince.require'=>'民宿省份必填',

        'scity.require'=>'民宿城市必填',

        'sarea.require'=>'民宿地区必填',

        'saddress.require'=>'民宿地址必填',

        'sbanner.require'=>'轮播图必填',

        'sdetail.require'=>'民宿详情必填',

        'snotice.require'=>'入住须知必填',
    ];
}