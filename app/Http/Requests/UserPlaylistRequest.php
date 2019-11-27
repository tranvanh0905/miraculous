<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPlaylistRequest extends FormRequest
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
            'description' => [
                'required',
            ],
            'name' => [
                'required',
                'max: 50',
            ]
        ];

        if (!$this->playlistId) {
            $validate['cover_image'] = 'required|file|mimes:jpeg,png|max:2048';
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'description.required' => 'Không được để trống mô tả !',
            'name.required' => 'Không được để trống tên danh sách phát !',
            'name.max' => 'Tên danh sách phát tối đa 50 kí tự!',
            'cover_image.required' => "Bạn không được để trống ảnh danh sách phát!",
            'cover_image.mimes' => "Ảnh tải lên phải có định dạng .jpg .jpeg .png",
            'cover_image.max' => 'Ảnh tải lên giới hạn dung lượng không quá 2M',
        ];
    }
}
