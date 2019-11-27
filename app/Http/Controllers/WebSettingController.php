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
        $model->save();
        return redirect()->route('websetting.home')->with('status', 'Chỉnh sửa cài đặt thành công');
    }
}
