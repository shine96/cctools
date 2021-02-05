<?php

namespace CCTools\Rsa;


final class RsaUtil
{
    protected static $pubKey = null;
    protected static $priKey = null;
    protected static $pubKeyRes = null;
    protected static $priKeyRes = null;

    protected static $config = array(
        'config' =>  __DIR__ .'../../storage/',
        'digest_alg' => 'sha256',
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    );

    public function __construct()
    {
        if (!extension_loaded('openssl')){
            self::_error('请先开启OpenSSL扩展');
        }
        if (file_exists(self::$config['config'].'cctools.pem') && file_exists(self::$config['config'].'cctools.key')){
            self::$pubKeyRes = openssl_pkey_get_public(self::$config['config'].'cctools.key');
            self::$priKeyRes = openssl_pkey_get_private(self::$config['config'].'cctools.pem');
        }else{
            self::init();
        }
    }

    public static function init()
    {
        try {
            $res = openssl_pkey_new(self::$config);
            openssl_pkey_export($res,$private_key,null,self::$config);
            $public_key_default = openssl_pkey_get_details($res);
            $public_key = isset($public_key_default['key']) ? $public_key_default['key'] : null;
            @file_put_contents(self::$config['config'].'cctools.pem',$private_key);
            @file_put_contents(self::$config['config'].'cctools.key',$public_key);
            $data = 'verify';
            openssl_sign($data,$signtrue,$private_key,OPENSSL_ALGO_SHA256);
            $result = openssl_verify($data,$signtrue,$public_key,OPENSSL_ALGO_SHA256);
            if (!$result){
                throw new \Exception('密钥生成失败');
            }
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }

    public static function _error($msg)
    {
        throw new \Exception($msg ?? null);
    }

    public static function PubKeyEncrypt($data)
    {
        try {
            if ((string)$data){
                $encrypt = null;
                openssl_public_encrypt($data,$encrypt,self::$pubKey);
                $encryptData = base64_encode($encrypt);
                return $encryptData ?? null;
            }
            self::_error('无加密数据');
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }


    public static function PriKeyDecrypt($data)
    {
        try {
            if ($data){
                $decrypt = null;
                openssl_private_decrypt(base64_decode($data),$decrypt,self::$priKey);
                return $decrypt;
            }
            self::_error('无加密数据');
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }



    public static function PriKeyEncrypt($data)
    {
        try {
            if ($data){
                $encrypt = null;
                openssl_private_encrypt($data,$encrypt,self::$priKey);
                return base64_encode($encrypt);
            }
            self::_error('无加密数据');
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }


    public static function PubKeyDecrypt($data)
    {
        try {
            if ($data){
                $decrypt = null;
                openssl_public_decrypt(base64_decode($data),$decrypt,self::$pubKey);
                return $decrypt;
            }
            self::_error('无加密数据');
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }
}