<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => [
                'required',
                'max:200'
            ]
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'content.required' => 'Bạn phải nhập bình luận!',
            'content.max' => 'Bình luận tối đa 200 kí tự',
        ];
    }
}
