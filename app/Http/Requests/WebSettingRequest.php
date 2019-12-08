<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingRequest extends FormRequest
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
            'phone_website' => 'required',
            'email_website' => "required|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
            'name_website' => 'required',
            'url_facebook' => 'required',
            'url_instagram' => 'required',
            'url_google' => 'required',
            'url_skype' => 'required',
            'about_website' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:2048',

        ];
    }

    public function messages()
    {
        return [
            'phone_website.required' => 'Vui lòng nhập số điện thoại',
            'email_website.required' => 'Vui lòng nhập email',
            'email_website.regex' => "Email không đúng định dạng",
            'name_website.required' => 'Vuii lòng nhập tên website',
            'url_facebook.required' => 'Vui lòng nhập link facebook',
            'url_instagram.required' => 'Vui lòng nhập link instagram',
            'url_google.required' => 'Vui lòng nhập link google',
            'url_skype.required' => 'Vui lòng nhập link skype',
            'about_website.required' => 'Vui lòng nhập mô tả website',
            'logo.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'logo.max' => 'Ảnh giới hạn dung lượng không quá 2M',
        ];
    }
}
