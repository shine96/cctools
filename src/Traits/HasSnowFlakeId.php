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
                $id         = (string)app(\Kra8\Snowflake\Snowflake::class)->next();
                $model->setAttribute($keyName, $id);
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}