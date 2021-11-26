<?php


namespace CCTools\Providers;


use CCTools\Classes\RsaUtil;
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
        $this->app->singleton('RsaUtil',function (){
            return new RsaUtil();
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