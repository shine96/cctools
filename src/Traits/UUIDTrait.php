<?php


namespace CCTools\Traits;


use Illuminate\Support\Str;

trait UUIDTrait
{
    protected static function bootUUIDTrait()
    {
        static::creating(function ($model){
            if (!$model->getkey()){
                $model->{$model->getKeyName()} = (string)Str::uuid();
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