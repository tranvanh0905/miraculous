<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class AddAlbumForm extends FormRequest
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
            'title' => 'required|unique:albums',
            'description' => 'required',
            'cover_image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'artist_id' => 'required',
            'release_date' => 'required|before:' . $reqDate->format('Y-m-d'),
            'person_song' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tên album',
            'title.unique' => 'Không được nhập trùng tên album',
            'description.required' => 'Vui lòng nhập mô tả',
            'cover_image.required' => 'Vui lòng chọn ảnh cho album',
            'cover_image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'cover_image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
            'artist_id.required' => 'Vui lòng chọn ca sĩ',
            'release_date.required' => 'Vui lòng chọn ngày phát hành',
            'release_date.before' => 'Không được lớn hơn ngày hiện tại',
            'person_song.required' => 'Vui lòng chọn bài hát',
        ];
    }
}
