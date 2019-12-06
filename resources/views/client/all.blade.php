@extends('layouts.client.main')

@section('title')
    Tất cả @if($type == 'albums') Album @elseif($type == 'songs') Bài hát @elseif($type == 'playlists') Danh sách phát @elseif($type == 'artists')
        Ca sĩ @elseif($type == 'genres') Thể loại @endif
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    @if($type == 'albums')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase"><i class="fas fa-compact-disc"></i> Tất cả album</h4>
                </div>
                <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                    @foreach($allAlbum as $album)
                        <div class="col-auto">
                            <div class="music-img-box mb-3">
                                <div class="img-box box-rounded-md img-album-new">
                                    <img class="retina"
                                         src="{{url($album->cover_image)}}"
                                         data-2x="{{url($album->cover_image)}}"
                                         alt="{{$album->title}}">
                                    <div class="hover-state">
                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                    <span
                                                        class="pointer play-btn-dark round-btn adonis-album-button"
                                                        data-album-id="{{$album->id}}" data-type="album">
                                                         <i class="fas fa-play fs-21 text-light play-index"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="title"><a
                                        href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a>
                                </h6>
                                <p class="sub-title category">
                                    <a href="{{route('singleArtist', ['artist_id' => $album->artist_id])}}">{{$album->artist->nick_name}}</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        {{ $allAlbum->links() }}
                    </div>
                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @elseif($type == 'playlists')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase">Tất cả danh sách phát</h4>
                </div>
                <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                    @foreach($allPlaylist as $playlist)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-lg-40">
                                <div class="img-box box-rounded-sm">
                                    <img class="retina" src="{{url($playlist->cover_image)}}"
                                         data-2x="{{url($playlist->cover_image)}}" alt="{{$playlist->name}}">
                                    <div class="hover-state">
                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                            <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="playList"
                                                  data-album-id="{{$playlist->id}}"><i class="fas fa-play fs-21 text-light play-index"></i>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="title"><a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">{{$playlist->name}}</a></h6>
                                <p class="sub-title category">{{count($playlist->songs)}} bài hát</p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        {{ $allPlaylist->links() }}
                    </div>
                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @elseif($type == 'songs')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase">Tất cả bài hát</h4>
                </div>
                <div class="row auto-fit-columns adonis-animate" data-animation="slideUp" data-animation-item=".col-auto"
                     data-item-width="350" data-item-max-width="520">
                    @foreach($allSong as $song)
                        <div class="col-auto">
                            <div class="col-auto mb-3">
                                <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                    <div class="img-box img-box-sm box-rounded-sm">
                                        <img src="{{$song->cover_image}}" alt="{{$song->name}}">
                                    </div>
                                    <div class="des">
                                        <h6 class="title fs-2"><a
                                                href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a>
                                        </h6>
                                        <p class="sub-title">
                                            @foreach($song->artists as $artist)
                                                <a href="{{route('singleArtist', ['artistId' => $artist->id])
                                                            }}">{{$artist->nick_name}}</a> @if ($loop->last) @else , @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div
                                        class="hover-state d-flex justify-content-between align-items-center">
                                                    <span
                                                        class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                        data-type="song"
                                                        data-album-id="{{$song->id}}">
                                                         <i class="fas fa-play fs-19 text-light"></i>
                                                    </span>
                                        <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14"
                                                                       id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span
                                                                        class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14" id="likeGlobal"
                                                                   data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        {{ $allSong->links() }}
                    </div>
                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @elseif($type == 'artists')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase"><i class="fas fa-users"></i> Tất cả ca sĩ</h4>
                </div>
                <div class="row auto-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".music-img-box"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                    @foreach($allArtist as $artist)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                                <div class="img-box rounded-circle img-artist-index">
                                    <img class="retina" src="{{url($artist->avatar)}}"
                                         data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                                </div>
                                <div class="desc top-sm text-center">
                                    <h5 class="title fs-3">
                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}" class="f-w-500
                                        h-underline">{{$artist->nick_name}}</a>
                                    </h5>
                                    <p class="sub-title"><span class="count-follow"
                                                               data-artist-id="{{$artist->id}}">{{$artist->follow}}</span>
                                        người quan tâm</p>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <a href="javascript:;" class="btn btn-primary btn-follow"
                                       data-artist-id="{{$artist->id}}">

                                        @if(!\App\Model_client\UserFollowDetail::where('user_id', '=',
                                        \Illuminate\Support\Facades\Auth::user()->id)
                                        ->where
                                        ('artist_id', '=', $artist->id)->exists())
                                            <i class="fas fa-user-plus"></i> Quan tâm
                                        @else
                                            <i class="fas fa-user-minus"></i> Bỏ quan tâm
                                        @endif
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        {{ $allArtist->links() }}
                    </div>
                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @elseif($type == 'genres')
        <div class="container">
            <section>
                <div class="title-box">
                    <h3 class="title h3 text-uppercase"><i class="fas fa-boxes"></i> Tất cả thể loại</h3>
                </div>
                <div class="genres-list row adonis-animate" data-animation="slideUp" data-animation-item=".img-box-text-over">
                    @foreach($allGenres as $genres)
                        <div class="item col-lg-3 mb-3">
                            <div class="img-box-text-over lg box-rounded-lg">
                                <img src="{{$genres->image}}"
                                     data-2x="{{$genres->image}}" alt="{{$genres->name}}" height="155" class="img-genres">
                                <div
                                        class="absolute-info d-flex flex-column justify-content-between">
                                    <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">Thể Loại
                                    </div>
                                    <div>
                                        <h4 class="fs-7 m-0 text-light text-center"><span
                                                    class="font-weight-bold">{{$genres->name}}</span>
                                        </h4>
                                    </div>
                                    <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                        <a href="{{route('singleGenres', ['genresId' => $genres->id])}}"
                                           class="color-white">Xem thể loại<span
                                                    class="adonis-icon pl-1 icon-arrow icon-1x"><i
                                                    class="fas fa-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        {{ $allGenres->links() }}
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
