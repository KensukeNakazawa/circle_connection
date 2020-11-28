<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * イベントとユーザーを紐付けるモデル
 *
 * Class EventParticipant
 * @package App\Models
 */
class EventParticipant extends Model
{

    /** 変更できるカラム */
    protected $fillable = [
        'event_id', 'user_id'
    ];
}
