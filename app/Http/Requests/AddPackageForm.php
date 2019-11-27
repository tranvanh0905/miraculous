<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPackageForm extends FormRequest
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
            'name_package' => 'required|unique:artists',
            'price' => 'required',
            'content' => 'required',
            
        ];
    }
    public function messages(){
        return [
            'name_package.required' => "Hãy nhập tên gói",
            'name_package.unique' => "Tên gói bị trùng",
            'price.required'=>"Vui lòng nhập giá",
            'content.required' => "Vui lòng nhập nội dung",
        ];
    }
}
