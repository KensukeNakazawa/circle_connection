<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id', 'hometown', 'faculty', 'grade', 'gender_id', 'introduce'
    ];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
