<?php
/**
 * Created by PhpStorm.
 * User: wingyao
 * Date: 20-11-26
 * Time: 上午10:54
 */

namespace app\common;


class HttpResponseCode
{

    const HTTP_SUCCESS = 20000;

    const HTTP_AUTH_FAIL = 40010;

    const HTTP_NO_CONTENT = 40020;

    const HTTP_PARAMETER_ERROR   = 40030;

    const HTTP_ILLEGAL_OPERATION = 40070;

    const HTTP_NETWORK_ERROR = 50010;

    const HTTP_DOWNLOAD_APP = 60010;

    const HTTP_SIGN_ERROR   = 40050;

    const HTTP_DISABLED_KEYWORDS    = 40060;

    const HTTP_REQUEST_EXPIRED  = 40090;

    const HTTP_OTHER_ERROR  = 40080;

    const HTTP_NOT_FOUND    = 40040;

    const HTTP_NOT_ARRAY = 50011;

    const HTTP_CAPTCHA_ERR = 40021;

    const HTTP_CODES = [
        self::HTTP_NO_CONTENT => 'http no content',
        self::HTTP_AUTH_FAIL => 'http auth fail',
        self::HTTP_SUCCESS => 'http success',
        self::HTTP_PARAMETER_ERROR => 'parameter error',
        self::HTTP_NETWORK_ERROR => 'network error',
        self::HTTP_DOWNLOAD_APP => 'download app',
        self::HTTP_ILLEGAL_OPERATION => 'Illegal operation',
        self::HTTP_SIGN_ERROR => 'sign error',
        self::HTTP_DISABLED_KEYWORDS => 'disabled keywords',
        self::HTTP_REQUEST_EXPIRED => 'request expired',
        self::HTTP_OTHER_ERROR => 'other error',
        self::HTTP_NOT_FOUND => 'not found',
        self::HTTP_NOT_ARRAY => 'not array',
        self::HTTP_CAPTCHA_ERR => 'Verification code error',
    ];
}