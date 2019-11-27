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


class ClientController extends Controller
{
    //-------------------------------------------//

    //Index page controller

    public function index()
    {

        $randomSong = Song::inRandomOrder()
            ->limit(10)->with('artists')
            ->get();

        $latestSongs = Song::orderBy('release_date', 'desc')
            ->limit(30)->with('artists')
            ->get();

        $mostViewAlbum = Album::orderBy('like', 'desc')->get();

        $allGenres = Genres::latest('id')->limit(10)->get();

        $latestAbums = Album::latest('release_date')->limit(10)->get();

        $playLists = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->limit(4)
            ->get();

        $playLists->each(function ($q) {
            $q->load('getThreeSongs');
        });

        $artists = Artist::orderBy('follow', 'desc')->with('userFollows')->limit(12)->get();

        return view('client.index', compact('latestSongs', 'allGenres', 'latestAbums', 'randomSong', 'mostViewAlbum', 'playLists', 'artists'));
    }

    //Brower page
    public function brower()
    {
        $allSong = Song::select('songs.*', 'users.id as user_id', 'users.role')->join('users', 'songs.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)
            ->limit(25)->with('artists')
            ->get();

        $allAlbum = Album::limit(25)->get();

        $allPlaylist = Playlist::select('playlists.*', 'users.id as user_id', 'users.role')
            ->join('users', 'playlists.upload_by_user_id', '=', 'users.id')
            ->where('users.role', '>', 400)->orderBy('id', 'desc')->limit(20)
            ->get();

        return view('client.brower', compact('allSong', 'allAlbum', 'allPlaylist'));
    }

    //Genres page
    public function genres()
    {
        $allGenres = Genres::latest('id')->paginate(18);

        return view('client.all-genres', compact('allGenres'));
    }

    //Chart song page
    public function chart()
    {
        return view('client.chart');
    }

    //Chart song page
    public function chartSong()
    {

        $top50song = User::where('role', '>', 100)->with(['songs' => function ($query) {
            $query->orderBy('view', 'desc')->limit(50);
        }])->get()->pluck('songs')->flatten();

        $allGenres = Genres::inRandomOrder('id')->limit(10)->get();

        return view('client.chart-song', compact('top50song', 'allGenres'));
    }

    //Chart album page
    public function chartAlbum()
    {

        $top50album = Album::orderBy('like', 'desc')->get();

        $allGenres = Genres::inRandomOrder('id')->limit(10)->get();

        return view('client.chart-album', compact('top50album', 'allGenres'));
    }

    //All page

    public function all($type)
    {
        if ($type == 'albums') {
            $allAlbum = Album::orderBy('release_date', 'desc')->with('artist')->get();

            return view('client.all', compact('allAlbum', 'type'));
        } else if ($type == 'playlists') {
            $allPlaylist = Playlist::orderBy('id', 'desc')->with('songs')->get();

            return view('client.all', compact('allPlaylist', 'type'));
        } else if ($type == 'songs') {

            $allSong = Song::orderBy('release_date', 'desc')->with('artists')->get();

            return view('client.all', compact('allSong', 'type'));
        } else if ($type == 'artists') {
            $allArtist = Artist::orderBy('id', 'desc')->with('songs')->get();

            return view('client.all', compact('allArtist', 'type'));
        }

        return redirect(route('client.home'));

    }

    //Song detail page

    public function singleSong($songId)
    {

        $singleSong = Song::find($songId)->load('artists');

        $comment = Comment::where('song_id', '=', $songId)->with('user')->get();

        $relatedSong = Song::where('genres_id', '=', $singleSong->genres_id)->limit(20)->get();

        $relatedSongArtist = Song::whereHas('artists', function ($query) use ($singleSong) {
            foreach ($singleSong->artists as $artist) {
                $query->where('artist_id', '=', $artist->id)->where('song_id', '<>', $singleSong->id);
            }
        })->get();


        $genres = Genres::latest('id')->limit(10)->get();

        $artists = Artist::orderBy('follow')->limit(10)->get();

        $mostLikeSong = Song::orderBy('like')->limit(10)->with('artists')->get();


        return view('client.single-song', compact('singleSong', 'relatedSong', 'genres', 'artists', 'mostLikeSong', 'relatedSongArtist', 'comment'));
    }

    //Comment song

    public function commentSong(CommentRequest $request)
    {
        $model = new Comment();
        $model->user_id = Auth::id();
        $model->status = 1;
        $model->fill($request->all());
        $model->save();

        return response()->json(['success' => 'Thêm bình luận thành công']);
    }

    //fetch comment

    public function fetchComment(Request $request){
        $allComment = Comment::where('song_id', '=', $request->id)->orderBy('id', 'desc')->get();

        return view('client.fetch-comment', compact('allComment'));
    }

    //Album detail page

    public function singleAlbum($albumId)
    {

        $singleAlbum = Album::find($albumId);

        $songOfAlbum = Song::where('album_id', '=', $albumId)->get();

        $relateAlbum = Album::where('artist_id', '=', $singleAlbum->artist_id)->where('id', '<>', $singleAlbum->id)->get();

        return view('client.single-album', compact('singleAlbum', 'songOfAlbum', 'relateAlbum'));
    }

    //Playlist detail page

    public function singlePlaylist($playlistId)
    {

        $singlePlaylist = Playlist::find($playlistId)->load('songs');

        $relatedPlaylist = Playlist::whereHas('user', function ($query) {
            $query->where('role', '>', 500);
        })->limit(10)->get();

        return view('client.single-playlist', compact('singlePlaylist', 'relatedPlaylist'));
    }

    //Genres detail page

    public function singleGenres($genresId)
    {
        $genres = Genres::find($genresId);

        $latestSong = Song::latest('release_date')->where('genres_id', '=', $genresId)->limit(20)->get();

        $songOfGenres = Song::where('genres_id', '=', $genresId)->paginate(18);

        $otherGenres = Genres::limit(6)->get();

        $mostLikeGenres = Song::where('genres_id', '=', $genresId)->orderBy('like', 'desc')->get();

        return view('client.single-genres', compact('genres', 'latestSong', 'songOfGenres', 'otherGenres', 'mostLikeGenres'));
    }

    //Artist detail page

    public function singleArtist($artistId)
    {
        $singleArtist = Artist::find($artistId)->load('songs.artists', 'albums');


        return view('client.single-artist', compact('singleArtist'));
    }

    //Search page

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $songs = Song::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($songs) {
                foreach ($songs as $key => $song) {
                    $output = '<div class="col-auto">
                                <div class="img-box-horizontal music-img-box h-g-bg">
                                <div class="img-box img-box-sm box-rounded-sm">
                                <img src="' . $song->cover_image . '" alt="' . $song->name . '"></div><div class="des">
                                    <h6 class="title"><a href="' . url('singleSong/' . $song->id) . '">' . $song->name . '</a></h6>
                                    <p class="sub-title"><a href="#">Bing Crosby</a></p>
                                </div>
                                <div class="hover-state d-flex justify-content-between align-items-center">
                                    <span class="pointer play-btn-dark box-rounded-sm"><i class="play-icon"></i></span>
                                    <div class="d-flex align-items-center">
                                        <span class="adonis-icon text-light pointer mr-2 icon-2x"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"><use xlink:href="#icon-heart-blank"></use></svg></span>
                                        <span class="pointer dropdown-menu-toggle"><span class="icon-dot-nav-horizontal text-light"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            return Response($output);
        }
    }

}
