<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class AddSong extends FormRequest
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
            //
            'cover_image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'genres_id' => 'required',
            'mp3_url' => 'required|mimes:mpga,wav',
            'name' => 'required|unique:songs',
            'release_date' => 'required|before:' . $reqDate->format('Y-m-d'),

            'person_song' => 'required',
            'lyric' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cover_image.required' => 'Vui lòng chọn ảnh cho bài hát',
            'cover_image.mimes' => "Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png",
            'cover_image.max' => 'Ảnh giới hạn dung lượng không quá 2M',
            'genres_id.required' => 'Vui lòng chọn thể loại bài hát',
            'release_date.before' => 'Không được lớn hơn ngày hiện tại',

            'person_song.required' => 'Vui lòng chọn ca sĩ',
            'release_date.required' => 'Vui lòng chọn ngày phát hành',
            'mp3_url.required' => 'Vui lòng chọn bài hát',
            'mp3_url.mimes' => 'Chỉ chấp nhận nhạc với đuôi .mp3 .wav',
            'name.required' => 'Vui lòng điền tên bài hát',
            'name.unique' => 'Tên bài hát không được trùng',
            'lyric.required' => 'Vui lòng điền lời bài hát',
            'description.required' => 'Vui lòng mô tả bài hát',
        ];
    }
}
