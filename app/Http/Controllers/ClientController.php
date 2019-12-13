<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Model_client\Album;
use App\Model_client\Artist;
use App\Model_client\Comment;
use App\Model_client\DailyViewSong;
use App\Model_client\Genres;
use App\Model_client\History;
use App\Model_client\Playlist;
use App\Model_client\Song;
use App\Model_client\UserFollowDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function foo\func;


class ClientController extends Controller
{
    //-------------------------------------------//

    //Index

    public function index()
    {
        //Trending song
        $trendSong = DailyViewSong::join('songs', 'daily_views.song_id', '=', 'songs.id')
            ->orderBy('total_view', 'desc')
            ->where('date', '>=', DB::raw('DATE_SUB(NOW(),INTERVAL 24 HOUR)'))
            ->where('status', '=', 1)
            ->limit(10)
            ->get();


        $latestSongs = Song::where('status', '=', 1)->orderBy('release_date', 'desc')
            ->limit(30)->with('artists')
            ->get();

        $mostViewAlbum = Album::where('status', '=', 1)->orderBy('like', 'desc')->limit(6)->get();

        $allGenres = Genres::latest('id')->where('status', '=', 1)->limit(10)->get();

        $latestAbums = Album::latest('release_date')->where('status', '=', 1)->limit(10)->get();

        $playLists = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->where('playlists.status', '=', 1)->limit(4)
            ->get();

        $playLists->each(function ($q) {
            $q->load(['getThreeSongs' => function($query){
                $query->where('status', '=', 1);
            }]);
        });

        $artists = Artist::where('status', '=', 1)->orderBy('follow', 'desc')->with('userFollows')->limit(12)->get();

        return view('client.index', compact('latestSongs', 'allGenres', 'latestAbums', 'mostViewAlbum', 'playLists', 'artists', 'trendSong'));
    }

    //Khám phá
    public function brower()
    {
        $allSongId = [];
        $allUser = [];
        $allSuggestSong = [];
        $allArtistFollow = [];
        $allSongInHistory = [];
        $userId = Auth::id();

        $getArtistFollow = UserFollowDetail::where('user_id', '=', $userId)->get();
        foreach ($getArtistFollow as $artist) {
            array_push($allArtistFollow, $artist->artist_id);
        }

        $getSongInHistory = History::where('user_id', '=', $userId)->get();
        foreach ($getSongInHistory as $song) {
            array_push($allSongInHistory, $song->song_id);
        }


        $getSongOfArtistFollow = Song::whereHas('artists', function ($query) use ($allArtistFollow) {
            $query->whereIn('artist_id', $allArtistFollow)->where('status', '=', 1);
        })->where('status', '=', 1)->whereNotIn('id', $allSongInHistory)->inRandomOrder()->limit(20)->get();


        $mostView12 = Song::whereHas('dailyView', function ($query) {
            $query->where('daily_views.date', '>=', DB::raw('DATE_SUB(NOW(),INTERVAL 12 HOUR)'));
        })->get();

        $historySelf = History::where('user_id', '=', $userId)->get();

        foreach ($historySelf as $song) {
            array_push($allSongId, $song->song_id);
        }

        $findUser = History::whereIn('song_id', $allSongId)->where('user_id', '<>', $userId)->get();

        foreach ($findUser as $user) {
            array_push($allUser, $user->user_id);
        }

        $findSong = History::whereIn('user_id', $allUser)->where('user_id', '<>', $userId)->whereNOTIn('song_id', $allSongId)->get();

        foreach ($findSong as $song) {
            array_push($allSuggestSong, $song->song_id);
        }

        $suggestSong = Song::whereIn('id', $allSuggestSong)->get();

        $genres = Genres::where('status', '=', 1)->limit(10)->get();

        $allSong = Song::orderBy('release_date', 'desc')->limit(30)->get();

        $allAlbum = Album::orderBy('release_date', 'desc')->limit(30)->get();

        $allPlaylist = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->where('playlists.status', '=', 1)->limit(30)
            ->get();;

        $allArtitst = Artist::orderBy('id', 'desc')->limit(30)->get();

        return view('client.brower', compact('genres', 'mostView12', 'suggestSong', 'allSong', 'allAlbum', 'allPlaylist', 'allArtitst', 'getSongOfArtistFollow'));
    }

