<?php

namespace CCTools\Rsa;


final class RsaUtil
{
    private static $pubKeyRes = null;
    private static $priKeyRes = null;
    private static $config = array(
        'digest_alg' => 'sha256',
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    );
    private static $file_path;

    public function __construct()
    {
        if (!extension_loaded('openssl')){
            self::_error('请先开启OpenSSL扩展');
        }
        self::$file_path = dirname($_SERVER["DOCUMENT_ROOT"]).DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
        if (file_exists(self::$file_path.'cctools.pem') && file_exists(self::$file_path.'cctools.key')){
            self::$pubKeyRes = openssl_pkey_get_public(file_get_contents(self::$file_path.'cctools.key'));
            self::$priKeyRes = openssl_pkey_get_private(file_get_contents(self::$file_path.'cctools.pem'));
        }else{
            self::init();
        }
    }

    public static function init()
    {
        try {
            $res = openssl_pkey_new(self::$config);
            openssl_pkey_export($res,$private_key);
            $public_key_default = openssl_pkey_get_details($res);
            $public_key = isset($public_key_default['key']) ? $public_key_default['key'] : null;
            file_put_contents(self::$file_path.'cctools.pem',$private_key);
            file_put_contents(self::$file_path.'cctools.key',$public_key);
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
            new self();
            if ((string)$data){
                $encrypt = null;
                openssl_public_encrypt($data,$encrypt,self::$pubKeyRes);
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
            new self();
            if ($data){
                $decrypt = null;
                openssl_private_decrypt(base64_decode($data),$decrypt,self::$priKeyRes);
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
            new self();
            if ($data){
                $encrypt = null;
                openssl_private_encrypt($data,$encrypt,self::$priKeyRes);
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
            new self();
            if ($data){
                $decrypt = null;
                openssl_public_decrypt(base64_decode($data),$decrypt,self::$pubKeyRes);
                return $decrypt;
            }
            self::_error('无加密数据');
        }catch (\Exception $exception){
            self::_error($exception->getMessage());
        }
    }
}