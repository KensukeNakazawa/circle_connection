<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const USER_TYPE_USER = 1;
    const USER_TYPE_CIRCLE = 2;
    const USER_TYPE_ADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id', 'picture_url',
        'twitter_id', 'instagram_id', 'line_notify_access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        // JWT トークンに保存する ID を返す
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // JWT トークンに埋め込む追加の情報を返す
        return [];
    }

    /**
     * @return HasOne
     */
    public function setting()
    {
        $setting = null;

        if ($this->isUser()) {
            $setting = $this->hasOne('App\Models\UserSetting', 'user_id');
        } elseif ($this->isCircle()) {
            $setting = $this->hasOne('App\Models\CircleSetting', 'user_id');
        }

        return $setting;
    }

    /**
     * @return HasManyThrough
     */
    public function events()
    {
        return $this->hasManyThrough(
            'App\Models\Event',
            'App\Models\EventParticipant',
            'user_id',
            'id',
            '',
            'event_id'
        );
    }

    /**
     * 一般ユーザーかどうかを確認
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->user_type_id === config('constants.USER_TYPE_USER');
    }

    /**
     * サークルかどうかを確認
     * @return bool
     */
    public function isCircle()
    {
        return $this->user_type_id === config('constants.USER_TYPE_CIRCLE');
    }

    /**
     * 管理者かどうか確認
     * @return bool
     */
    public function isAdmin()
    {
        return $this->user_type_id === self::USER_TYPE_ADMIN;
    }
}
