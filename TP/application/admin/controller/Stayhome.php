<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Stayhome extends Controller
{
    public $code;
    public $validate;
    public function __construct(Request $request = null)
    {

        parent::__construct($request);
        $this->code=config('code');
        $this->validate=validate('Stayhome');

    }

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        checkToken();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=$this->request->get();
        if (isset($data['page'])&&!empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        if (isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=10;
        }
        $where=[];
        if (isset($data['sprovince'])&&!empty($data['sprovince'])){
            $where['sprovince']=$data['sprovince'];
        }
        if (isset($data['scity'])&&!empty($data['scity'])){
            $where['scity']=$data['scity'];
        }
        if (isset($data['sname'])&&!empty($data['sname'])){
            $where['sname']=['like','%'.$data['sname'].'%'];
        }
        $result=Db::table('stayhome')->field('sid,cid,sname,sdesc,stag,score,sprice,sprovince,scity,sarea,saddress,sthumb,status,ctime')->where($where)->paginate($limit,false,['page'=>$page]);
        $stayhome=$result->items();
        $total=$result->total();
        if ($stayhome&&$total){
            return json([
                "code"=>$this->code['success'],
                "msg"=>'数据获取成功',
                'data'=>$stayhome,
                'total'=>$total
            ]);
        }else{
            return json([
                "code"=>401,
                "msg"=>'暂无数据',
            ]);
        }
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data=$request->post();
        $sname=$data['sname'];
        $isExit=Db::table('stayhome')->where('sname',$sname)->count();
        if ($isExit){
            return json([
                "code"=>404,
                "msg"=>'该民宿已存在'
            ]);
        }
        $data['ctime']=time();
        if (!$this->validate->check($data)){
            return  json([
                "code"=>404,
                "msg"=>$this->validate->getError()
            ]);
        }
        $result=Db::table('stayhome')->insert($data);
        if ($result){
            return json([
                "code"=>200,
                "msg"=>'添加成功'
            ]);
        }else{
            return json([
                "code"=>404,
                "msg"=>'添加失败'
            ]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data=Db::table('stayhome')->where('sid',$id)->find();
        if($data){
            $data['sbanner1']=explode(',', $data['sbanner']);
            return json([
                "code"=>200,
                "msg"=>'数据获取成功',
                'data'=>$data,
            ]);
        }else{
            return json([
                "code"=>200,
                "msg"=>'暂无数据',
            ]);
        }
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {

        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->put();
        $result=Db::table('stayhome')->where('sid',$id)->update($data);
        if ($result){
            return json([
                "code"=>200,
                "msg"=>'编辑成功',
                'data'=>$data,
            ]);
        }else{
            return json([
                "code"=>404,
                "msg"=>'编辑失败',
            ]);
        }
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
        $result=Db::table('stayhome')->where('sid',$id)->delete();
        if($result){
            return json([
                "code"=>200,
                "msg"=>'数据删除成功',
            ]);
        }else{
            return json([
                "code"=>404,
                "msg"=>'数据删除失败'
            ]);
        }
    }
}
