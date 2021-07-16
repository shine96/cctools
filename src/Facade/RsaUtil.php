<?php

namespace CCTools\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \CCTools\Classes\Rsa PubKeyEncrypt(string $data)
 * @method static \CCTools\Classes\Rsa PriKeyDecrypt(string $data)
 * @method static \CCTools\Classes\Rsa PriKeyEncrypt(string $data)
 * @method static \CCTools\Classes\Rsa PubKeyDecrypt(string $data)
 */
class RsaUtil extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RsaUtil';
    }
}