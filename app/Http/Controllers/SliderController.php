<?php

namespace App\Http\Controllers;

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
}
