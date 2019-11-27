<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UserPlaylistRequest;
use App\Model_client\Album;
use App\Model_client\Artist;
use App\Model_client\Playlist;
use App\Model_client\PlaylistDetail;
use App\Model_client\Song;
use App\Model_client\UserFollowDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientUserController extends Controller
{
    //-------------------------------------------//

    //User page controller

    public function userIndex()
    {
        return view('client.profile.account');
    }

    public function library()
    {

        $likedSong = Song::whereHas('userLikedSongs', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->get();

        $likedPlaylist = Playlist::whereHas('userLikedPlaylists', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->with('songs')->get();


        $likedAlbum = Album::whereHas('userLikedAlbums', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->with('artist')->get();


        $followArtist = Artist::whereHas('userFollows', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->get();


        return view('client.library', compact('likedSong', 'likedPlaylist', 'likedAlbum', 'followArtist'));
    }

    public function librarySong()
    {
        $songLiked = Song::whereHas('userLikedSongs', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->paginate(30);

        return view('client.library-song', compact('songLiked'));
    }

    public function libraryAlbum()
    {
        $likedAlbum = Album::whereHas('userLikedAlbums', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->with('artist')->paginate(30);

        return view('client.library-album', compact('likedAlbum'));
    }

    public function libraryPlaylist()
    {
        $likedPlaylist = Playlist::whereHas('userLikedPlaylists', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->with('songs')->paginate(30);

        return view('client.library-playlist', compact('likedPlaylist'));
    }

    public function libraryArtist()
    {
        return view('client.library-artist');
    }

    //User playlist

    public function libraryUserPlaylist()
    {
        $userPlaylists = Playlist::where('upload_by_user_id', '=', Auth::id())->paginate(30);

        return view('client.library.person-playlist.library-user-playlist', compact('userPlaylists'));
    }

    public function libraryUserPlaylistAdd()
    {
        return view('client.library.person-playlist.library-user-playlist-add');
    }

    public function saveLibraryUserPlaylist(UserPlaylistRequest $request)
    {
        $model = new Playlist();

        if ($request->hasFile('cover_image')) {
            // lấy tên gốc của ảnh
            $filename = $request->cover_image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('cover_image')->storeAs('upload/user/playlist', $filename);
            $request->file('cover_image')->move('upload/user/playlist', $filename);
            $model->cover_image = "$path";
        }

        $model->upload_by_user_id = Auth::id();

        $model->fill($request->all());
        $model->save();

        return redirect(route('user-library-personal-playlist'))->with('status', 'Thêm playlist thành công!');
    }

    public function libraryUserPlaylistEdit($playlistId)
    {
        $userPlaylist = Playlist::find($playlistId);

        return view('client.library.person-playlist.library-user-playlist-edit', compact('userPlaylist'));
    }

    public function saveEditLibraryUserPlaylist(UserPlaylistRequest $request, $playlistId)
    {
        $model = new Playlist();
        $userplaylist = $model->find($playlistId);

        if ($request->hasFile('cover_image')) {
            // lấy tên gốc của ảnh
            $filename = $request->cover_image->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('cover_image')->storeAs('upload/user/playlist', $filename);
            $request->file('cover_image')->move('upload/user/playlist', $filename);
            $userplaylist->cover_image = "$path";
        }

        $userplaylist->upload_by_user_id = Auth::id();

        $userplaylist->fill($request->all());
        $userplaylist->save();

        return redirect(route('user-library-personal-playlist'))->with('status', 'Chỉnh sửa playlist thành công!');
    }

    public function libraryUserPlaylistDelete(Request $request)
    {
        Playlist::where('id', '=', $request->id)->where('upload_by_user_id', '=', Auth::user()->id)->delete();
        PlaylistDetail::where('playlist_id', '=', $request->id)->delete();

        return response()->json(array('msg' => 'Xóa playlist thành công !'), 200);
    }

    public function libraryUserSinglePlaylist($playlistId)
    {
        $singlePlaylist = Playlist::find($playlistId)->load('songs');

        $allGenres = [];
        foreach ($singlePlaylist->songs as $song) {
            array_push($allGenres, $song->genres_id);
        }

        $allId = [];
        foreach ($singlePlaylist->songs as $song) {
            array_push($allId, $song->id);
        }

        $suggestSong = Song::whereIn('genres_id', $allGenres)->
        whereNOTIn('id', $allId)
            ->limit(10)
            ->inRandomOrder()
            ->get();

        return view('client.library.person-playlist.single-playlist', compact('singlePlaylist', 'suggestSong'));
    }

    public function libraySuggestSong($playlistId)
    {

        $singlePlaylist = Playlist::find($playlistId)->load('songs');

        $allGenres = [];
        foreach ($singlePlaylist->songs as $song) {
            array_push($allGenres, $song->genres_id);
        }

        $allId = [];
        foreach ($singlePlaylist->songs as $song) {
            array_push($allId, $song->id);
        }

        $suggestSong = Song::whereIn('genres_id', $allGenres)->
        whereNOTIn('id', $allId)
            ->limit(10)
            ->inRandomOrder()
            ->get();

        return view('client.library.person-playlist.suggest-song', compact('suggestSong', 'singlePlaylist'));
    }

    public function librayRemoveSongOfPlaylist(Request $request)
    {
        PlaylistDetail::where('playlist_id', '=', $request->playlistId)->where('song_id', '=', $request->songId)->delete();

        return response()->json(array('msg' => 'Xóa bài hát khỏi playlist thành công !'), 200);
    }

    //Profile

    public function editAccount()
    {
        return view('client.profile.edit-account');
    }

    public function saveEditAccount(EditProfileRequest $request)
    {
        $model = new User();
        $user = $model->find(Auth::user()->id);

        if ($request->hasFile('avatar')) {
            // lấy tên gốc của ảnh
            $filename = $request->avatar->getClientOriginalName();
            // thay thế ký tự khoảng trắng bằng ký tự '-'
            $filename = str_replace(' ', '-', $filename);
            // thêm đoạn chuỗi không bị trùng đằng trước tên ảnh
            $filename = uniqid() . '-' . $filename;
            // lưu ảnh và trả về đường dẫn
            $path = $request->file('avatar')->storeAs('upload/user', $filename);
            $request->file('avatar')->move('upload/user', $filename);
            $user->avatar = $path;
        }

        $user->fill($request->all());
        $user->save();

        return redirect(route('user-edit-profile'))->with('status', 'Chỉnh sửa hồ sơ thành công!');
    }

    public function upgrade()
    {
        return view('client.profile.upgrade-account');
    }

    public function changePassword()
    {
        return view('client.profile.change-password');
    }

    public function saveChangePassword(ChangePasswordRequest $request)
    {

        User::find(Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect(route('user-change-password'))->with('status', 'Đổi mật khẩu thành công!');

    }

    public function userInvoice()
    {
        return view('client.profile.invoice');
    }

    //-------------------------------------------//

    //Follow artist

    public function followArtist(Request $request)
    {
        $checkFollow = UserFollowDetail::where('user_id', '=', Auth::user()->id)->where('artist_id', '=', $request->artist_id)->get();

        $follow = new UserFollowDetail();
        $follow->user_id = Auth::user()->id;

        if (count($checkFollow) == 1) {
            UserFollowDetail::where('artist_id', '=', $request->artist_id)->where('user_id', '=', Auth::user()->id)->delete();
            Artist::find($request->artist_id)->decrement('follow', 1);
            $artist = Artist::find($request->artist_id);

            return response()->json(['msg' => 'Bỏ quan tâm ca sĩ', 'follow' => $artist->follow, 'type' => 'unfollow']);
        } else {
            $follow->fill($request->all());
            $follow->save();
            Artist::find($request->artist_id)->increment('follow', 1);
            $artist = Artist::find($request->artist_id);

            return response()->json(['msg' => 'Quan tâm ca sĩ', 'follow' => $artist->follow, 'type' => 'follow']);
        }
    }
}
