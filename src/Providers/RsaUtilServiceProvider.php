<?php


namespace CCTools\Providers;

use CCTools\Classes\Rsa;
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
            return new Rsa();
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