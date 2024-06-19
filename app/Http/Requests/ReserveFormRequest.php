<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 対象イベントの選択
            'event' => 'required',
            // チケット枚数
            'num' => 'required',
            // 姓
            'last_name' => 'required|max:20',
            // 名
            'first_name' => 'required|max:20',
            // セイ
            'last_name_kana' => 'required|max:20',
            // メイ
            'first_name_kana' => 'required|max:20',
            // 電話番号1
            'tel1' => 'required|max:5',
            // 電話番号2
            'tel2' => 'required|max:5',
            // 電話番号3
            'tel3' => 'required|max:5',
            // メールアドレス、必須、255文字以内
            'email' => 'required|max:255'
        ];
    }
}
