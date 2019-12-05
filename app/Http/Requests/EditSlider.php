<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSlider extends FormRequest
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
            //
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Vui lòng chọn trạng thái',
            'url.required' => 'Vui lòng nhập đường dẫn',
            'image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
        ];
    }
}
