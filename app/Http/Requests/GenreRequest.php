<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            'name'        => 'required',
            'description' => 'required',
            'status'      => 'required',
            'image'       => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required'        => 'Vui lòng nhập thể loại',
            'description.required' => 'Vui lòng nhập mô tả',
            'status.required'      => 'Vui lòng chọn trạng thái',
            'image.required'       => 'Vui lòng chọn ảnh',
        ];
    }
}
