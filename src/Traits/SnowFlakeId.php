<?php


namespace CCTools\Traits;


trait SnowFlakeId
{
    protected static function bootSnowFlakeId()
    {
        static::saving(function ($model) {
            if (is_null($model->getKey())) {
                $model->setIncrementing(false);
                $keyName    = $model->getKeyName();
                $id         = (string)app(\Kra8\Snowflake\Snowflake::class)->next();
                $model->setAttribute($keyName, $id);
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