<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SnsRequest extends FormRequest
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
            'twitter_id' => ['string', 'nullable'],
            'instagram_id' => ['string', 'nullable']
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return ['twitter_id' => 'Twitter ID', 'instagram_id' => 'Instagram ID'];
    }
}
