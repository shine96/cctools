<?php


namespace CCTools\Traits;


use Ramsey\Uuid\Uuid;

trait UUIDTrait
{
    protected static function bootUUIDTrait()
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