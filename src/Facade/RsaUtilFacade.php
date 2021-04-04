<?php

namespace CCTools\Facade;


use Illuminate\Support\Facades\Facade;

class RsaUtilFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RsaUtil';
    }
}