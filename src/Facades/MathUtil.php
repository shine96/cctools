<?php


namespace CCTools\Facades;


use Illuminate\Support\Facades\Facade;

class MathUtil extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MathUtil';
    }
}