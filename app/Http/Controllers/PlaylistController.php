<?php

namespace App\Http\Controllers;

use App\Album;
use App\ArtistSongDetail;
use App\Genres;
use App\Http\Requests\AddPlaylistForm;
use App\Http\Requests\EditPlaylist;
use App\Model_client\UserLikedPlaylist;
use App\Playlist;
use App\PlaylistDetail;
use App\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{

    public function index()
    {
        $playlists = Playlist::paginate(20);
        return view('admin2.playlists.index', compact('playlists'));
    }
    public function getData(Request $request)
    {
        $columns = ['playlists.id', 'playlists.name'];

        $limit = $request->input('length');
        $start = $request->input('start');
        $orders = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('searchs');
        $status = $request->input('status');
        $args = [];
        $args[] = ['playlists.name', 'like', "%$search%"];
        if ($status != null){
            $args[] = ['playlists.status', '=', $status];
        }



        $total = Playlist::count();

        $data = Playlist::where($args)->select('playlists.*')
            ->where('upload_by_user_id', User::where('role', 900)->first()->id)
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
        $song = Song::all();
        return view('admin2.playlists.add', compact('song'));
    }

    public function update($playlist_id)
    {
        $playlist = Playlist::find($playlist_id);
        $song_of_playlist = PlaylistDetail::where('playlist_id', $playlist_id)->get();
        $song = Song::all();
        return view('admin2.playlists.edit', compact(['song', 'playlist', 'song_of_playlist']));
    }

    public function actionUpdate(EditPlaylist $request, $playlist_id) {
        $playlist = Playlist::find($playlist_id);
        $playlist->fill($request->all());
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
            $playlist->cover_image = "$path";
        }
        if ($playlist->save()) {

            if ($request['song_playlist'] !== null) {
                $playlistDetail_old = PlaylistDetail::where('playlist_id', $playlist->id);
                $playlistDetail_old->delete();
                foreach ($request['song_playlist'] as $list) {
                    $playlistDetail = new PlaylistDetail;
                    $playlistDetail->playlist_id = $playlist->id;
                    $playlistDetail->song_id = $list;
                    $playlistDetail->save();
                }
                return redirect()->route('playlist.home')->with('status', 'Cập nhật danh sách phát thành công');

            }
            return redirect()->route('playlist.add')->with('status', 'Vui lòng chọn bài hát');

        };
        return redirect()->route('playlist.home')->with('status', 'Cập nhật danh sách phát thành công');

    }
    public function actionAdd(AddPlaylistForm $request)
    {
        $model = new Playlist;
        $model->upload_by_user_id = Auth::user()->id;
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
            if ($request['song_playlist'] !== null) {
                foreach ($request['song_playlist'] as $list) {
                    $playlistDetail = new PlaylistDetail;
                    $playlistDetail->playlist_id = $model->id;
                    $playlistDetail->song_id = $list;
                    $playlistDetail->save();
                }
                return redirect()->route('playlist.home')->with('status', 'Thêm danh sách phát thành công');
            }
            return redirect()->route('playlist.add')->with('status', 'Vui lòng chọn bài hát');
        };
        return redirect()->route('playlist.home')->with('status', 'Thêm danh sách phát thành công');
    }

    public function actionDelete($id) {
        $model = Playlist::find($id);
        $modelPlaylist = PlaylistDetail::where('playlist_id', $id)->get();
        $modelUserLike = UserLikedPlaylist::where('playlist_id', $id)->get();
        foreach ($modelPlaylist as $list) {
            $list->delete();
        }
        foreach ($modelUserLike as $list2) {
            $list2->delete();
        }
        if ($model !== null) {
            $model->delete();
            return redirect()->route('playlist.home')->with('status', 'Xóa danh sách thành công');
        } else {
            return redirect()->route('playlist.home')->with('status', 'Xóa danh sách thành công');
        }
    }
}
