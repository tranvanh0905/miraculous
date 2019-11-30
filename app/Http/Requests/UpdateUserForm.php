<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserForm extends FormRequest
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'role' => 'required',
            'birthday' => 'required',
            'status' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'avatar' => 'mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập username',
            'email.required' => 'Vui lòng nhập email',
            'role.required' => 'Vui lòng chọn quyền của tài khoản',
            'birthday.required' => "Vui lòng chọn ngày sinh nhật",
            "status.required" => "Vui lòng chọn trạng thái của tài khoản",
            'full_name.required' => 'Vui lòng nhập tên đầy đủ',
            "gender.required" => "Vui lòng chọn giới tính",
            "avatar.mimes" => "Ảnh sai định dạng ( chỉ chấp nhận định đạng jpg, jpeg, png )",
            'avatar.max' => "Kích thước của ảnh không được lớn quá 2MB",
        ];
    }
}
