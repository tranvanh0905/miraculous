<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            ],
            'full_name' => [
                'required',
            ],
            'birthday' => [
                'required',
                'before:now'
            ],
            'avatar' => [
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên tài khoản !',
            'full_name.required' => 'Không được để trống họ và tên !',
            'avatar.mimes' => "Ảnh tải lên phải có định dạng .jpg .jpeg .png",
            'birthday.required' => "Bạn không được để trống ngày sinh",
            'birthday.before' => "Ngày sinh không hợp lệ",
            'avatar.max' => 'Ảnh tải lên giới hạn dung lượng không quá 2M',
        ];
    }
}
