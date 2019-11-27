<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        $validate = [
            'current_password' => [
                'required',
                new MatchOldPassword
            ],
            'new_password' => [
                'required',
                'min:5',
                'max:20'
            ],
            're_new_password' => [
                'required',
                'same:new_password'
            ],
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Không được để trống mật khẩu hiện tại !',

            'new_password.required' => 'Không được để trống mật khẩu mới !',
            'new_password.min' => 'Mật khẩu mới tối thiểu phải có 5 kí tự !',
            'new_password.max' => 'Mật khẩu mới tối đa 20 kí tự !',

            're_new_password.required' => 'Không được để trống nhập lại mật khẩu mới !',
            're_new_password.same' => 'Mật khẩu không trùng khớp với mật khẩu mới !',
        ];
    }
}
