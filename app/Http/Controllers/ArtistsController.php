<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\ArtistSongDetail;
use App\Country;
use App\Http\Requests\AddArtistForm;
use App\Http\Requests\EditArtistForm;
use App\Song;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artist::paginate(20);

        return view('admin2.artists.index', compact('artists'));
    }

    public function getData(Request $request)
    {
        $columns = ['artists.id', 'artists.nick_name'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['artists.nick_name', 'like', "%$search%"];


        $total = Artist::count();

        $data = Artist::where($args)->select('artists.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();

        $data->load('songs');


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
        return view('admin2.artists.add');
    }

    public function actionDelete($id)
    {
        $model = Artist::find($id);
        if ($model !== null) {
            foreach ($model->get() as $key => $value) {
                $model_details = ArtistSongDetail::where('artist_id', $value['id']);
                $model_albums = Album::where('artist_id', $id);
                if ($model_albums !== null) {
                    $model_albums->delete();
                }
                $model_details->delete();
            }
        }
        if ($model !== null) {
            $model->delete();
            return redirect()->route('artists.home')->with('status', 'Xóa ca sĩ thành công');
        } else {
            return redirect()->route('artists.home')->with('status', 'Xóa ca sĩ thành công');
        }
    }

    public function actionAdd(AddArtistForm $request)
    {
        $model = new Artist();
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
        if ($request->hasFile('cover_image')) {
            // lấy tên gốc của ảnh
            $filename = $request->cover_image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('cover_image')->storeAs('upload/image', $filename);
            $request->file('cover_image')->move('upload/image', $filename);
            $model->cover_image = "$path";
        }
        $model->save();
        return redirect()->route('artists.home')->with('status', 'Thêm ca sĩ thành công');
    }

    public function update($artist_id)
    {
        $model = Artist::find($artist_id);
        return view('admin2.artists.edit', compact(['model']));
    }

    public function actionUpdate($artist_id, EditArtistForm $request)
    {
        $model = Artist::find($artist_id);
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
        if ($request->hasFile('cover_image')) {
            // lấy tên gốc của ảnh
            $filename = $request->cover_image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('cover_image')->storeAs('upload/image', $filename);
            $request->file('cover_image')->move('upload/image', $filename);
            $model->cover_image = "$path";
        }
        $model->save();
        return redirect()->route('artists.home')->with('status', 'Chỉnh sửa ca sĩ thành công');
    }
}
