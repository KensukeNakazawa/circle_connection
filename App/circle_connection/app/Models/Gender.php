<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\ActiveScope;

class Gender extends Model
{
    /**
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}
