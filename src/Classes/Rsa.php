<?php


namespace CCTools\Classes;


class Rsa
{
    public $pubKeyRes = null;
    public $priKeyRes = null;
    public $config = array(
        'digest_alg' => 'sha256',
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    );
    public $file_path;


    public function __construct()
    {
        if (!extension_loaded('openssl')){
            $this->_error('请先开启OpenSSL扩展');
        }
        $this->file_path = base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
        if (file_exists($this->file_path.'cctools.pem') && file_exists($this->file_path.'cctools.key')){
            $this->pubKeyRes = openssl_pkey_get_public(file_get_contents($this->file_path.'cctools.key'));
            $this->priKeyRes = openssl_pkey_get_private(file_get_contents($this->file_path.'cctools.pem'));
        }else{
            $this->init();
        }
    }

    public function init()
    {
        try {
            $res = openssl_pkey_new($this->config);
            openssl_pkey_export($res,$private_key);
            $public_key_default = openssl_pkey_get_details($res);
            $public_key = isset($public_key_default['key']) ? $public_key_default['key'] : null;
            file_put_contents($this->file_path.'cctools.pem',$private_key);
            file_put_contents($this->file_path.'cctools.key',$public_key);
            $data = 'verify';
            openssl_sign($data,$signtrue,$private_key,OPENSSL_ALGO_SHA256);
            $result = openssl_verify($data,$signtrue,$public_key,OPENSSL_ALGO_SHA256);
            if (!$result){
                throw new \Exception('密钥生成失败');
            }
        }catch (\Exception $exception){
            $this->_error($exception->getMessage());
        }
    }

    public function _error($msg)
    {
        throw new \Exception($msg ?? null);
    }

    public function PubKeyEncrypt($data)
    {
        try {
            new self();
            if ((string)$data){
                $encrypt = null;
                openssl_public_encrypt($data,$encrypt,$this->pubKeyRes);
                $encryptData = base64_encode($encrypt);
                return $encryptData ?? null;
            }
            $this->_error('无加密数据');
        }catch (\Exception $exception){
            $this->_error($exception->getMessage());
        }
    }


    public function PriKeyDecrypt($data)
    {
        try {
            new self();
            if ($data){
                $decrypt = null;
                openssl_private_decrypt(base64_decode($data),$decrypt,$this->priKeyRes);
                return $decrypt;
            }
            $this->_error('无加密数据');
        }catch (\Exception $exception){
            $this->_error($exception->getMessage());
        }
    }



    public function PriKeyEncrypt($data)
    {
        try {
            new self();
            if ($data){
                $encrypt = null;
                openssl_private_encrypt($data,$encrypt,$this->priKeyRes);
                return base64_encode($encrypt);
            }
            $this->_error('无加密数据');
        }catch (\Exception $exception){
            $this->_error($exception->getMessage());
        }
    }


    public function PubKeyDecrypt($data)
    {
        try {
            new self();
            if ($data){
                $decrypt = null;
                openssl_public_decrypt(base64_decode($data),$decrypt,$this->pubKeyRes);
                return $decrypt;
            }
            $this->_error('无加密数据');
        }catch (\Exception $exception){
            $this->_error($exception->getMessage());
        }
    }
}