<?php


namespace CCTools\Providers;

use CCTools\Facades\RsaUtil;
use Illuminate\Support\ServiceProvider;

class RsaUtilServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //自动注册
        $this->app->singleton(RsaUtil::class,function (){
            return new \CCTools\Classes\RsaUtil();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}