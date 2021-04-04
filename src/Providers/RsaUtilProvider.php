<?php


namespace CCTools\Providers;


use CCTools\Classes\RsaUtil;
use Illuminate\Support\ServiceProvider;

class RsaUtilProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('RsaUtil',function (){
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