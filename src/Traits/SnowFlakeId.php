<?php


namespace CCTools\Traits;



trait SnowFlakeId
{
    protected static function bootSnowFlakeId()
    {
        static::creating(function ($model){
            if (!$model->getkey()){
                $model->{$model->getKeyName()} = Uuid::uuid1()->toString();
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