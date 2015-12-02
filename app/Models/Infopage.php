<?php

namespace App\Models;

use App\Services\Cache\StaticHelper;
use Illuminate\Database\Eloquent\Model;

class Infopage extends Model
{
    protected $fillable = ['name', 'code', 'text'];

    // кеш удаляем прямо в моделях из-за админки, она не видит InfopageServiceProvider
    public static function boot()
    {
        parent::boot();
        static::updated( function($infopage) {
            StaticHelper::refreshInfopageByCode($infopage->code);
        });
    }
}
