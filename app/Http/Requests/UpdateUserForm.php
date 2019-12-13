<?php

namespace App\Http\Requests;

use DateTime;
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
        $reqDate = new DateTime('now');
        return [
            'username' => 'required|unique:users,username,' . $this->route('id'),
            'email' => 'required|unique:users,email,' . $this->route('id'),
            'password' => 'nullable',
            'role' => 'required',
            'birthday' => 'required|before:' . $reqDate->format('Y-m-d'),
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
            'username.unique' => 'Username đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'role.required' => 'Vui lòng chọn quyền của tài khoản',
            'birthday.required' => "Vui lòng chọn ngày sinh nhật",
            'birthday.before' => "Không được lớn hơn ngày hiện tại",
            "status.required" => "Vui lòng chọn trạng thái của tài khoản",
            'full_name.required' => 'Vui lòng nhập tên đầy đủ',
            "gender.required" => "Vui lòng chọn giới tính",
            "avatar.mimes" => "Ảnh sai định dạng ( chỉ chấp nhận định đạng jpg, jpeg, png )",
            'avatar.max' => "Kích thước của ảnh không được lớn quá 2MB",
        ];
    }
}
