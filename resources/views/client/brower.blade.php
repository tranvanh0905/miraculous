@extends('layouts.client.main')

@section('title')
    Khám phá
@endsection

@section('content')
    <div class="container">
        <div class="pt-4 pt-lg-5"></div>
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 ">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <section>
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Nghe nhiều nhất
                                    trong 12h qua</h3>
                            </div>
                        </div>
                        <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                             data-auto-width="no" data-loop="no" data-dots="yes"
                             data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
                            <div class="gutter-30">
                                <div class="owl-carousel owl-theme-adonis">
                                    <div class="item">
                                        <?php
                                        $count_loop = 0;
                                        $html = '</div><div class="item">';
                                        ?>
                                        @if(count($mostView12) == 0)
                                            <div class="row">
                                                <div class="col-12 text-center pt-3 mb-3 rounded update">
                                                    <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                                                    <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                         width="100px" height="auto">
                                                </div>
                                            </div>
                                        @else
                                            @foreach($mostView12 as $song)
                                                <?php $count_loop++;?>
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
                                                                <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                                    , @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div
                                                        class=" hover-state d-flex justify-content-between
                                                                   align-items-center">
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
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($count_loop % 2==0)
                                                    {!!$html!!}
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Những người khác
                                    đang nghe giống bạn</h3>
                            </div>
                        </div>
                        <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                             data-auto-width="no" data-loop="no" data-dots="yes"
                             data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
                            <div class="gutter-30">
                                <div class="owl-carousel owl-theme-adonis">
                                    <div class="item">
                                        <?php
                                        $count_loop = 0;
                                        $html = '</div><div class="item">';
                                        ?>
                                        @if(count($suggestSong) == 0)
                                            <div class=" text-center pt-3 mb-3 rounded update">
                                                <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                                                <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                     width="100px" height="auto">
                                            </div>
                                        @else
                                            @foreach($suggestSong as $song)
                                                <?php $count_loop++;?>
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
                                                            }}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                                    , @endif
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
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Dựa trên ca sĩ bạn
                                    đã quan tâm</h3>
                            </div>
                        </div>
                        <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                             data-auto-width="no" data-loop="no" data-dots="yes"
                             data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
                            <div class="gutter-30">
                                <div class="owl-carousel owl-theme-adonis">
                                    <div class="item">
                                        <?php
                                        $count_loop = 0;
                                        $html = '</div><div class="item">';
                                        ?>
                                        @if(count($getSongOfArtistFollow) == 0)
                                            <div class="text-center pt-3 mb-3 rounded update">
                                                <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                                                <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                     width="100px" height="auto">
                                            </div>
                                        @else
                                            @foreach($getSongOfArtistFollow as $song)
                                                <?php $count_loop++;?>
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
                                                            }}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                                    , @endif
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
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($count_loop % 2==0)
                                                    {!!$html!!}
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                <section>
                    <div class="d-flex flex-row">
                        <div class="title-box">
                            <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Tất cả bài hát</h3>
                        </div>
                        <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                            <a href="{{route('all', ['type' => 'songs'])}}">Xem tất cả
                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                         data-auto-width="no" data-loop="no" data-dots="yes"
                         data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                <div class="item">
                                    <?php
                                    $count_loop = 0;
                                    $html = '</div><div class="item">';
                                    ?>
                                    @if(count($allSong) == 0)
                                        <div class="row">
                                            <div class="col-12 text-center pt-3 mb-3 rounded update">
                                                <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                                                <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                     width="100px" height="auto">
                                            </div>
                                        </div>
                                    @else
                                        @foreach($allSong as $song)
                                            <?php $count_loop++;?>
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
                                                            }}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                                , @endif
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
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($count_loop % 5==0)
                                                {!!$html!!}
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="d-flex flex-row">
                        <div class="title-box">
                            <h3 class="title h3-md text-uppercase"><i class="fas fa-compact-disc"></i> Tất cả album</h3>
                        </div>
                        <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                            <a href="{{route('all', ['type' => 'albums'])}}">Xem tất cả
                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="adonis-carousel viewport-animate" data-animation="slideUp"
                         data-animation-item=".owl-item.active" data-dots="yes" data-auto-width="yes"
                         data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                @if(count($allAlbum) == 0)
                                    <div class="row">
                                        <div class="col-12 text-center pt-3 mb-3 rounded update">
                                            <h3 class="mb-0 text-light">Đang cập nhật album...</h3>
                                            <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                 width="100px" height="auto">
                                        </div>
                                    </div>
                                @else
                                    @foreach($allAlbum as $album)
                                        <div class="item">
                                            <div class="music-img-box">
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
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="d-flex flex-row">
                        <div class="title-box">
                            <h3 class="title h3-md text-uppercase"><i class="fas fa-compact-disc"></i> Tất cả danh sách
                                phát</h3>
                        </div>
                        <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                            <a href="{{route('all', ['type' => 'playlists'])}}">Xem tất cả
                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="adonis-carousel viewport-animate" data-animation="slideUp"
                         data-animation-item=".owl-item.active" data-dots="yes" data-auto-width="yes"
                         data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                @if(count($allPlaylist) == 0)
                                    <div class="row">
                                        <div class="col-12 text-center pt-3 mb-3 rounded update">
                                            <h3 class="mb-0 text-light">Đang cập nhật danh sách phát...</h3>
                                            <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                 width="100px" height="auto">
                                        </div>
                                    </div>
                                @else
                                    @foreach($allPlaylist as $playlist)
                                        <div class="item">
                                            <div class="music-img-box">
                                                <div class="img-box box-rounded-md img-album-new">
                                                    <img class="retina"
                                                         src="{{url($playlist->cover_image)}}"
                                                         data-2x="{{url($playlist->cover_image)}}"
                                                         alt="{{$playlist->name}}">
                                                    <div class="hover-state">
                                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                <span
                                                    class="pointer play-btn-dark round-btn adonis-album-button"
                                                    data-album-id="{{$playlist->id}}" data-type="playList">
                                                     <i class="fas fa-play fs-21 text-light play-index"></i>
                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 class="title"><a
                                                        href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">{{$playlist->name}}</a>
                                                </h6>
                                                <p class="sub-title category">
                                                    {{count($playlist->songs)}} bài hát
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="d-flex flex-row">
                        <div class="title-box">
                            <h3 class="title h3-md text-uppercase"><i class="fas fa-users"></i> Tất cả ca sĩ</h3>
                        </div>
                        <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                            <a href="{{route('all', ['type' => 'artists'])}}">Xem tất cả
                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="adonis-carousel viewport-animate" data-animation="slideUp"
                         data-animation-item=".owl-item.active" data-dots="yes" data-auto-width="yes"
                         data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                @if(count($allArtitst) == 0)
                                    <div class="row">
                                        <div class="col-12 text-center pt-3 mb-3 rounded update">
                                            <h3 class="mb-0 text-light">Đang cập nhật danh sách phát...</h3>
                                            <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                                 width="100px" height="auto">
                                        </div>
                                    </div>
                                @else
                                    @foreach($allArtitst as $artist)
                                        <div class="item">
                                            <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                                                <div class="img-box rounded-circle img-artist-index">
                                                    <img class="retina" src="{{url($artist->avatar)}}"
                                                         data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                                                </div>
                                                <div class="desc top-sm text-center">
                                                    <h5 class="title fs-3">
                                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}"
                                                           class="f-w-500
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
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12">
                <section>
                    <div class="d-flex flex-row">
                        <div class="title-box">
                            <h3 class="title h3-md text-uppercase"><i class="fas fa-boxes"></i> Thể loại nhạc</h3>
                        </div>
                        <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                            <a href="{{route('all', ['type' => 'genres'])}}">Xem tất cả
                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="list-genres">
                        @if(count($genres) == 0)
                            <div class="row">
                                <div class="col-12 text-center pt-3 mb-3 rounded update">
                                    <h3 class="mb-0 text-light">Đang cập nhật danh sách phát...</h3>
                                    <img src="{{url('client/images/loading.gif')}}" alt="loading"
                                         width="100px" height="auto">
                                </div>
                            </div>
                        @else
                            @foreach($genres as $genre)
                                <div class="item col-12 mb-3">
                                    <div class="img-box-text-over lg box-rounded-lg genres-brower">
                                        <img src="{{url($genre->image)}}" data-2x="{{url($genre->image)}}"
                                             alt="{{$genre->name}}" class="img-genres">
                                        <div class="absolute-info d-flex flex-column justify-content-between">
                                            <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">Thể Loại
                                            </div>
                                            <div>
                                                <h4 class="fs-7 m-0 text-light text-center">
                                                    <span class="font-weight-bold">{{$genre->name}}</span>
                                                </h4>
                                            </div>
                                            <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                                <a href="{{route('singleGenres', ['genresId' => $genre->id])}}"
                                                   class="color-white">Xem thể loại
                                                    <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                                     <i class="fas fa-arrow-right"></i>
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </section>
            </div>
            @if(!\Illuminate\Support\Facades\Auth::check())
                <div class="col-12">
                    <section class="w-100 p-5 text-center banner-reg">
                        <h3 class="font-weight-bold text-light">Hãy đăng ký tài khoản thành viên để có nhiều nội dung
                            khám
                            phá hay hơn</h3>
                        <a href="{{route('reg')}}" class="btn-reg">Đăng ký ngay</a>
                    </section>
                </div>
            @endif
        </div>
    </div>
@endsection
