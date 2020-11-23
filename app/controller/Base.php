<?php
/*
 * YiFan-Volunteer-Tp6
 * ============================================================================
 * 版权所有 2017-2019 佛山市益帆网络有限公司，并保留所有权利。
 * 网站地址: http://www.yifanps.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
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
        $this->pageSize = config('app.page_size') ?? 10;
    }

    protected function create($data = [], string $msg = '', int $code = 200, string $type = 'json') :Response {

        $result = [
          'code' => $code,
          'msg' => $msg,
          'data' => $data
        ];

        return Response::create($result, $type);
    }
}