    //Tất cả bảng xếp hạng
    public function chart()
    {
        return view('client.chart.chart');
    }

    //Bảng xếp hạng bài hát
    public function chartSong()
    {

        $top50song = User::where('role', '>', 100)->with(['songs' => function ($query) {
            $query->where('status', '=', 1)->orderBy('view', 'desc')->limit(50);
        }])->get()->pluck('songs')->flatten();

        $allGenres = Genres::inRandomOrder()->limit(10)->get();

        return view('client.chart.chart-song', compact('top50song', 'allGenres'));
    }

    //Bảng xếp hạng album
    public function chartAlbum()
    {

        $top50album = Album::where('status', '=', 1)->orderBy('like', 'desc')->limit(50)->get();

        $allGenres = Genres::inRandomOrder()->limit(10)->get();

        return view('client.chart.chart-album', compact('top50album', 'allGenres'));
    }

    public function chartArtist()
    {
        $top50Artist = Artist::orderBy('follow', 'desc')->where('status', '=', 1)->limit(50)->get();
        $allGenres = Genres::where('status', '=', 1)->inRandomOrder()->limit(10)->get();

        return view('client.chart.chart-artist', compact('allGenres', 'top50Artist'));
    }

    //Tất cả bài hát, album, playlist

    public function all($type)
    {
        if ($type == 'albums') {
            $allAlbum = Album::orderBy('release_date', 'desc')->with('artist')->paginate(50);

            return view('client.all', compact('allAlbum', 'type'));
        } else if ($type == 'playlists') {
            $allPlaylist = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
                ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
                ->where('users.role', '>', 400)->orderBy('id', 'desc')->where('playlists.status', '=', 1)
                ->paginate(50);;

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

        $singleSong = Song::findOrFail($songId)->load('artists');

        $comment = Comment::where('song_id', '=', $songId)->where('status', '=', 1)->with('user')->orderBy('id', 'desc')->paginate(6);

        $relatedSong = Song::where('genres_id', '=', $singleSong->genres_id)->where('status', '=', 1)->limit(20)->get();

        $relatedSongArtist = Song::whereHas('artists', function ($query) use ($singleSong) {
            $array_artist = [];
            foreach ($singleSong->artists as $artist) {
                array_push($array_artist, $artist->id);
            }
            $query->whereIn('artist_id', $array_artist)->where('status', '=', 1)->where('song_id', '<>', $singleSong->id);

        })->where('status', '=', 1)->limit(10)->get();

        $genres = Genres::latest('id')->where('status', '=', 1)->limit(10)->get();

        $artists = Artist::where('status', '=', 1)->orderBy('follow', 'desc')->limit(10)->get();

        $mostLikeSong = Song::where('status', '=', 1)->orderBy('like', 'desc')->limit(10)->with('artists')->get();


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

    //Chi tiết album

    public function singleAlbum($albumId)
    {

        $singleAlbum = Album::findOrFail($albumId);

        $songOfAlbum = Song::where('album_id', '=', $albumId)->where('status', '=', 1)->get();

        $relateAlbum = Album::where('artist_id', '=', $singleAlbum->artist_id)->where('id', '<>', $singleAlbum->id)->where('status', '=', 1)->get();

        $otherAlbum = Album::where('status', '=', 1)->where('artist_id', '<>', $singleAlbum->artist_id)->inRandomOrder()->get();

        return view('client.detail-page.single-album', compact('singleAlbum', 'songOfAlbum', 'relateAlbum', 'otherAlbum'));
    }

    //Chi tiết danh sách phát

    public function singlePlaylist($playlistId)
    {

        $singlePlaylist = Playlist::findOrFail($playlistId)->load(['songs' => function ($query) {
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
        $genres = Genres::findOrFail($genresId);

        $songOfGenres = Song::where('genres_id', '=', $genresId)->where('status', '=', 1)->paginate(42);

        $otherGenres = Genres::limit(6)->where('status', '=', 1)->get();

        $mostViewOfGenres = Song::where('genres_id', '=', $genresId)->where('status', '=', 1)->orderBy('view', 'desc')->limit(10)->get();

        return view('client.detail-page.single-genres', compact('genres', 'songOfGenres', 'otherGenres', 'mostViewOfGenres'));
    }

    //Chi tiết ca sĩ

    public function singleArtist($artistId)
    {
        $singleArtist = Artist::findOrFail($artistId)->load(['songs' => function ($query) {
            $query->where('status', '=', 1);
        }, 'albums' => function ($query) {
            $query->where('status', '=', 1);
        }]);

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

            $songs = Song::where('name', 'LIKE', '%' . $request->search . '%')->with('artists')->where('status', '=', 1)->get();
            $albums = Album::where('title', 'LIKE', '%' . $request->search . '%')->where('status', '=', 1)->get();
            $artists = Artist::where('nick_name', 'LIKE', '%' . $request->search . '%')->where('status', '=', 1)->get();

            if ($songs && $songs != '') {
                foreach ($songs as $key => $song) {
                    $artist_html = '';
                    $count = 0;
                    foreach ($song->artists as $artist) {
                        $count++;
                        if ($count == count($song->artists)) {
                            $artist_html .= '<a href="' . route('singleArtist', ['artistId' => $artist->id]) . '">' . $artist->nick_name . '</a>';
                        } else {
                            $artist_html .= '<a href="' . route('singleArtist', ['artistId' => $artist->id]) . '">' . $artist->nick_name . '</a> , ';
                        }
                    }

                    $outputSong .= '<div class="col-auto">
                                <div class="img-box-horizontal music-img-box h-g-bg">
                                <div class="img-box img-box-sm box-rounded-sm">
                                <img src="' . url($song->cover_image) . '" alt="' . $song->name . '"></div><div class="des">
                                    <h6 class="title"><a href="' . url('single-song/' . $song->id) . '">' . $song->name . '</a></h6>
                                    <p class="sub-title">' . $artist_html . '</p>
                                </div>
                                <div class="hover-state d-flex justify-content-between align-items-center">
                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"><i class="fas fa-play fs-19 text-light"></i></span>
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
                                                            <i class="fas fa-play fs-21 text-light play-index"></i>
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
                                        <a href="' . route('singleArtist', ['artistId' => $artist->id]) . '" class="f-w-500h-underline">' . $artist->nick_name . '</a>
                                    </h5>
                                    <p class="sub-title"><span class="count-follow">' . $artist->follow . '</span> người quan tâm</p>
                                </div>
                            </div>
                        </div>';
                }
            }

            if ($outputSong == '') {
                $outputSong = '<div class="col-12 w-100 font-weight-bold text-center" style="flex: none!important; max-width: none!important;"> Không có bài hát giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            if ($outputAlbum == '') {
                $outputAlbum = '<div class="col-12 w-100 font-weight-bold text-center" style="flex: none!important; max-width: none!important;"> Không có album giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            if ($outputArtist == '') {
                $outputArtist = '<div class="col-12 w-100 font-weight-bold text-center" style="flex: none!important; max-width: none!important;"> Không có ca sĩ giống với từ khóa bạn tìm kiếm ! Vui lòng hãy thử lại</div>';
            }

            return response(['songs' => $outputSong, 'albums' => $outputAlbum, 'artists' => $outputArtist]);
        }
    }

    //Thêm lịch sử bài hát

    public function addHistory(Request $request)
    {
        $check = History::where('user_id', '=', Auth::user()->id)->where('song_id', '=', $request->song_id)->exists();
        if (!$check) {
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->song_id = $request->song_id;
            $history->save();

            return response()->json(['msg' => 'Thêm lịch sử thành công']);
        }
    }

}


