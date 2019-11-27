<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPlaylist extends FormRequest
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
            'description' => 'required',
            'cover_image' => 'mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh sách phát',
            'description.required' => 'Vui lòng nhập mô tả',
            'cover_image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'cover_image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
            'status.required' => 'Vui lòng chọn trạng thái',
        ];
    }
}
