<?php

namespace CCTools\Facade;


use Illuminate\Support\Facades\Facade;

class RsaUtil extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RsaUtil';
    }
}