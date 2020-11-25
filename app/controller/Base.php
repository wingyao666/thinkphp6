<?php
/**
 * Created by PhpStorm.
 * User: wingyao
 * Date: 20-11-25
 * Time: 下午4:18
 */

namespace app\controller;


use think\facade\Request;
use think\Response;

abstract class Base
{
    protected $page;
    protected $pageSize;

    public function __construct()
    {
        $this->page = (int)Request::param('page') ?? 1;
        $this->pageSize = (int)config('app.page_size') ?? 10;

    }

    protected function create($data = [], string $msg = '', int $code = 200, string $type = 'json') :Response {

        $result = [
          'code' => $code,
          'msg' => $msg,
          'data' => $data
        ];

        return Response::create($result, $type);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return $this->create([],'资源不存在',404);
    }
}