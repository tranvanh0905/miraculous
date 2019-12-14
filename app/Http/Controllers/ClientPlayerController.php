<?php

namespace App\Http\Controllers;

use App\Http\Resources\Song as SongResource;
use App\Http\Resources\UserPlaylist;
use App\Model_client\Album;
use App\Model_client\DailyViewSong;
use App\Model_client\Playlist;
use App\Model_client\PlaylistDetail;
use App\Model_client\Song;
use App\Model_client\UserLikedAlbum;
use App\Model_client\UserLikedPlaylist;
use App\Model_client\UserLikedSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPlayerController extends Controller
{
    //-------------------------------------------//

    //Player controller

    public function getSong(Request $request)
    {
        $modelSong = new Song();
        $song = $modelSong->where('id', '=', $request->songId)->where('status', '=', 1)->with('artists')->get();

        if ($song->isEmpty()) {
            return response()->json(['msgErrors' => 'Bài hát hiện tại bị lỗi, vui lòng thử lại !']);
        } else {
            $data = $song;
            return SongResource::collection($data);
        }

    }

    public function getSongSuggest(Request $request)
    {
        $songSuggest = [];
        $artist = [];
        $idSongAlbum = [];
        $idSongArtist = [];
        $idSuggest = $request->idSugesst;
        $currentId = $request->currentId;

        //Lấy data bài hát đang phát
        $main = Song::find($idSuggest)->load('artists');

        //Lấy bài hát cùng album của bài hát đang phát
        if ($main->album_id != 0) {
            $songAlbum = Song::where('album_id', '=', $main->album_id)->whereNotIn('id', $currentId)->where('status', '=', 1)->limit(2)->inRandomOrder()->get();
            //Thêm vào mảng gợi ý bài hát
            foreach ($songAlbum as $item) {
                array_push($songSuggest, $item);
            }
            foreach ($songAlbum as $item) {
                array_push($idSongAlbum, $item->id);
            }
        }

        //Lấy bài hát cùng ca sĩ của bài hát đang phát
        foreach ($main->artists as $a) {
            array_push($artist, $a->id);
        }
        $songArtist = Song::whereHas('artists', function ($query) use ($artist, $currentId) {
            $query->where('status', '=', 1)->whereIn('artist_id', $artist);
        })->whereNotIn('id', $currentId)->whereNotIn('id', $idSongAlbum)->limit(2)->inRandomOrder()->get();

        //Thêm vào mảng gợi ý bài hát
        foreach ($songArtist as $item) {
            array_push($songSuggest, $item);
        }
        foreach ($songArtist as $item) {
            array_push($idSongArtist, $item->id);
        }

        //Lấy bài hát cùng thể loại của bài hát đang phát
        $songGenres = Song::where('genres_id', '=', $main->genres_id)->whereNotIn('id', $currentId)->whereNotIn('id', $idSongAlbum)->whereNotIn('id', $idSongArtist)->where('status', '=', 1)->limit(4)->inRandomOrder()->get();
        //Thêm vào mảng gợi ý bài hát
        foreach ($songGenres as $item) {
            array_push($songSuggest, $item);
        }

        $collection = collect($songSuggest);

        return SongResource::collection($collection);
    }

    public function getSongOfAlbum(Request $request)
    {
        $modelSong = new Song();
        $songs = $modelSong->where('album_id', '=', $request->albumId)->where('status', '=', 1)->get();
        $checkAlbum = Album::where('id', '=', $request->albumId)->where('status', '=', 1)->get();

        if ($songs->isEmpty() || $checkAlbum->isEmpty()) {
            return response()->json(['msgErrors' => 'Album hiện tại bị lỗi, vui lòng thử lại !']);
        } else {
            $data = $songs;
            return SongResource::collection($data);
        }
    }

    public function getSongOfPlaylist(Request $request)
    {
        $check_playlist_already = Playlist::where('id', '=', $request->playlistId)->exists();

        if ($check_playlist_already) {
            $songs = Playlist::find($request->playlistId)->load('songs');

            $data = $songs->songs;
            return SongResource::collection($data);
        } else {
            return response()->json(['msgErrors' => 'Danh sách phát hiện tại bị lỗi, vui lòng thử lại !']);
        }
    }

    public function getSongGuest()
    {
        $song = Song::orderBy('release_date', 'desc')->where('status', '=', 1)->with('artists')->limit(1)->get();

        $data = $song;
        return SongResource::collection($data);
    }

    public function updateView(Request $request)
    {
        $view = new Song();

        $view->where('id', $request->songId)->increment('view', 1);

        return response()->json(['msg' => '+1 view']);
    }

    public function updateViewDaily(Request $request)
    {
        $dailyView = new DailyViewSong();

        $check = DailyViewSong::where('song_id', '=', $request->songId)->exists();

        if ($check) {
            $song = $dailyView->where('song_id', $request->songId)->get();

            $yesterday_at_midnight = strtotime("today 1 sec ago");

            if (strtotime($song[0]['date']) < $yesterday_at_midnight) {

                $dailyView->where('song_id', $request->songId)->update(['total_view' => 1]);

                $dailyView->date = now();

//                return response()->json(['msg' => 'reset view hằng ngày và tăng 1 view hằng ngày']);
            } else {
                $dailyView->where('song_id', $request->songId)->increment('total_view', 1);
                $dailyView->date = now();

//                return response()->json(['msg' => 'tăng view hằng ngày như bình thường']);
            }
        } else {
            $dailyView->song_id = $request->songId;
            $dailyView->total_view = 1;
            $dailyView->date = now();
            $dailyView->save();
//            return response()->json(['msg' => '+1 view daily for new song']);
        }

    }

    //-----------------------------------///
    //Check like song

    public function checkLikeSong(Request $request)
    {
        $song = UserLikedSong::where('user_id', '=', Auth::id())->where('song_id', '=', $request->songId)->exists();

        if (!$song) {
            return response()->json(array('msg' => 'dontLike'));
        } else {
            return response()->json(array('msg' => 'liked'));
        }
    }

    //Like song

    public function likeSong(Request $request)
    {
        $likeSong = new UserLikedSong();

        $checkSongLiked = UserLikedSong::where('song_id', '=', $request->songId)->where('user_id', '=', Auth::user()->id)->get();

        if (count($checkSongLiked) != 1) {
            Song::where('id', '=', $request->songId)->increment('like');
            $likeSong->user_id = Auth::user()->id;
            $likeSong->song_id = $request->songId;
            $likeSong->save();

            return response()->json(['msg' => 'Yêu thích bài hát thành công', 'action' => 'liked']);
        } else {
            Song::where('id', '=', $request->songId)->decrement('like');
            UserLikedSong::where('song_id', '=', $request->songId)->where('user_id', '=', Auth::user()->id)->delete();

            return response()->json(['msg' => 'Bỏ yêu thích bài hát thành công', 'action' => 'dislike']);
        }
    }

    //Like album

    public function likeALbum(Request $request)
    {
        $likeAlbum = new UserLikedAlbum();

        $checkAlbumLiked = UserLikedAlbum::where('album_id', '=', $request->albumId)->where('user_id', '=', Auth::user()->id)->exists();

        if (!$checkAlbumLiked) {
            Album::where('id', '=', $request->albumId)->increment('like');;
            $likeAlbum->user_id = Auth::user()->id;
            $likeAlbum->album_id = $request->albumId;
            $likeAlbum->save();

            $album = Album::find($request->albumId);

            return response()->json(['msg' => 'Yêu thích album thành công', 'like' => $album->like, 'action' => 'liked']);
        } else {
            Album::where('id', '=', $request->albumId)->decrement('like');
            UserLikedAlbum::where('album_id', '=', $request->albumId)->where('user_id', '=', Auth::user()->id)->delete();

            $album = Album::find($request->albumId);
            return response()->json(['msg' => 'Bỏ yêu thích album thành công', 'like' => $album->like, 'action' => 'unliked']);
        }
    }

    //Like playlist

    public function likePlaylist(Request $request)
    {
        $likePlaylist = new UserLikedPlaylist();

        $checkPlaylistLiked = UserLikedPlaylist::where('playlist_id', '=', $request->playlistId)->where('user_id', '=', Auth::user()->id)->exists();

        if (!$checkPlaylistLiked) {
            Playlist::where('id', '=', $request->playlistId)->increment('like');
            $likePlaylist->user_id = Auth::user()->id;
            $likePlaylist->playlist_id = $request->playlistId;
            $likePlaylist->save();
            $playlist = Playlist::find($request->playlistId);

            return response()->json(['msg' => 'Yêu thích danh sách phát thành công', 'like' => $playlist->like, 'action' => 'liked']);
        } else {
            Playlist::where('id', '=', $request->playlistId)->decrement('like');
            UserLikedPlaylist::where('playlist_id', '=', $request->playlistId)->where('user_id', '=', Auth::user()->id)->delete();
            $playlist = Playlist::find($request->playlistId);
            return response()->json(['msg' => 'Bỏ yêu thích danh sách phát thành công', 'like' => $playlist->like, 'action' => 'unliked']);
        }
    }

    //Get user playlist

    public function getUserPlaylist()
    {
        $userPlaylist = Playlist::where('upload_by_user_id', '=', Auth::id())->get();

        $data = $userPlaylist;
        return UserPlaylist::collection($data);
    }

    //Add song to playlist

    public function addSongToPlaylist($songid, $playlistid)
    {

        $playlistDetail = new PlaylistDetail();

        $checkSongInPlaylist = PlaylistDetail::where('song_id', '=', $songid)->where('playlist_id', '=', $playlistid)->get();

        if (count($checkSongInPlaylist) != 1) {
            $playlistDetail->song_id = $songid;
            $playlistDetail->playlist_id = $playlistid;
            $playlistDetail->save();
            return response()->json(array('msg' => 'Đã thêm bài hát vào danh sách phát'), 200);
        } else {
            return response()->json(array('msg' => 'Bài hát đã có trong danh sách phát này'), 200);
        }

    }

    //Edit user playlist

    public function libraryUserPlaylistEdit($playlistId)
    {

        return view('client.library-user-playlist-edit');

    }
}
