<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingRequest extends FormRequest
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
            'name' => ['string'],
            'id' => ['required', 'int'],
            'grade' => ['string', 'nullable'],
            'faculty' => ['string', 'nullable'],
            'hometown' => ['string', 'nullable'],
            'gender_id' => ['int', 'nullable'],
            'introduce' => ['string', 'nullable'],
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
            'name' => '名前',
            'grade' => '学年',
            'faculty' => '学部',
            'hometown' => '出身地',
            'gender_id' => '性別',
            'introduce' => '自己紹介'
        ];
    }
}
