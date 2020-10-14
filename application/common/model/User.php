<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp=true;
    public function add($data){
        return $this->allowField(true)->save($data);
    }
    public function queryOne($where,$field="uid,nickname,phone,avatar,collection"){
        return $this->field($field)->where($where)->find();
    }

    public function collection($where,$data){
        return $this->where($where)->update($data);
    }
//    public function querOne($where,)
}