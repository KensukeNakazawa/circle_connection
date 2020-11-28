<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['string', 'required', 'min:2', 'max:15'],
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6'],
            'user_type' => ['required']
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
            'name' => '名前またはサークル名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirmation' => '確認用パスワード',
            'user_type' => 'ユーザータイプ'
        ];
    }

    /**
     * エラーメッセージ validation.php で不足した時にオーバーライドみたいに使う
     *
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }

}
