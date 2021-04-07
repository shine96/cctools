<?php


namespace CCTools\Providers;


use Godruoyi\Snowflake\Snowflake;
use Illuminate\Support\ServiceProvider;

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