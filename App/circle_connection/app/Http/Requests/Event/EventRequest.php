<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'circle_id' => ['required'],
            'title' => ['required', 'string'],
            'content' => ['required'],
            'meeting_place' => ['required', 'string'],
            'place' => ['required'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'number_of_persons' => ['required'],
            'fee' => ['required']
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'circle_id' => 'サークルID',
            'title' => 'タイトル',
            'content' => '活動内容',
            'meeting_place' => '集合場所',
            'place' => '活動場所',
            'start_time' => '開始時間',
            'end_time' => '終了時間',
            'number_of_persons' => '募集人数',
            'fee' => '参加費'
        ];
    }
}
