<?php
declare (strict_types = 1);

namespace app\controller;

use think\exception\ValidateException;
use think\facade\Validate;
use think\Request;
use app\model\UserModel;
use app\validate\UserValidate;

class User extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        return $this->create(UserModel::limit(5)->page($this->page)->paginate($this->pageSize),'获取成功');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        try{
            \validate(UserValidate::class)->check($data);
            return $this->create([],'修改成功',200);
        }catch (ValidateException $exception){
            return $this->create([],$exception->getError(),404);
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
        if (!Validate::isInteger($id)){
            return $this->create([],'id参数不合法',404);
        }
        $data = UserModel::find($id);
        if (empty($data)){
            return $this->create([],'无数据',204);
        }else{
            return $this->create($data,'数据请求成功',200);
        }
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
