<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSliderForm;
use App\Http\Requests\EditSlider;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //

    public function index()
    {
        $sliders = Slider::orderBy('sort')->get();
        return view('admin2.slider', compact('sliders'));
    }

    public function actionUpdate(Request $request)
    {
        $data = $request->data;
        $sort = $request->sort;
        $count_data = count($data);
        $count_sort = count($sort);
        $i = 1;
        if ($count_data == 6 && $count_sort == 6) {
            foreach ($data as $key => $value) {
                $slider = Slider::find($value);
                $slider->sort = $i;
                $i++;
                $slider->save();
            }
        } else {
            return false;
        }
    }

    public function actionAdd(AddSliderForm $request)
    {
        $model = new Slider();
        $slider = Slider::orderBy('sort', 'DESC')->first();
        if ($slider->sort == 6) {
            return redirect()->route('slider.add')->with('status', 'Không được phép sử dụng quá 6 slider');
        }
        $model->sort = (int)$slider->sort + 1;
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            // lấy tên gốc của ảnh
            $filename = $request->image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('image')->storeAs('upload/image', $filename);
            $request->file('image')->move('upload/image', $filename);
            $model->image = "$path";
        }
        $model->save();
        return redirect()->route('slider.home');
    }

    public function add()
    {
        return view('admin2.addSlider');
    }

    public function update($slider_id) {
        $model = Slider::find($slider_id);
        return view('admin2.editSlider', compact('model'));
    }

    public function updateForm($slider_id, EditSlider $request) {
        $model = Slider::find($slider_id);
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            // lấy tên gốc của ảnh
            $filename = $request->image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('image')->storeAs('upload/image', $filename);
            $request->file('image')->move('upload/image', $filename);
            $model->image = "$path";
        }
        $model->save();
        return redirect()->route('slider.home');
    }

    public function delete() {

    }
}
