<?php

namespace App\Http\Controllers;

use App\Genres;
use App\Http\Requests\AddUserForm;
use App\User;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::paginate(20);
        return view('admin2.users.index', compact('users'));
    }

    public function getData(\Illuminate\Http\Request $request)
    {
        $columns = ['users.id', 'users.email'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['users.email', 'like', "%$search%"];


        $total = User::count();

        $data = User::where($args)->select('users.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();


        foreach ($data as $key => $value) {
            $data[$key]['create'] = date('d-m-Y', strtotime($value['created_at']));

        }
        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($total),
            'recordsFiltered' => intval($total),
            'data' => $data,
        ];


        return response()->json($json_data, 200);
    }

    public function add()
    {
        return view('admin2.users.add');
    }

    public function actionAdd(AddUserForm $request)
    {
        $model = new User;
        $model->fill($request->all());
        if ($request->hasFile('avatar')) {
            // lấy tên gốc của ảnh
            $filename = $request->avatar->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('avatar')->storeAs('upload/image', $filename);
            $request->file('avatar')->move('upload/image', $filename);
            $model->avatar = "$path";
        }
        $model->save();
        return redirect()->route('users.home')->with('status', 'Thêm tài khoản thành công');

    }

    public function update()
    {
        return view('admin2.users.edit');
        $model->fill($request->all());
        if ($request->hasFile('avatar')) {
            // lấy tên gốc của ảnh
            $filename = $request->avatar->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('avatar')->storeAs('upload/image', $filename);
            $request->file('avatar')->move('upload/image', $filename);
            $model->avatar = "$path";
        }
    }
}
