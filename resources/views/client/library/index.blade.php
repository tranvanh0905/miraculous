@extends('layouts.client.main-account-library')

@section('title')
    Thư viện
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Bài hát</h2>
            </div>
        </div>

        <div class="row">
            @if(count($likedSong) == 0)
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa thích bài hát nào. Hãy yêu thích bài hát nhiều hơn !!! </h3>
                        <a href="{{route('all', ['type' => 'songs'])}}">Nhấn để khám phá thêm nhiều bài hát</a>
                    </div>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="adonis-carousel music-img-box-cont-sm viewport-animate" id="content-song-library" data-items="1"
                         data-animation="slideUp" data-animation-item=".item" data-auto-width="yes"
                         data-loop="no" data-dots="yes"
                         data-responsive-width="0:100%|600:50%|900:33.33%|1200:25%">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                <div class="item">
                                    <?php
                                    $count_loop = 0;
                                    $html = '</div><div class="item">';
                                    ?>
                                    @foreach($likedSong as $song)
                                        <?php $count_loop++ ?>
                                            <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow song-in-library" data-song-id="{{$song->id}}">
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
                                                                    <i class="far fa-heart fa-2x font-14 like-library"
                                                                       id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span
                                                                        class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14 like-library" id="likeGlobal"
                                                                   data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @if($count_loop % 4==0)
                                            {!!$html!!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md mt-3">Danh sách phát</h2>
            </div>
        </div>

        @if(count($likedPlaylist) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa yêu thích danh sách phát nào !!!</h3>
                        <a href="{{route('all', ['type' => 'playlists'])}}">Nghe thêm nhiều danh sách phát hơn nào !!!</a>
                    </div>
                </div>
            </div>
        @else
            <div class="adonis-carousel music-img-box-cont-sm viewport-animate"
                 data-animation="slideUp" data-animation-item=".item" data-dots="yes"
                 data-auto-width="yes"
                 data-responsive-width="0:50%|400:33.33%|600:25%|800:20%|1000:16.667%|1200:14.285%|1400:12.5%|1600:10%">
                <div class="gutter-30">
                    <div class="owl-carousel owl-theme-adonis">
                        @foreach($likedPlaylist as $playlist)
                            <div class="item">
                                <div class="music-img-box">
                                    <div class="img-box box-rounded-md img-box-md">
                                        <img class="retina"
                                             src="{{url($playlist->cover_image)}}"
                                             data-2x="{{url($playlist->cover_image)}}"
                                             alt="{{$playlist->name}}">
                                        <div class="hover-state">
                                            <div class="absolute-bottom-left pl-e-15 pb-e-15">
                                                                <span class="pointer play-btn-dark round-btn adonis-album-button"
                                                                      data-type="playList" data-album-id="{{$playlist->id}}"><i class="fas fa-play fs-21 play-index text-light"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="title"><a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])
                                    }}">{{$playlist->name}}</a></h6>
                                    <p class="sub-title category">
                                        {{count($playlist->songs)}} bài hát
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md mt-3">Album</h2>
            </div>
        </div>
        @if(count($likedAlbum) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/album_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa yêu thích album nào !!!</h3>
                        <a href="{{route('all', ['type' => 'albums'])}}">Khám phá thêm các album của các ca sĩ</a>
                    </div>
                </div>
            </div>
        @else
            <div class="adonis-carousel music-img-box-cont-sm viewport-animate"
                 data-animation="slideUp" data-animation-item=".item" data-dots="yes"
                 data-auto-width="yes"
                 data-responsive-width="0:50%|400:33.33%|600:25%|800:20%|1000:16.667%|1200:14.285%|1400:12.5%|1600:10%">
                <div class="gutter-30">
                    <div class="owl-carousel owl-theme-adonis">
                        @foreach($likedAlbum as $album)
                            <div class="item">
                                <div class="music-img-box">
                                    <div class="img-box box-rounded-md img-box-md">
                                        <img class="retina"
                                             src="{{url($album->cover_image)}}"
                                             data-2x="{{url($album->cover_image)}}"
                                             alt="{{$album->title}}">
                                        <div class="hover-state">
                                            <div class="absolute-bottom-left pl-e-15 pb-e-15">
                                                                <span class="pointer play-btn-dark round-btn adonis-album-button"
                                                                      data-album-id="{{$album->id}}" data-type="album"><i class="fas fa-play fs-21 play-index text-light"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="title"><a href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a></h6>
                                    <p class="sub-title category"><a href="{{route('singleArtist', ['artistId' => $album->artist->id])}}">
                                            {{$album->artist->nick_name}}
                                        </a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section>
        <div class="pt-3"></div>
        <div class="d-flex flex-row">
            <div class="title-box">
                <h2 class="title h3-md">Ca Sĩ</h2>
            </div>
        </div>
        @if(count($followArtist) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa quan tâm ca sĩ nào !!!</h3>
                        <a href="{{route('all', ['type' => 'artists'])}}">Tìm ca sĩ mà bạn thích ngay</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row auto-columns adonis-animate" id="content-artits-library" data-animation="slideRightSkew"
                 data-animation-item=".music-img-box"
                 data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                @foreach($followArtist as $artist)
                    <div class="col-auto item-artist-library" id="artits-library{{$artist->id}}">
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
                                <p class="sub-title"><span class="count-follow" data-artist-id="{{$artist->id}}">{{$artist->follow}}</span>
                                    người quan tâm</p>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <a href="javascript:;" class="btn btn-primary btn-follow" data-artist-id="{{$artist->id}}">

                                    @if(!\App\Model_client\UserFollowDetail::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('artist_id', '=', $artist->id)->exists())
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
        @endif
    </section>
@endsection
