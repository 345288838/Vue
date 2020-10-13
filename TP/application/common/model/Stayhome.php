<?php


namespace app\common\model;


use think\Model;

class Stayhome extends Model
{
    public function getCollection($id,$in,$collection){
        return $this->where($id,$in,$collection)->select();
    }

    public function edit($data,$where){
        return $this->allowField(true)->isUpdate(true)->where($where)->save($data);
    }

}