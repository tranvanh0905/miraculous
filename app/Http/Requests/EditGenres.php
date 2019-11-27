<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGenres extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thể loại',
            'description.required' => 'Vui lòng nhập mô tả',
            'status.required' => 'Vui lòng chọn trạng thái',
            'image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
        ];
    }
}
