<?php


namespace CCTools\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static \CCTools\Classes\StrUtil RandStr(int $length)
 */
class StrUtil extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'StrUtil';
    }
}