@extends('layouts.client.main')

@section('title')
    {{$singlePlaylist->name}}
@endsection

@section('content')
    <div class="album-wrap" data-playlist-id="{{$singlePlaylist->id}}">
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
                    <div class="about">
                        <h4>Mô tả</h4>
                        <p>{{$singlePlaylist->description}}</p>
                    </div>
                </div>
                <div class="col-md-9 flex-column-content-md pl-e-xl-40">
                    <div class="album-top-box text-center text-md-left">
                        <h6 class="inactive-color text-uppercase">Danh sách phát cá nhân</h6>
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
                                    <ul class="adonis-album-list" id="main-song">
                                        @foreach($singlePlaylist->songs as $song)
                                            <li class="item hover-bg-item" data-song-id="{{$song->id}}">
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
                                                <a href="{{route('singleSong', ['songId' => $song->id])}}"
                                                   class="item-title font-weight-bold">{{$song->name}}</a>
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
                                                                <span class="adonis-icon icon-2x pointer  box-dis-like-global d-flex">
                                                                        <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                           data-id="{{$song->id}}"
                                                                        ></i>
                                                                        <i class="fas fa-times fa-2x font-14 ml-2 remove-from-playlist"
                                                                           data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"
                                                                        ></i>
                                                                      </span>
                                                            @else
                                                                <span class="adonis-icon icon-2x pointer box-like-global d-flex">
                                                                    <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"></i>
                                                                      <i class="fas fa-times fa-2x font-14 ml-2 remove-from-playlist"
                                                                         data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"
                                                                      ></i>
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


                    <div class="row pt-3">
                        <div class="col-6">
                            <h3>Bài hát gợi ý</h3>
                            <p>Dựa trên các bài hát trong danh sách phát của bạn</p>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn text-dark btn-secondary" id="reload-suggest"><i class="fas fa-sync mr-3"></i>Làm mới</a>
                        </div>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="single-songs" role="tabpanel"
                                 aria-labelledby="single-songs-tab">
                                <div class="shop-items">
                                    <ul class="adonis-album-list" id="suggest-song">
                                        @foreach($suggestSong as $song)
                                            <li class="item hover-bg-item item-2" data-song-id="{{$song->id}}">
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
                                                <a href="{{route('singleSong', ['songId' => $song->id])}}" class="item-title font-weight-bold">{{$song->name}}</a>
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
                                                                <span class="adonis-icon icon-2x pointer  box-dis-like-global d-flex ">
                            <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                               data-id="{{$song->id}}"
                            ></i><i class="fas fa-plus fa-2x font-14 ml-2 add-to-playlist"
                                    data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"></i>
                        </span>
                                                            @else
                                                                <span class=" adonis-icon icon-2x pointer box-like-global d-flex ">
                            <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                               data-id="{{$song->id}}"></i>
                            <i class="fas fa-plus fa-2x font-14 ml-2 add-to-playlist"
                               data-song-id="{{$song->id}}" data-playlist-id="{{$singlePlaylist->id}}"></i>
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
        </div>
    </div>
@endsection