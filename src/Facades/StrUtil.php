<?php


namespace CCTools\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static \CCTools\Classes\StrUtil randStr(int $length)
 * @method static \CCTools\Classes\StrUtil desensitize(string $string, int $start, int $length, string $re)
 */
class StrUtil extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'StrUtil';
    }
}