<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Model_client\Album;
use App\Model_client\Artist;
use App\Model_client\Comment;
use App\Model_client\Genres;
use App\Model_client\Playlist;
use App\Model_client\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function foo\func;


class ClientController extends Controller
{
    //-------------------------------------------//

    //Index

    public function index()
    {

        $randomSong = Song::inRandomOrder()->where('status', '=', 1)
            ->limit(10)->with('artists')
            ->get();

        $latestSongs = Song::where('status', '=', 1)->orderBy('release_date', 'desc')
            ->limit(30)->with('artists')
            ->get();

        $mostViewAlbum = Album::where('status', '=', 1)->orderBy('like', 'desc')->get();

        $allGenres = Genres::latest('id')->where('status', '=', 1)->limit(10)->get();

        $latestAbums = Album::latest('release_date')->where('status', '=', 1)->limit(10)->get();

        $playLists = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->where('playlists.status', '=', 1)->limit(4)
            ->get();

        $playLists->each(function ($q) {
            $q->load('getThreeSongs');
        });

        $artists = Artist::where('status', '=', 1)->orderBy('follow', 'desc')->with('userFollows')->limit(12)->get();

        return view('client.index', compact('latestSongs', 'allGenres', 'latestAbums', 'randomSong', 'mostViewAlbum', 'playLists', 'artists'));
    }

