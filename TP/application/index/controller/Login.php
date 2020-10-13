<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\JWT;

class Login extends Controller
{
    public $code;
    public function __construct(Request $request = null)
    {
        $this->code=config("code");
        parent::__construct($request);
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
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
        $data = $request->post();
        $model = model('user');
        $result = $model->queryOne(['phone'=>$data['phone']]);
        if($result){
            $collection=explode(',',$result['collection']);
            $payload = [
                'uid' => $result['uid'],
                'nickname' => $result['nickname'],
                'avatar' => $result['avatar'],
            ];
            $token = JWT::getToken($payload, config('jwtkey'));
            return json([
                'code' => $this->code['success'],
                'msg' => '登录成功',
                'token' => $token,
                'data' => $payload,
                'collection'=>$collection
            ]);
        } else {
            return json([
                'code' => $this->code['fail'],
                'msg' => '登录失败',
                'data' => $result
            ]);
        }
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
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
    }
}
