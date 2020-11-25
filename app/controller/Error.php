<?php
/**
 * Created by PhpStorm.
 * User: wingyao
 * Date: 20-11-25
 * Time: 下午4:18
 */

namespace app\controller;


class Error extends Base
{

    /**
     * 404
     * @return \think\Response
     */
    public function index(){
        return $this->create([],'资源不存在',404);
    }
}