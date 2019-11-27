<?php

namespace App\Http\Controllers;

use App\Artist;
use App\ArtistSongDetail;
use App\Genres;
use App\Http\Requests\AddSong;
use App\Http\Requests\EditSong;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin2.songs.index');
    }

    public function getData(Request $request)
    {
        $columns = ['songs.id', 'songs.name'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $args = [];
        $args[] = ['songs.name', 'like', "%$search%"];


        $total = Song::count();

        $data = Song::where($args)->select('songs.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($orders, $dir)
            ->get();

        $data->load('artists', 'genres');


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
        $genres = Genres::all();
        $artists = Artist::all();
        return view('admin2.songs.add', compact(['genres', 'artists']));
    }

    public function update($song_id)
    {
        $song = Song::find($song_id);
        $genres = Genres::all();
        $artist_song_detail = ArtistSongDetail::where(['song_id' => $song_id])->get();
        $artists = Artist::all();

        return view('admin2.songs.edit', compact(['song', 'genres', 'artists', 'artist_song_detail']));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $search = $request->get('search');
        $songs = Song::where('name', 'like', '%' . $search . '%')->paginate(5);
        return view('admin.songs.index', compact('songs'));
    }

    public function showMore(\Illuminate\Http\Request $request)
    {
        $show_more = $request->get('show_more');
        $songs = Song::paginate($show_more);
        return view('admin.songs.index', compact('songs'));
    }

    public function actionDelete($id)
    {
        $model = Song::find($id);
        if ($model !== null) {
            foreach ($model->get() as $key => $value) {
                $model_details = ArtistSongDetail::where('song_id', $value['id']);
                $model_details->delete();
            }
        }
        if ($model !== null) {
            $model->delete();
            return redirect()->route('songs.home');
        } else {
            return redirect()->route('songs.home');
        }
    }

    public function actionUpdate(EditSong $request, $song_id)
    {
        $model = Song::find($song_id);

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

        if ($request->hasFile('mp3_url')) {
            // lấy tên gốc của ảnh
            $filename = $request->mp3_url->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('mp3_url')->storeAs('upload/mp3', $filename);
            $request->file('mp3_url')->move('upload/mp3', $filename);
            $model->mp3_url = "$path";
        }

        if ($model->save()) {
            foreach ($request->post('person_song') as $key => $value) {
                $artist_song_details_current = ArtistSongDetail::where('song_id', $model->id)->get();
                foreach ($artist_song_details_current as $list) {
                    $list->delete();
                }
                foreach ($request->post('person_song') as $key => $value) {
                    $model_artist_song = new ArtistSongDetail;
                    $model_artist_song->song_id = $model->id;
                    $model_artist_song->artist_id = $value;
                    $model_artist_song->save();
                }
            }
            return redirect()->route('songs.home')->with('status', 'Chỉnh sửa bài hát thành công');
        }

        return redirect()->route('songs.home')->with('status', 'Chỉnh sửa bài hát thành công');
    }

    public function actionAdd(AddSong $request)
    {
        $model = new Song();
        $model->fill($request->all());
        $model->view = 0;
        $model->upload_by_user_id = auth()->id();
        $model->album_id = 0;
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
        if ($request->hasFile('mp3_url')) {
            // lấy tên gốc của ảnh
            $filename = $request->mp3_url->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('mp3_url')->storeAs('upload/mp3', $filename);
            $request->file('mp3_url')->move('upload/mp3', $filename);
            $model->mp3_url = "$path";
        }
        DB::beginTransaction();
        try {
            $model->save();
            foreach ($request->post('person_song') as $key => $value) {
                $model_artist_song = new ArtistSongDetail;
                $model_artist_song->song_id = $model->id;
                $model_artist_song->artist_id = $value;
                $model_artist_song->save();
            }
            DB::commit();
            return redirect()->route('songs.home');
        } catch (Exception $ex) {
            // ghi log lỗi lại
            DB::rollback();
        }
    }
}
