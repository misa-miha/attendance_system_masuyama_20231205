<?php

namespace App\Http\Requests;

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
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※名前を入力してください',
            'email.email' => '※メールアドレスを入力してください',
            'email.required' => '※メールアドレスを入力してください',
            'email.unique:users' => '※既に登録されているメールアドレスです',
            'password.required' => '※パスワードを入力してください',
            'password.confirmed' => '※パスワードが一致していません',
        ];
    }
}
