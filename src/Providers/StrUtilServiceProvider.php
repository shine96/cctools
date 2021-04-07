<?php


namespace CCTools\Providers;


use CCTools\Classes\StrUtil;
use Illuminate\Support\ServiceProvider;

class StrUtilServiceProvider extends ServiceProvider
{
    public function register()
    {
        //绑定IoC容器
        $this->app->bind('StrUtil',function (){
            return new StrUtil();
        });
    }


    public function boot()
    {

    }
}