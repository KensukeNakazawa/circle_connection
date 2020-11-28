<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CircleSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'circle_category_id', 'scale_id', 'introduce', 'content', 'place'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circleCategory()
    {
        return $this->belongsTo('App\Models\CircleCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scale()
    {
        return $this->belongsTo('App\Models\Scale');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
