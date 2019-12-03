<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
        $validate = [
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                'exists:users,email',
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'email.required' => 'Bạn phải nhập email !',
            'email.regex' => 'Định dạng email không đúng !',
            'email.exists' => 'Email bạn đã nhập không khớp với bất kỳ tài khoản nào!',
        ];
    }
}
