<?php


namespace CCTools\Providers;


use Illuminate\Support\ServiceProvider;
use Kra8\Snowflake\Snowflake;

class SnowFlakeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('SnowFlack',function (){
            return new Snowflake();
        });
    }

    public function boot()
    {

    }
}