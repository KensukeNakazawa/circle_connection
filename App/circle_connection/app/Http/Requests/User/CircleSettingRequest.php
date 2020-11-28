<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CircleSettingRequest extends FormRequest
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
            'name' => ['required'],
            'circle_category_id' => ['int', 'nullable'],
            'scale_id' => ['int', 'nullable'],
            'introduce' => ['string', 'nullable'],
            'content' => ['string', 'nullable'],
            'place' => ['string', 'nullable']
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
            'name' => 'サークル名',
            'circle_category_id' => 'サークルカテゴリー',
            'scale_id' => 'サークル規模',
            'introduce' => 'サークル紹介',
            'content' => '活動内容',
            'place' => '活動場所'
        ];
    }

}
