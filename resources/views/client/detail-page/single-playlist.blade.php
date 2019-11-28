@extends('layouts.client.main')

@section('title')
    {{$singlePlaylist->name}}
@endsection

@section('content')
    <div class="album-wrap">
        <div class="container">
            <div class="pt-4 pt-lg-5"></div>
            <div class="row">
                <div class="col-md-3 flex-column-sidebar-md text-center text-md-left">
                    <div class="album-image text-center">
                        <div class="music-img-box d-inline-block">
                            <div class="img-box ">
                                <img class="retina box-rounded-md text-center" src="{{url($singlePlaylist->cover_image)}}"
                                     data-2x="{{url($singlePlaylist->cover_image)}}" alt="{{$singlePlaylist->name}}">
                            </div>
                            <div class="absolute-info">
                                <a class="btn btn-60-60 btn-primary absolute-center adonis-album-button round-btn text-light"
                                   data-album-id="{{$singlePlaylist->id}}" data-type="playList" role="button" tabindex="0">
                                            <span class="adonis-icon icon-play icon-2x"><svg
                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                            xlink:href="#icon-brand-play"></use></svg></span>
                                    <span class="adonis-icon icon-pause icon-2x"><svg version="1.1"
                                                                                      xmlns="http://www.w3.org/2000/svg"
                                                                                      height="20"
                                                                                      viewBox="0 0 29 32"><path
                                                    d="M19.2 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z"></path><path
                                                    d="M1.6 0h8c0.884 0 1.6 0.716 1.6 1.6v28.8c0 0.884-0.716 1.6-1.6 1.6h-8c-0.884 0-1.6-0.716-1.6-1.6v-28.8c0-0.884 0.716-1.6 1.6-1.6z"></path></svg></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="pb-2 album-likes text-center">
                        <span class="adonis-icon pr-2 icon-2x"><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    version="1.1">
                                <use xlink:href="#icon-heart-blank"></use>
                            </svg>
                        </span>
                        <span class="pr-2 count-like-playlist">{{$singlePlaylist->like}}</span>
                    </div>
                    <div class="button-save-share pb-4 text-center">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(\App\Model_client\UserLikedPlaylist::where
                                                            ('user_id', '=',
              \Illuminate\Support\Facades\Auth::id())->where('playlist_id', '=', $singlePlaylist->id)->exists())
                                <a class="btn btn-primary mx-auto" id="likeGlobal" data-type="playlist" data-id="{{$singlePlaylist->id}}"
                                     href="javascript:;"><i class="fas fa-heart-broken"></i> Bỏ yêu thích</a>
                            @else
                                <a class="btn btn-primary mx-auto" id="likeGlobal" data-type="playlist" data-id="{{$singlePlaylist->id}}"
                                     href="javascript:;"><i class="fas fa-heart"></i> Yêu thích</a>
                            @endif
                        @endif
                    </div>
                    <div class="about">
                        <h4>Mô tả</h4>
                        <p>{{$singlePlaylist->description}}</p>
                    </div>
                </div>
                <div class="col-md-9 flex-column-content-md pl-e-xl-40">
                    <div class="album-top-box text-center text-md-left">
                        <h6 class="inactive-color text-uppercase">Danh sách phát</h6>
                        <h1 class="album-title">{{$singlePlaylist->name}}</h1>
                        <div class="separator mb-2 mt-1">
                            <span class="separator-md"></span>
                        </div>
                        <p class="mb-2">{{count($singlePlaylist->songs)}} bài hát</p>
                    </div>
                    <hr>
                    <div class="tab-wrapper">
                        <div class="pb-2"></div>
                        <div class="d-flex mb-3  justify-content-between">
                            <h3 class="font-weight-bold">Danh sách bài hát</h3>

                            <a class="btn text-white btn-primary adonis-album-button" data-type="playList"
                               data-album-id="{{$singlePlaylist->id}}"> <span class="hover-show adonis-icon icon-1x"><svg
                                            xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                xlink:href="#icon-brand-play"></use></svg> </span> Phát tất cả</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="single-songs" role="tabpanel"
                                 aria-labelledby="single-songs-tab">
                                <div class="shop-items">
                                    <ul class="adonis-album-list pb-5">
                                        @foreach($singlePlaylist->songs as $song)
                                            <li class="item hover-bg-item">
                                                <div class="item-number">
                                                    <span class="hover-hide">
                                                           <img src="{{url($song->cover_image)}}" alt="{{$song->name}}"
                                                                width="50px" height="50px" class="rounded">
                                                    </span>
                                                    <span class="hover-show adonis-icon icon-1x adonis-album-button" data-type="song"
                                                          data-album-id="{{$song->id}}"><svg
                                                                xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                    xlink:href="#icon-brand-play"></use></svg> </span>
                                                </div>
                                                <a href="{{route('singleSong', ['songId' => $song->id])}}" class="item-title">{{$song->name}}</a>
                                                <div class="item-genre"><a href="{{route('singleGenres', ['genresId' => $song->genres->id])}}"
                                                                           class="hover-hide hover-lg-show">{{$song->genres->name}}</a>
                                                </div>
                                                <div class="item-tools">
                                                    <span class="hover-hide">{{$song->view}} <i class="fas fa-headphones-alt fa-1x"></i></span>
                                                    <div class="hover-show d-flex flex-nowrap hover-tools">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                            @if(count(\App\Model_client\UserLikedSong::where
                                                            ('user_id', '=',
              \Illuminate\Support\Facades\Auth::id())->where('song_id', '=', $song->id)->get()) == 1)
                                                                <span class="adonis-icon icon-2x pointer  box-dis-like-global">
                                                                        <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                           data-id="{{$song->id}}"
                                                                        ></i>
                                                                      </span>
                                                            @else
                                                                <span class="adonis-icon icon-2x pointer box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"></i>
                                                                    </span>
                                                            @endif

                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="hover-bg gradient-adonis"></div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="more-items">
                <div class="title-box">
                    <h2 class="title h3-md">Các danh sách phát khác</h2>
                </div>
                <div class="adonis-carousel auto-fit-columns" data-auto-width="yes"
                     data-item-parent=".owl-carousel" data-auto-fit-items=".item" data-dots="yes"
                     data-item-width="260" data-item-max-width="280">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($relatedPlaylist as $playlist)
                                <div class="item hover-bg-item">
                                    <div class="music-img-box">
                                        <div class="img-box box-rounded-sm">
                                            <img class="retina"
                                                 src="{{url($playlist->cover_image)}}"
                                                 data-2x="{{url($playlist->cover_image)}}"
                                                 alt="{{$playlist->name}}">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="playList"
                                                              data-album-id=""{{$playlist->id}}><i
                                                                    class="play-icon"></i></span>
                                                </div>
                                                <div class="absolute-top-right pr-e-20 pt-e-20">
                                                        <span class="pointer dropdown-menu-toggle"><span
                                                                    class="adonis-icon icon-4x"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                            xlink:href="#icon-horizontal-dots"></use></svg></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title"><a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">
                                                {{$playlist->name}}
                                            </a></h6>
                                        <p class="sub-title category">
                                            {{count($playlist->songs)}} bài hát
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pt-e-5 pt-e-lg-10"></div>
            </div>
        </div>
    </div>
@endsection
