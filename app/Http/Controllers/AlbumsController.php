<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Http\Requests\AddAlbumForm;
use App\Http\Requests\AddArtistForm;
use App\Http\Requests\EditAlbum;
use App\Song;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(20);
        return view('admin2.albums.index', compact('albums'));
    }

    public function getData(Request $request)
    {
        $columns = ['albums.id', 'albums.title'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['albums.title', 'like', "%$search%"];


        $total = Album::count();

        $data = Album::where($args)->select('albums.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();

        $data->load('artist');


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
        $artists = Artist::all();
        return view('admin2.albums.add', compact('artists'));
    }

    public function actionAdd(AddAlbumForm $request)
    {
        $model = new Album;
        $model->like = 0;
        $model->fill($request->all());
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
        if ($model->save()) {
            if ($request['person_song'] !== null) {
                foreach ($request['person_song'] as $key => $value) {
                    $songs = Song::find($value);
                    $songs->album_id = $model->id;
                    $songs->save();
                }
                return redirect()->route('albums.home')->with('status', 'Thêm album thành công');
            }
        }
    }

    public function update($id)
    {
        $album = Album::find($id);
        $songs = Song::where('album_id', $id)->get();
        $all_song = Song::all();
        $artists = Artist::all();
        return view('admin2.albums.edit', compact(['album', 'songs', 'artists', 'all_song']));
    }

    public function actionUpdate(EditAlbum $request, $album_id)
    {
        $model = Album::find($album_id);
        $model->fill($request->all());
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
        if ($model->save()) {
            if ($request['person_song'] !== null) {
                foreach ($request['person_song'] as $key => $value) {
                    $songs = Song::find($value);
                    $songs->album_id = $model->id;
                    $songs->save();
                }
                return redirect()->route('albums.home')->with('status', 'Chỉnh sửa album thành công');
            }
        }
    }

    public function actionDelete($album_id)
    {
        $model = Album::find($album_id);
        $songs = Song::find()->where('album_id', $album_id);
        foreach ($songs as $song) {
            $song->album_id = 0;
            $songs->save();
        }
        if ($model->delete()) {
            return redirect()->route('albums.home')->with('status', 'Xóa album thành công');
        };
    }

}
