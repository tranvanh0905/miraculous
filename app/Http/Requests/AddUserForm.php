<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserForm extends FormRequest
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
            'username' => 'required|max:20|unique:users',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required',
            'birthday' => 'required',
            'status' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => "Hãy nhập tên tài khoản",
            'username.max' => "Tên tài khoản không được vượt quá 20 ký tự",
            'username.unique' => "Tên tài khoản bị trùng",
            'birthday.required' => 'Hãy nhập ngày sinh nhật',
            'email.required' => 'Hãy nhập email',
            'password.required' => "Vui lòng nhập mật khẩu",
            'password.min' => "Mật khẩu tối thiểu 8 ký tự",
            'password.regex' => " Mật khẩu nên có ít nhất 1 chữ thường VÀ 1 chữ hoa và 1 số và 1 ký hiệu",
            'role.required' => "Vui lòng chọn quyền",
            'status.required' => "Vui lòng chọn trạng thái",
            'full_name.required' => "Vui lòng nhập đủ họ và tên",
            'gender.required' => "Vui lòng chọn giới tính",
            'avatar.required' => "Vui lòng chọn ảnh",
            'avatar.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif",
            'avatar.max' => 'Ảnh giới hạn dung lượng không quá 2M',


        ];
    }
}
