@extends('layouts.client.main')

@section('title')
    Trang chủ
@endsection

@section('content')
    <main id="main">
        <div class="pt-4 pt-lg-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12 col-12">
                    <div class="adonis-carousel" data-items="1" data-stagePadding="0"
                         data-loop="no">
                        <div class="owl-carousel owl-theme-adonis">
                            <img src="https://photo-zmp3.zadn.vn/banner/e/1/8/1/e181d0a10cd0e354d6c60723e8c0d374.jpg"
                                 alt=""
                                 class="img-fluid">
                            <img src="https://photo-zmp3.zadn.vn/banner/5/9/3/c/593c1fdb62e63c32e1b9da240ba663e4.jpg"
                                 alt=""
                                 class="img-fluid">
                            <img src="https://photo-zmp3.zadn.vn/banner/b/e/0/8/be08de5a9a48c60ae7d58a897a75eecf.jpg"
                                 alt=""
                                 class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <section>
                <div class="d-flex">
                    <div class="title-box">
                        <h2 class="title h3-md">Có Thể Bạn Muốn Nghe</h2>
                    </div>
                </div>
                <div class="adonis-carousel music-img-box-cont-sm viewport-animate"
                     data-animation="slideUp" data-animation-item=".item" data-dots="yes"
                     data-auto-width="yes"
                     data-responsive-width="0:50%|400:33.33%|600:25%|800:20%|1000:16.667%|1200:14.285%|1400:12.5%|1600:10%">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($randomSong as $song)
                                <div class="item">
                                    <div class="music-img-box">
                                        <div class="img-box box-rounded-md img-box-md">
                                            <img class="retina"
                                                 src="{{url($song->cover_image)}}"
                                                 data-2x="{{url($song->cover_image)}}"
                                                 alt="{{$song->name}}">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-15 pb-e-15">
                                                                <span
                                                                        class="pointer play-btn-dark round-btn adonis-album-button"
                                                                        data-type="song" data-album-id="{{$song->id}}"><i
                                                                            class="play-icon"></i></span>
                                                </div>
                                                <div class="absolute-top-right pr-e-20 pt-e-20">
                                            <span class="pointer dropdown-menu-toggle"><span
                                                        class="adonis-icon icon-4x"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                         version="1.1"><use
                                                                xlink:href="#icon-horizontal-dots"></use></svg></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title"><a
                                                    href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a>
                                        </h6>
                                        <p class="sub-title category"><a href="#">
                                                @foreach($song->artists as $artist)
                                                    {{$artist->nick_name}}
                                                @endforeach
                                            </a></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h2 class="title h3-md">Bài Hát Mới</h2>
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
                                                            }}">{{$artist->nick_name}}</a>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="hover-state d-flex justify-content-between align-items-center">
                                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                          data-type="song"
                                                          data-album-id="{{$song->id}}"><i
                                                                class="play-icon"></i>
                                                    </span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                        <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                           data-id="{{$song->id}}"
                                                                        ></i>
                                                                      </span>
                                                                @else
                                                                    <span class="adonis-icon icon-2x box-dis-like-global">
                                                                    <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"></i>
                                                                    </span>
                                                                @endif

                                                            @endif
                                                        </span>
                                                        <span class="pointer dropdown-menu-toggle"
                                                              data-songid="{{$song->id}}" data-link="123">
                                                            <span class="icon-dot-nav-horizontal text-light"></span>
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

                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div class="title-box">
                                <h2 class="title h3-md">Album Thích Nhiều Nhất</h2>
                            </div>
                        </div>
                        <div class="adonis-carousel" data-auto-width="yes" data-loop="no" data-dots="yes" data-responsive-width="0:85%|400:345px">
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
                                                            <span class="pointer play-btn-dark round-btn"><i class="play-icon"></i></span>
                                                        </div>
                                                        <div class="absolute-top-right pr-e-20 pt-e-20">
                                                                    <span class="pointer dropdown-menu-toggle"><span class="adonis-icon icon-4x"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                                        xlink:href="#icon-horizontal-dots"></use></svg></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="title"><a href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->name}}</a>
                                                </h5>
                                                <p class="sub-title category"><a href="#">Adonis Music Pop</a></p>
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
                                <h2 class="title h3-md">Bảng Xếp Hạng</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="img-box-text-over lg box-rounded-lg mb-4 overlay-index">
                            <img src="{{url('client/images/this-week/popular-album-week.jpg')}}"
                                 data-2x="{{url('client/images/this-week/popular-album-week@2x.jpg')}}" alt="bxh-song">
                            <div class="hover-state show">
                                <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                    <h6 class="text-light font-weight-bold">BẢNG XẾP HẠNG TOP 50 BÀI HÁT</h6>
                                </div>
                                <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                    <a href="{{route('client.chart-song')}}" class="text-light"><i
                                                class="icon-arrow-right2"></i>
                                        Xem bảng xếp hạng<span class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-box-text-over lg  box-rounded-lg mb-4 overlay-index">
                            <img src="{{url('client/images/this-week/new-songs-week.jpg')}}"
                                 data-2x="{{url('client/images/this-week/new-songs-week@2x.jpg')}}" alt="bxh-album">
                            <div class="hover-state show">
                                <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                    <h6 class="text-light font-weight-bold">BẢNG XẾP HẠNG TOP 50 ALBUM</h6>
                                </div>
                                <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                    <a href="{{route('client.chart-album')}}" class="text-light"><i
                                                class="icon-arrow-right2"></i>
                                        Xem bảng xếp hạng<span class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-box-text-over lg  box-rounded-lg mb-4  overlay-index">
                            <img src="{{url('client/images/this-week/popular-artists-week.jpg')}}"
                                 data-2x="{{url('client/images/this-week/popular-artists-week@2x.jpg')}}" alt="bxh-artist">
                            <div class="hover-state show">
                                <div class="absolute-top-left pl-e-percent-10 pt-e-percent-8">
                                    <h6 class="text-light font-weight-bold">BẢNG XẾP HẠNG TOP 50 CA SĨ</h6>
                                </div>
                                <div class="absolute-bottom-right pr-e-percent-8 pb-e-percent-8">
                                    <a href="" class="text-light"><i
                                                class="icon-arrow-right2"></i>
                                        Xem bảng xếp hạng<span class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="d-flex">
                    <div class="title-box">
                        <h2 class="title h3-md">Thể Loại</h2>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('client.genres')}}" class="mb-4">Xem tất cả<span
                                    class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
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
                                             data-2x="{{url($genres->image)}}" alt="{{$genres->name}}" class="img-genres">
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
                                                            class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                version="1.1"><use
                                                                    xlink:href="#icon-see-all-arrow-right"/></svg></span>
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
                        <h2 class="title h3-md">Album Mới</h2>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'albums'])}}" class="mb-4">Xem tất cả<span
                                    class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
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
                                                                        data-album-id="{{$album->id}}" data-type="album"><i
                                                                            class="play-icon"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title"><a
                                                    href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a>
                                        </h6>
                                        <p class="sub-title category"><a href="">{{$album->artist->nick_name}}</a></p>
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
                        <h2 class="title h3-md">Danh sách phát mới</h2>
                    </div>
                    <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                        <a href="{{route('all', ['type' => 'playlists'])}}">Xem tất cả <span class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                    </div>
                </div>
                <div class="row">
                    @foreach($playLists as $playlist)
                        <div class="col-xxl-6 col-lg-6">
                            <div class="playlist-item-wrapper mb-md-2">
                                <div class="card-170">
                                    <a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">
                                        <div class="image lazyload-img loaded"><img
                                                    src="{{url($playlist->cover_image)}}">
                                        </div>
                                        <div class="opac"></div>
                                    </a>
                                </div>
                                <div class="playlist-info ">
                                    <div class="title"><a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])
                                    }}">{{$playlist->name}}</a></div>
                                    <i>{{count($playlist->songs)}} bài hát</i></div>
                                <div class="z-mix-list">
                                    <div class="list-trend">
                                        @foreach($playlist->getThreeSongs as $song)
                                            <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                                <div class="img-box img-box-sm box-rounded-sm">
                                                    <img src="{{url($song->cover_image)}}" alt="{{$song->name}}">
                                                </div>
                                                <div class="des">
                                                    <h6 class="title fs-2"><a href="#">{{$song->name}}</a>
                                                    </h6>
                                                    <p class="sub-title">
                                                        @foreach($song->artists as $artist)
                                                            <a href="#">
                                                                {{$artist->nick_name}}
                                                            </a>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div
                                                        class="hover-state d-flex justify-content-between align-items-center">
                                                                <span
                                                                        class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                                        data-type="song" data-album-id="{{$song->id}}"><i
                                                                            class="play-icon play-song"
                                                                            data-song-id="1"></i></span>
                                                    <div class="d-flex align-items-center">
                                                                    <span
                                                                            class="adonis-icon text-light pointer mr-2 icon-2x "><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                version="1.1"><use
                                                                                    xlink:href="#icon-heart-blank"/></svg></span>
                                                        <span class="pointer dropdown-menu-toggle"><span
                                                                    class="icon-dot-nav-horizontal text-light"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pt-e-20 pt-e-lg-40"></div>
            </section>

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h2 class="title h3-md">Ca Sĩ Nổi Bật</h2>
                    </div>
                    <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                        <a href="#">Xem tất cả<span class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmln s="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                    </div>
                </div>

                <div class="row auto-columns adonis-animate" data-animation="slideRightSkew"
                     data-animation-item=".music-img-box"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%"
                     style="opacity: 1;">
                    @foreach($artists as $artist)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                                <div class="img-box rounded-circle">
                                    <img class="retina" src="{{url($artist->avatar)}}"
                                         data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                                </div>
                                <div class="desc top-sm text-center">
                                    <h5 class="title fs-3">
                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}" class="f-w-500
                                        h-underline">{{$artist->nick_name}}</a>
                                    </h5>
                                    <p class="sub-title"><span class="count-follow" data-artist-id="{{$artist->id}}">{{$artist->follow}}</span>
                                        người theo dõi</p>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <a href="javascript:;" class="btn btn-primary btn-follow" data-artist-id="{{$artist->id}}">

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

