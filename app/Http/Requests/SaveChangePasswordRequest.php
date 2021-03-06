<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function true()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate = [
            'password' => [
                'required',
                'min:6'
            ],
            'cf_password' => [
                'required',
                'same:password'
            ],
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'password.required' => 'Bạn phải nhập mật khẩu mới !',
            'password.min' => 'Mật khẩu mới phải có 6 ký tự!',
            'cf_password.required' => 'Bạn không được để trống nhập lại mật khẩu!',
            'cf_password.same' => 'Mật khẩu bạn nhập không trùng khớp mật khẩu mới !',
        ];
    }
}
