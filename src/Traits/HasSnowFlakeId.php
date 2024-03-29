<?php

namespace CCTools\Traits;

trait HasSnowFlakeId
{
    protected static function bootHasSnowFlakeId()
    {
        static::saving(function ($model) {
            if (is_null($model->getKey())) {
                $model->setIncrementing(false);
                $keyName    = $model->getKeyName();
                $id         = app(\Kra8\Snowflake\Snowflake::class)->next();
                $model->setAttribute($keyName, $id);
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

}