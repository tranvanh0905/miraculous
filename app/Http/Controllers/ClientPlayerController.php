<?php

namespace App\Http\Controllers;

use App\Http\Resources\Song as SongResource;
use App\Http\Resources\UserPlaylist;
use App\Model_client\Album;
use App\Model_client\Playlist;
use App\Model_client\PlaylistDetail;
use App\Model_client\Song;
use App\Model_client\UserLikedAlbum;
use App\Model_client\UserLikedPlaylist;
use App\Model_client\UserLikedSong;
use Illuminate\Support\Facades\Auth;

class ClientPlayerController extends Controller
{
    //-------------------------------------------//

    //Player controller

    public function getSong($songId)
    {
        $modelSong = new Song();
        $song = $modelSong->where('id', '=', $songId)->get();

        if ($song == null) {
            return response()->json(array('msg' => 'Khong co bai hat'), 404);
        } else {
            $data = $song;
            return SongResource::collection($data);
        }

    }

    public function getSongOfAlbum($albumId)
    {
        $modelSong = new Song();
        $songs = $modelSong->where('album_id', '=', $albumId)->get();

        if ($songs == null) {
            return response()->json(array('msg' => 'Khong co bai hat'), 404);
        } else {
            $data = $songs;
            return SongResource::collection($data);
        }
    }

    public function getSongOfPlaylist($playlistId)
    {
        $songs = Playlist::find($playlistId)->load('songs');


        if ($songs == null) {
            return response()->json(array('msg' => 'Khong co bai hat'), 404);
        } else {
            $data = $songs->songs;
            return SongResource::collection($data);
        }
    }

    public function updateView($songId)
    {
        $modelSong = new Song();
        $song = $modelSong->find($songId);

        if ($song == null) {
            return response()->json(array('msg' => 'Khong co bai hat'), 404);
        } else {
            $modelSong->where('id', $songId)->increment('view', 1);

            return response()->json(array('msg' => '+1 view'), 200);
        }
    }

    //-----------------------------------///
    //Check like song

    public function checkLikeSong($songId)
    {
        $song = UserLikedSong::where('user_id', '=', Auth::id())->where('song_id', '=', $songId)->exists();

        if (!$song) {
            return response()->json(array('msg' => 'dontLike'));
        } else {
            return response()->json(array('msg' => 'liked'));
        }
    }

    //Like song

    public function likeSong($id)
    {
        $likeSong = new UserLikedSong();

        $checkSongLiked = UserLikedSong::where('song_id', '=', $id)->where('user_id', '=', Auth::user()->id)->get();

        if (count($checkSongLiked) != 1) {
            Song::where('id', '=', $id)->increment('like');
            $likeSong->user_id = Auth::user()->id;
            $likeSong->song_id = $id;
            $likeSong->save();

            return response()->json(['msg' => 'Yêu thích bài hát thành công', 'action' => 'liked']);
        } else {
            Song::where('id', '=', $id)->decrement('like');
            UserLikedSong::where('song_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

            return response()->json(['msg' => 'Bỏ yêu thích bài hát thành công', 'action' => 'dislike']);
        }
    }

    //Like album

    public function likeALbum($id)
    {
        $likeAlbum = new UserLikedAlbum();

        $checkAlbumLiked = UserLikedAlbum::where('album_id', '=', $id)->where('user_id', '=', Auth::user()->id)->exists();

        if (!$checkAlbumLiked) {
            Album::where('id', '=', $id)->increment('like');;
            $likeAlbum->user_id = Auth::user()->id;
            $likeAlbum->album_id = $id;
            $likeAlbum->save();

            $album = Album::find($id);

            return response()->json(['msg' => 'Yêu thích album thành công', 'like' => $album->like, 'action' => 'liked']);
        } else {
            Album::where('id', '=', $id)->decrement('like');
            UserLikedAlbum::where('album_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

            $album = Album::find($id);
            return response()->json(['msg' => 'Bỏ yêu thích album thành công', 'like' => $album->like, 'action' => 'unliked']);
        }
    }

    //Like playlist

    public function likePlaylist($id)
    {
        $likePlaylist = new UserLikedPlaylist();

        $checkPlaylistLiked = UserLikedPlaylist::where('playlist_id', '=', $id)->where('user_id', '=', Auth::user()->id)->exists();

        if (!$checkPlaylistLiked) {
            Playlist::where('id', '=', $id)->increment('like');
            $likePlaylist->user_id = Auth::user()->id;
            $likePlaylist->playlist_id = $id;
            $likePlaylist->save();
            $playlist = Playlist::find($id);

            return response()->json(['msg' => 'Yêu thích danh sách phát thành công', 'like' => $playlist->like, 'action' => 'liked']);
        } else {
            Playlist::where('id', '=', $id)->decrement('like');
            UserLikedPlaylist::where('playlist_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();
            $playlist = Playlist::find($id);
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
