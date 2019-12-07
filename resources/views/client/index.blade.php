@extends('layouts.client.main')

@section('title')
    Trang chủ
@endsection

@section('content')
    <main id="main">
        <div class="pt-4 pt-lg-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="adonis-carousel" data-items="1" data-stagePadding="0"
                         data-loop="yes" data-dots="yes">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach(getSlider() as $slider)
                                <a href="{{url($slider->url)}}" class="box-img-slider">
                                    <img src="{{url($slider->image)}}" alt="{{url($slider->url)}}" class="img-slider">
                                    <img src="{{url($slider->image)}}" alt="{{url($slider->url)}}" class="img-slider">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <section>
                <div class="d-flex">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-poll-h"></i> Top 24H</h3>
                    </div>
                </div>

                @if($trendSong == null)
                    <div class="row">
                        <div class="col-12 text-center pt-3 mb-3 rounded update">
                            <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                            <img src="{{url('client/images/loading.gif')}}" alt="loading" width="100px" height="auto">
                        </div>
                    </div>
                @else
                    <div class="adonis-carousel mb-3" data-auto-width="no" data-loop="no" data-dots="yes"
                         data-items-responsive="0:1|600:2|1000:3|1500:3">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis owl-loaded owl-drag">
                                <?php
                                $countop = 1;
                                ?>
                                @foreach($trendSong as $song)
                                    <div class="item">
                                        <div class="radio">
                                            <div class="img-box-text-over lg box-rounded-lg trend-song border">
                                                <a href="{{route('singleSong',['song_id' => $song->song_id])}}">
                                                    <img src="{{url($song->cover_image)}}"
                                                         data-2x="{{url($song->cover_image)}}" alt="{{$song->name}}">
                                                    <div class="absolute-info">
                                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span
                                                            class="adonis-highlight-dark font-weight-bold">Top <?= $countop; $countop++?></span>
                                                        </div>
                                                        <div class="absolute-top-right pr-e-15 pt-e-15">
                                                        <span class="adonis-highlight-dark font-weight-bold">
                                                         {{$song->name}}
                                                        </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>

            <section>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md"><i class="fas fa-music"></i> Bài Hát Mới</h3>
                            </div>
                        </div>
                        <div class="adonis-carousel music-img-box-cont-sm viewport-animate"
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
                                        @foreach($latestSongs as $song)
                                            <?php $count_loop++ ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="d-flex">
                            <div class="title-box">
                                <h3 class="title h3-md"><i class="fas fa-compact-disc"></i> Album Thích Nhiều Nhất</h3>
                            </div>
                        </div>
                        <div class="adonis-carousel" data-auto-width="yes" data-loop="no" data-dots="yes"
                             data-responsive-width="0:85%|400:345px">
                            <div class="gutter-10">
                                <div class="owl-carousel owl-theme-adonis owl-loaded owl-drag">
                                    @foreach($mostViewAlbum as $album)
                                        <div class="item">
                                            <div class="music-img-box">
                                                <div class="img-box box-rounded-sm img-album-index">
                                                    <img class="retina" src="{{$album->cover_image}}"
                                                         data-2x="{{$album->cover_image}}" alt="{{$album->name}}">
                                                    <div class="hover-state">
                                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                            <span
                                                                class="pointer play-btn-dark round-btn adonis-album-button"
                                                                data-type="album" data-album-id="{{$album->id}}">
                                                                 <i class="fas fa-play fs-21 play-index text-light"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="title"><a
                                                        href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a>
                                                </h5>
                                                <p class="sub-title category"><a
                                                        href="{{route('singleArtist', ['albumId' => $album->artist_id])}}">{{$album->artist->nick_name}}</a>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach()
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="viewport-animate" data-animation="slideUp" data-animation-item=".col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md"><i class="fas fa-table"></i> Bảng Xếp Hạng</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adonis-carousel viewport-animate" data-animation="slideUp"
                     data-animation-item=".owl-item.active" data-dots="yes" data-auto-width="yes"
                     data-responsive-width="0:100%|500:50%|730:33.33%|1100:33.33%|1460:50%">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            <div class="item">
                                <div class="img-box-text-over lg box-rounded-lg">
                                    <img src="{{url('client/images/this-week/popular-album-week.jpg')}}"
                                         data-2x="{{url('client/images/this-week/popular-album-week@2x.jpg')}}"
                                         alt="bxh-song">
                                    <div class="hover-state show">
                                        <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                            <h6 class="text-light font-weight-bold"><i class="fas fa-music"></i>
                                                BẢNG XẾP HẠNG
                                                TOP 50 BÀI HÁT</h6>
                                        </div>
                                        <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                            <a href="{{route('client.chart-song')}}" class="text-light"><i
                                                    class="icon-arrow-right2"></i>
                                                Xem bảng xếp hạng
                                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box-text-over lg  box-rounded-lg">
                                    <img src="{{url('client/images/this-week/new-songs-week.jpg')}}"
                                         data-2x="{{url('client/images/this-week/new-songs-week@2x.jpg')}}"
                                         alt="bxh-album">
                                    <div class="hover-state show">
                                        <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                            <h6 class="text-light font-weight-bold"><i
                                                    class="fas fa-compact-disc"></i> BẢNG XẾP
                                                HẠNG TOP 50 ALBUM</h6>
                                        </div>
                                        <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                            <a href="{{route('client.chart-album')}}" class="text-light"><i
                                                    class="icon-arrow-right2"></i>
                                                Xem bảng xếp hạng
                                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box-text-over lg  box-rounded-lg">
                                    <img src="{{url('client/images/this-week/popular-artists-week.jpg')}}"
                                         data-2x="{{url('client/images/this-week/popular-artists-week@2x.jpg')}}"
                                         alt="bxh-artist">
                                    <div class="hover-state show">
                                        <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                            <h6 class="text-light font-weight-bold"><i class="fas fa-users"></i>
                                                BẢNG XẾP HẠNG
                                                TOP 50 CA SĨ</h6>
                                        </div>
                                        <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                            <a href="{{route('client.chart-artist')}}" class="text-light"><i
                                                    class="icon-arrow-right2"></i>
                                                Xem bảng xếp hạng
                                                <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="d-flex">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-boxes"></i> Thể Loại</h3>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'genres'])}}" class="mb-4">Xem tất cả
                            <span class="adonis-icon pl-1 icon-arrow icon-1x"><i
                                    class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="adonis-carousel viewport-animate" data-animation="slideUp"
                     data-animation-item=".owl-item.active" data-dots="yes" data-auto-width="yes"
                     data-responsive-width="0:100%|500:50%|730:33.33%|1100:25%|1460:20%">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($allGenres as $genres)
                                <div class="item">
                                    <div class="img-box-text-over lg box-rounded-lg index-genres">
                                        <img src="{{url($genres->image)}}"
                                             data-2x="{{url($genres->image)}}" alt="{{$genres->name}}"
                                             class="img-genres">
                                        <div
                                            class="absolute-info d-flex flex-column justify-content-between">
                                            <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light"><i
                                                    class="fas fa-th-list"></i> Thể Loại
                                            </div>
                                            <div>
                                                <h4 class="fs-7 m-0 text-light text-center"><span
                                                        class="font-weight-bold">{{$genres->name}}</span>
                                                </h4>
                                            </div>
                                            <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                                <a href="{{route('singleGenres', ['genresId' => $genres->id])}}"
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
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="d-flex">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-compact-disc"></i> Album Mới</h3>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'albums'])}}" class="mb-4">Xem tất cả
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
                            @foreach($latestAbums as $album)
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
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-list-alt"></i> Danh sách phát mới</h3>
                    </div>
                    <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                        <a href="{{route('all', ['type' => 'playlists'])}}">Xem tất cả
                            <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach($playLists as $playlist)
                        <div class="col-xl-6 col-lg-12 col-md-12 ">
                            <div class="playlist-item-wrapper mb-3">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                                        <div class="music-img-box">
                                            <div class="img-box box-rounded-md img-album-new">
                                                <img class="retina"
                                                     src="{{url($playlist->cover_image)}}"
                                                     data-2x="{{url($playlist->cover_image)}}"
                                                     alt="{{url($playlist->name)}}">
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
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-3 col-lg-3 col-md-3 col-sm-6 p-xl-0 text-md-left text-sm-left text-xl-left text-lg-left text-center p-2">
                                        <h4 class="title font-weight-bold"><a
                                                href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">{{$playlist->name}}</a>
                                        </h4>
                                        <i>{{count($playlist->songs)}} bài hát</i></div>
                                    <div class="col-xl-5 col-lg-6 col-md-5 col-sm-12 mb-sm-3 pl-xl-0">
                                        <div class="list-trend">
                                            @foreach($playlist->getThreeSongs as $song)
                                                <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                                    <div class="img-box img-box-sm box-rounded-sm">
                                                        <img src="{{url($song->cover_image)}}" alt="{{$song->name}}">
                                                    </div>
                                                    <div class="des">
                                                        <h6 class="title fs-2"><a
                                                                href="{{route('singleSong', ['song_id' => $song->id])}}">{{$song->name}}</a>
                                                        </h6>
                                                        <p class="sub-title">
                                                            @foreach($song->artists as $artist)
                                                                <a href="{{route('singleArtist', ['artist_id' => $artist->id])}}">
                                                                    {{$artist->nick_name}}
                                                                </a> @if ($loop->last) @else , @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="hover-state d-flex justify-content-between align-items-center">
                                                        <span
                                                            class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                            data-type="song" data-album-id="{{$song->id}}">
                                                            <i class="fas fa-play fs-19 text-light"></i>
                                                        </span>
                                                        <div class="d-flex align-items-center">
                                                             <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                                     @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                         <span
                                                                             class="adonis-icon icon-2x box-like-global">
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
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pt-e-20 pt-e-lg-40"></div>
            </section>

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-users"></i> Ca Sĩ Nổi Bật</h3>
                    </div>
                    <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                        <a href="#">Xem tất cả
                            <span class="adonis-icon pl-1 icon-arrow icon-1x">
                               <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="row auto-columns adonis-animate" data-animation="slideRightSkew"
                     data-animation-item=".music-img-box"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%"
                     style="opacity: 1;">
                    @foreach($artists as $artist)
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
            </section>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    </main>
@endsection

