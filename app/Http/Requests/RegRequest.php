<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegRequest extends FormRequest
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
            'username' => [
                'required',
                'unique:users,username',
                'min:4',
                'max: 20'
            ],
            'full_name' => [
                'required',
                'alpha_spaces',
                'min: 4'
            ],
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/',
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'username.required' => 'Bạn phải nhập tên tài khoản !',
            'username.unique' => 'Tên tài khoản đã có người đặt, hãy thử đặt tên khác !',
            'username.min' => 'Tên tài khoản tối thiểu phải 4 kí tự!',
            'username.max' => 'Tên tài khoản tối đa phải 20 kí tự!',
            'full_name.required' => 'Bạn không được để trống họ và tên !',
            'full_name.alpha_spaces' => 'Tên bắt buộc là chữ cái, không bao gồm số !',
            'full_name.min' => 'Họ tên bạn quá ngắn, hãy kiểm tra lại !',
            'email.required' => 'Bạn phải nhập email !',
            'email.unique' => 'Email đã có người đăng ký, hãy thử email khác !',
            'email.regex' => 'Định dạng email chưa chính xác !',
            'password.required' => 'Bạn phải nhập mật khẩu !',
            'password.regex' => 'Mật khẩu phải có ít nhất 8 kí tự, một chữ in hoa, một chữ số và một kí tự đặc biệt !',
        ];
    }
}
