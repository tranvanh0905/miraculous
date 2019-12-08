<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSettingRequest;
use App\WebSettings;
use http\Env\Request;

class WebSettingController extends Controller
{
    //
    public function actionIndex()
    {
        $webSettings = WebSettings::all();
        return view('admin2.web-setting', compact('webSettings'));
    }

    public function actionUpdate(WebSettingRequest $request)
    {
        $model = WebSettings::where('id', 1)->first();
        $model->fill($request->all());
        if ($request->hasFile('logo')) {
            // lấy tên gốc của ảnh
            $filename = $request->logo->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('logo')->storeAs('upload/image', $filename);
            $request->file('logo')->move('upload/image', $filename);
            $model->logo = "$path";
        }
        $model->save();
        return redirect()->route('websetting.home')->with('status', 'Chỉnh sửa cài đặt thành công');
    }
}