    //Khám phá
    public function brower()
    {
        $allSong = Song::select('songs.*', 'users.id as user_id', 'users.role')->join('users', 'songs.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)
            ->limit(25)->with('artists')
            ->get();

        $allPlaylist = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->limit(20)
            ->get();

        $genres = Genres::where('status', '=', 1)->limit(10)->get();
        return view('client.brower', compact('allSong', 'allAlbum', 'allPlaylist', 'genres'));
    }

    //Bảng xếp hạng bài hát
    public function chartSong()
    {

        $top50song = User::where('role', '>', 100)->with(['songs' => function ($query) {
            $query->orderBy('view', 'desc')->limit(50);
        }])->get()->pluck('songs')->flatten();

        $allGenres = Genres::inRandomOrder('id')->limit(10)->get();

        return view('client.chart-song', compact('top50song', 'allGenres'));
    }

    //Bảng xếp hạng album
    public function chartAlbum()
    {

        $top50album = Album::orderBy('like', 'desc')->get();

        $allGenres = Genres::inRandomOrder('id')->limit(10)->get();

        return view('client.chart-album', compact('top50album', 'allGenres'));
    }

    //Tất cả bài hát, album, playlist

    public function all($type)
    {
        if ($type == 'albums') {
            $allAlbum = Album::orderBy('release_date', 'desc')->with('artist')->paginate(50);

            return view('client.all', compact('allAlbum', 'type'));
        } else if ($type == 'playlists') {
            $allPlaylist = Playlist::where('status', '=', 1)->orderBy('id', 'desc')->with('songs')->paginate(50);

            return view('client.all', compact('allPlaylist', 'type'));
        } else if ($type == 'songs') {

            $allSong = Song::where('status', '=', 1)->orderBy('release_date', 'desc')->with('artists')->paginate(50);

            return view('client.all', compact('allSong', 'type'));
        } else if ($type == 'artists') {
            $allArtist = Artist::where('status', '=', 1)->orderBy('id', 'desc')->with('songs')->paginate(50);

            return view('client.all', compact('allArtist', 'type'));
        } else if ($type == 'genres') {
            $allGenres = Genres::where('status', '=', 1)->orderBy('id', 'desc')->paginate(50);

            return view('client.all', compact('allGenres', 'type'));
        }

        return redirect(route('client.home'));

    }

    //Chi tiết bài hát

    public function singleSong($songId)
    {

        $singleSong = Song::find($songId)->load('artists');

        $comment = Comment::where('song_id', '=', $songId)->where('status', '=', 1)->with('user')->get();

        $relatedSong = Song::where('genres_id', '=', $singleSong->genres_id)->where('status', '=', 1)->limit(20)->get();

        $relatedSongArtist = Song::whereHas('artists', function ($query) use ($singleSong) {
            foreach ($singleSong->artists as $artist) {
                $query->where('artist_id', '=', $artist->id)->where('status', '=', 1)->where('song_id', '<>', $singleSong->id);
            }
        })->where('status', '=', 1)->get();


        $genres = Genres::latest('id')->where('status', '=', 1)->limit(10)->get();

        $artists = Artist::where('status', '=', 1)->orderBy('follow', 'desc')->limit(10)->get();

        $mostLikeSong = Song::where('status', '=', 1)->orderBy('like')->limit(10)->with('artists')->get();


        return view('client.detail-page.single-song', compact('singleSong', 'relatedSong', 'genres', 'artists', 'mostLikeSong', 'relatedSongArtist',
            'comment'));
    }

    //Bình luận bài hát

    public function commentSong(CommentRequest $request)
    {
        $model = new Comment();
        $model->user_id = Auth::id();
        $model->status = 1;
        $model->fill($request->all());
        $model->save();

        return response()->json(['success' => 'Thêm bình luận thành công']);
    }

    //Lấy bình luận bài hát

    public function fetchComment(Request $request)
    {
        $allComment = Comment::where('song_id', '=', $request->id)->orderBy('id', 'desc')->get();

        return view('client.fetch-comment', compact('allComment'));
    }

    //Chi tiết album

    public function singleAlbum($albumId)
    {

        $singleAlbum = Album::find($albumId);

        $songOfAlbum = Song::where('album_id', '=', $albumId)->where('status', '=', 1)->get();

        $relateAlbum = Album::where('artist_id', '=', $singleAlbum->artist_id)->where('id', '<>', $singleAlbum->id)->where('status', '=', 1)->get();

        $otherAlbum = Album::where('status', '=', 1)->where('artist_id', '<>', $singleAlbum->artist_id)->inRandomOrder()->get();

        return view('client.detail-page.single-album', compact('singleAlbum', 'songOfAlbum', 'relateAlbum', 'otherAlbum'));
    }

    //Chi tiết danh sách phát

    public function singlePlaylist($playlistId)
    {

        $singlePlaylist = Playlist::find($playlistId)->load(['songs' => function($query){
            $query->where('status', '=', 1);
        }]);

        $relatedPlaylist = Playlist::whereHas('user', function ($query) {
            $query->where('role', '>', 500);
        })->where('status', '=', 1)->limit(10)->get();

        return view('client.detail-page.single-playlist', compact('singlePlaylist', 'relatedPlaylist'));
    }

    //Chi tiết thể loại

    public function singleGenres($genresId)
    {
        $genres = Genres::find($genresId);

        $songOfGenres = Song::where('genres_id', '=', $genresId)->where('status', '=', 1)->paginate(42);

        $otherGenres = Genres::limit(6)->where('status', '=', 1)->get();

        $mostViewOfGenres = Song::where('genres_id', '=', $genresId)->where('status', '=', 1)->orderBy('view', 'desc')->get();

        return view('client.detail-page.single-genres', compact('genres', 'songOfGenres', 'otherGenres', 'mostViewOfGenres'));
    }

    //Chi tiết ca sĩ

    public function singleArtist($artistId)
    {
        $singleArtist = Artist::where('id', '=', $artistId)->with(['songs' => function ($query) {
            $query->where('status', '=', 1);
        }, 'albums' => function ($query) {
            $query->where('status', '=', 1);
        }])->first();

        $otherArtist = Artist::where('status', '=', 1)->limit(12)->get();


        return view('client.detail-page.single-artist', compact('singleArtist', 'otherArtist'));
    }

    //Trang tìm kiếm

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $outputSong = '';
            $outputAlbum = '';
            $outputArtist = '';

            $songs = Song::where('name', 'LIKE', '%' . $request->search . '%')->where('status', '=', 1)->get();
            $albums = Album::where('title', 'LIKE', '%' . $request->search . '%')->where('status', '=', 1)->get();
            $artists = Artist::where('nick_name', 'LIKE', '%' . $request->search . '%')->where('status', '=', 1)->get();

            if ($songs && $songs != '') {
                foreach ($songs as $key => $song) {
                    $outputSong .= '<div class="col-auto">
                                <div class="img-box-horizontal music-img-box h-g-bg">
                                <div class="img-box img-box-sm box-rounded-sm">
                                <img src="' . url($song->cover_image) . '" alt="' . $song->name . '"></div><div class="des">
                                    <h6 class="title"><a href="' . url('singleSong/' . $song->id) . '">' . $song->name . '</a></h6>
                                    <p class="sub-title"><a href="#">Bing Crosby</a></p>
                                </div>
                                <div class="hover-state d-flex justify-content-between align-items-center">
                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"><i class="play-icon"></i></span>
                                    <div class="d-flex align-items-center">
                                        <span class="adonis-icon text-light pointer mr-2 icon-2x"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"><use xlink:href="#icon-heart-blank"></use></svg></span>
                                        <span class="pointer dropdown-menu-toggle"><span class="icon-dot-nav-horizontal text-light"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            if ($albums) {
                foreach ($albums as $key => $album) {
                    $outputAlbum .= '<div class="col-auto">
                                        <div class="music-img-box mb-e-30 mb-e-lg-40">
                                            <div class="img-box box-rounded-sm">
                                                <img class="retina" src="' . url($album->cover_image) . '"
                                                     data-2x="' . url($album->cover_image) . '" alt="' . url($album->title) . '">
                                                <div class="hover-state">
                                                    <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="album" data-album-id="' . $album->id . '">
                                                            <i class="play-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="title"><a href="' . route('singleAlbum', ['albumId' => $album->id]) . '">' . $album->title . '</a></h6>
                                            <p class="sub-title category"><a href="' . route('singleArtist', ['artistId' => $album->artist_id]) . '">'
                        . $album->artist->nick_name . '</a></p>
                                        </div>
                                    </div>';
                }
            }

            if ($artists) {
                foreach ($artists as $key => $artist) {
                    $outputArtist .= '<div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                                <div class="img-box rounded-circle img-artist-index">
                                    <img class="retina" src="' . url($artist->avatar) . '"
                                         data-2x="' . url($artist->avatar) . '" alt="' . $artist->nick_name . '">
                                </div>
                                <div class="desc top-sm text-center">
                                    <h5 class="title fs-3">
                                        <a href="{{route(\'singleArtist\', [\'artistId\' => $artist->id])}}" class="f-w-500
                                        h-underline">' . $artist->nick_name . '</a>
                                    </h5>
                                    <p class="sub-title"><span class="count-follow" data-artist-id="{{$artist->id}}">' . $artist->follow . '</span>
                                        người quan tâm</p>
                                </div>
                            </div>
                        </div>';
                }
            }

            if ($outputSong == '') {
                $outputSong = '<div class="col-12 font-weight-bold text-center"> Không có bài hát giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            if ($outputAlbum == '') {
                $outputAlbum = '<div class="col-12 font-weight-bold text-center"> Không có album giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            if ($artists == '') {
                $outputArtist = '<div class="col-12 font-weight-bold text-center"> Không có ca sĩ giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            return response(['songs' => $outputSong, 'albums' => $outputAlbum, 'artists' => $outputArtist]);
        }
    }

}


