<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class EditArtistForm extends FormRequest
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
            'nick_name' => 'required',
            'full_name' => 'required',
            'avatar' => 'mimes:jpg,jpeg,png|max:2048',
            'cover_image' => 'mimes:jpg,jpeg,png|max:2048',
            'about' => 'required',
            'birthday' => 'required|before:' . $reqDate->format('Y-m-d'),
            'date_of_death' => 'required|before:' .$reqDate->format('Y-m-d') ,

            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nick_name.required' => "Vui lòng nhập tên ca sĩ",
            'full_name.required' => "Vui lòng nhập đầy đủ họ và tên",
            'avatar.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif",
            'avatar.max' => 'Ảnh giới hạn dung lượng không quá 2M',
            'cover_image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif",
            'cover_image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
            'about.required' => "Vui lòng nhập giới thiệu ca sĩ",
            'birthday.required' => "Vui lòng nhập ngày sinh ca sĩ",
            'birthday.before' => "Không được lớn hơn ngày hiện tại",
            'date_of_death.before' => 'Không được lớn hơn ngày hiện tại',

            'status.required' => "Vui lòng chọn trạng thái",
        ];
    }
}
