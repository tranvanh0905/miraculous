<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWebsettingForm extends FormRequest
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
             'name_website' => 'required|max:20',
             'phone_website' => 'required|numeric',
             'email_website' => 'required|regex:/^.+@.+$/i',

             
        ];
    }
    public function messages(){
        return [
            'name_website.required' => "Hãy nhập tên website",
            'name_website.max' => "Tên website không được vượt quá 20 ký tự",
            'phone_website.numeric'=>"Vui lòng nhập số",
            'phone_website.required' => "Vui lòng nhập số điện thoại",
            'email_website.required' => "Vui lòng nhập email website",
            'email_website.regex' => "Vui lòng nhập đúng định dạng",
           
        ];
    }
}
