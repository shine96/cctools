<?php


namespace CCTools\Facade;


use Illuminate\Support\Facades\Facade;

class SnowFlake extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SnowFlake';
    }
}