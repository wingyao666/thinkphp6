<?php
/**
 * Created by PhpStorm.
 * User: wingyao
 * Date: 20-11-26
 * Time: 上午10:50
 */

namespace app\controller;
use app\common\HttpResponseCode;
use think\facade\Db;
use think\Response;

class Crypt extends Base
{

    const KEY = '01234567890123456';
    const IV = '9876543210987654';
    const METHOD = 'AES-128-CBC';




    /**
     * RSA加密
     *
     * @param [type] $value
     * @return void
     *
     * @DateTime 2020-07-15
     */
    public static function RsaEncrypt($value)
    {
        $dbtianyinkey = 'db_tianyin';//天音
        $dbtianyin = Db::connect($dbtianyinkey);
        //获取RSA私钥
        $secret = $dbtianyin
            ->name("cmf_rsa")
            ->where('scene', 1)
            ->order("id desc")
            ->value("pub");

        if (!$secret) {
            $ret = [
                'code'  => HttpResponseCode::HTTP_SIGN_ERROR,
                'msg'   => '数据缺失!',
                'data'  => []
            ];
            return Base::create($ret);
        }
        //公钥加密
        $public_key = openssl_pkey_get_public($secret);
        if (!$public_key) {
            $ret = [
                'code'  => HttpResponseCode::HTTP_SIGN_ERROR,
                'msg'   => '请求过期!',
                'data'  => []
            ];
            return Base::create($ret);
        }

        //第一个参数是待加密的数据只能是string，第二个参数是加密后的数据,第三个参数是openssl_pkey_get_public返回的资源类型,第四个参数是填充方式
        $return_en = openssl_public_encrypt($value, $crypted, $public_key);
        if (!$return_en) {
            $ret = [
                'code'  => HttpResponseCode::HTTP_SIGN_ERROR,
                'msg'   => '请求过期!',
                'data'  => []
            ];
            return Base::create($ret);
        }
        $eb64_cry = urlencode(base64_encode($crypted));
        return $eb64_cry;
    }
    /**
     * RSA解密
     *
     * @return void
     * @param $value
     * @return mixed
     * @throws CryptExecption
     * @throws Exception
     */
    public static function RsaDecrypt($value)
    {
        $dbtianyinkey = 'db_tianyin';//天音
        $dbtianyin = Db::connect($dbtianyinkey);
        //获取RSA私钥
        $secret = $dbtianyin
            ->name("cmf_rsa")
            ->where('scene', 1)
            ->order("id desc")
            ->value("pri");
        if (!$secret) {
            throw new CryptExecption('数据缺失!', 40402);
        }

        //私钥解密
        $private_key = openssl_pkey_get_private($secret);
        if (!$private_key) {
            throw new CryptExecption('请求过期!', 40403);
        }

        $newValue = urldecode($value);
        $return_de = openssl_private_decrypt(base64_decode($newValue), $decrypted, $private_key);
        if (!$return_de) {
            throw new CryptExecption('请求过期!!', 40403);
        }

        return $decrypted;
    }
}