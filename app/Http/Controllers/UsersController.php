<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Genres;
use App\Http\Requests\AddUserForm;
use App\Http\Requests\UpdateUserForm;
use App\Model_client\History;
use App\Model_client\UserLikedAlbum;
use App\Model_client\UserLikedPlaylist;
use App\Model_client\UserLikedSong;
use App\Playlist;
use App\PlaylistDetail;
use App\User;
use Illuminate\Support\Facades\Input;

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
        $status = $request->input('status');
        $status2 = $request->input('status2');
        $args = [];
        $args[] = ['users.email', 'like', "%$search%"];
        if ($status != null){
            $args[] = ['users.role', '=', $status];
        }
        if ($status2 != null){
            $args[] = ['users.status', '=', $status2];
        }


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
        if ($request->password !== null) {
            $model->password = password_hash($request->password, PASSWORD_DEFAULT);
        }
        $model->save();
        return redirect()->route('users.home')->with('status', 'Thêm tài khoản thành công');

    }

    public function update($user_id)
    {
        $model = User::find($user_id);
        return view('admin2.users.edit', compact('model'));
    }

    public function actionUpdate(UpdateUserForm $request, $user_id)
    {
        $model = User::find($user_id);
        $current_password = $model->password;
        $model->fill($request->all());
        if ($request->hasFile('avatar')) {
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

        if ($request->password !== null) {
            $model->password = password_hash($request->password, PASSWORD_DEFAULT);
        } else {
            $model->password = $current_password;
        }
        $model->save();
        return redirect()->route('users.home')->with('status', 'Cập nhật tài khoản thành công');
    }

    public function actionDelete($user_id)
    {
        $model = User::find($user_id);
        if ($model->role == 900 && $model->role == 600) {
            return false;
        }
        $playlist = Playlist::where("upload_by_user_id", $user_id)->get();
        $history = History::where('user_id', $user_id)->get();
        $comment = Comment::where('user_id', $user_id)->get();
        $user_liked_albums = UserLikedAlbum::where('user_id', $user_id)->get();
        $user_liked_playlist = UserLikedPlaylist::where('user_id', $user_id)->get();
        $user_liked_song = UserLikedSong::where('user_id', $user_id)->get();
        foreach ($playlist as $item4) {
            $playlist_detail = PlaylistDetail::where('playlist_id', $item4->id);
            $playlist_detail->delete();
        }
        foreach ($playlist as $item) {
            $item->delete();
        }
        foreach ($history as $item2) {
            $item2->delete();
        }
        foreach ($comment as $item3) {
            $item3->delete();
        }
        foreach ($user_liked_albums as $item4) {
            $item4->delete();
        }
        foreach ($user_liked_playlist as $item5) {
            $item5->delete();
        }
        foreach ($user_liked_song as $item6) {
            $item6->delete();
        }
        $model->delete();
        return redirect()->route('users.home')->with('status', 'Xóa tài khoản thành công');

    }
}
