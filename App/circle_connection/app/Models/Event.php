<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * イベントを表すモデル
 *
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    /** 変更できるカラム  */
    protected $fillable = [
        'circle_id', 'title', 'content', 'meeting_place', 'place',
        'start_time', 'end_time', 'number_of_persons', 'fee', 'picture_url'
    ];

    /**
     * イベントを保有しているサークルを取得
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circle()
    {
        return $this->belongsTo(
            'App\Models\User',
            'circle_id',
            'id');
    }

    /**
     * イベントに参加しているユーザーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function participated_users()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\EventParticipant',
            'event_id',
            'id',
            null,
            'user_id'
        );
    }
}
