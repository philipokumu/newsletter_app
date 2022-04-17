<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggify
{
    public static function bootSluggify()
    {
        static::created(function ($model) {

            $model->slug = Str::slug($model->value);
            $model->save();
        });
    }
}