<?php


namespace CCTools\Traits;

use CCTools\Facade\SnowFlake;

trait SnowFlakeId
{
    protected static function bootSnowFlakeId()
    {
        static::creating(function ($model){
            if (!$model->getkey()){
                $model->{$model->getKeyName()} = (string)SnowFlake::id();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}