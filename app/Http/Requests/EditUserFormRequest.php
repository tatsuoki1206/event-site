<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserFormRequest extends FormRequest
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
            // ユーザ名、必須、20文字以内
            'name' => 'required|max:20',
            // メールアドレス、必須、255文字以内
            'email' => 'required|max:255',
            // パスワード、必須
            'password' => 'required | min:8 | max:16 | regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]/',
            // パスワード確認用、必須
            'password_confirm' => 'required | same:password'
        ];
    }
}
