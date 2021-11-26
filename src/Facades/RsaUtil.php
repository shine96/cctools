<?php

namespace CCTools\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \CCTools\Classes\RsaUtil PubKeyEncrypt(string $data)
 * @method static \CCTools\Classes\RsaUtil PriKeyDecrypt(string $data)
 * @method static \CCTools\Classes\RsaUtil PriKeyEncrypt(string $data)
 * @method static \CCTools\Classes\RsaUtil PubKeyDecrypt(string $data)
 */
class RsaUtil extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RsaUtil';
    }
}