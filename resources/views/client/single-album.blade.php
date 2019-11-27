@extends('layouts.client.main')

@section('title')
    {{$singleAlbum->title}}
@endsection

@section('content')
    <div class="album-wrap">
        <div class="container">
            <div class="pt-4 pt-lg-5"></div>
            <div class="row">
                <div class="col-md-3 flex-column-sidebar-md text-center text-md-left">
                    <div class="album-image text-center">
                        <div class="music-img-box d-inline-block">
                            <div class="img-box">
                                <img class="retina box-rounded-md" src="{{$singleAlbum->cover_image}}"
                                     data-2x="{{$singleAlbum->cover_image}}" alt="{{$singleAlbum->title}}">
                            </div>
                        </div>
                    </div>
                    <div class="pb-1 album-likes text-center">
                                <span class="adonis-icon pr-2 icon-2x"><svg xmlns="http://www.w3.org/2000/svg"
                                                                            version="1.1"><use
                                                xlink:href="#icon-heart-blank"></use></svg></span>
                        <span class="pr-2 count-like-album" id="likeAlbum{{$singleAlbum->id}}">{{$singleAlbum->like}}</span>
                    </div>
                    <div class="button-save-share pb-4 text-center">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(\App\Model_client\UserLikedAlbum::where
                                                            ('user_id', '=',
              \Illuminate\Support\Facades\Auth::id())->where('album_id', '=', $singleAlbum->id)->exists())
                                <div class="btn btn-primary mx-auto" id="likeGlobal" data-type="album" data-id="{{$singleAlbum->id}}"><i
                                            class="fas fa-heart-broken "></i> Bỏ yêu
                                    thích album</div>
                            @else
                                <div class="btn btn-primary mx-auto" id="likeGlobal" data-type="album" data-id="{{$singleAlbum->id}}"><i class="fas
                                 fa-heart"></i> Yêu thích album</div>
                            @endif
                        @endif
                    </div>
                    <div class="about text-justify">
                        <h4 class="text-center">Mô tả</h4>
                        <p>
                            {{$singleAlbum->description}}
                        </p>
                    </div>

                </div>
                <div class="col-md-9 flex-column-content-md pl-e-xl-40">
                    <div class="album-top-box text-center text-md-left">
                        <h6 class="inactive-color">ALBUM</h6>
                        <h1 class="album-title"> {{$singleAlbum->title}}</h1>
                        <p class="mb-2">Trình bày: <a href="{{route('singleArtist', ['artistId' => $singleAlbum->artist_id])}}">Danielle
                                Bradberry</a></p>
                        <div class="separator mb-4 mt-4">
                            <span class="separator-md"></span>
                        </div>
                        <p class="mb-2">{{count($songOfAlbum)}} bài hát</p>
                        <p class="mb-2">Ra mắt chính thức {{$singleAlbum->release_date}}</p>
                    </div>

                    <div class="tab-wrapper">
                        <div class="pb-2"></div>
                        <div class="d-flex mb-3 justify-content-between">
                            <h3 class="font-weight-bold">Danh sách bài hát</h3>
                            <a class="btn text-white btn-primary adonis-album-button" data-type="album"
                               data-album-id="{{$singleAlbum->id}}"> <span class="hover-show adonis-icon icon-1x"><svg
                                            xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                xlink:href="#icon-brand-play"></use></svg> </span> Phát tất cả</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="single-songs" role="tabpanel"
                                 aria-labelledby="single-songs-tab">
                                <div class="shop-items">
                                    <ul class="adonis-album-list pb-5">
                                        @foreach($songOfAlbum as $song)
                                            <li class="item hover-bg-item">
                                                <div class="item-number">
                                                    <span class="hover-hide">
                                                         <img src="{{url($song->cover_image)}}" alt="{{$song->name}}"
                                                              width="50px" height="50px" class="rounded">
                                                    </span>
                                                    <span class="hover-show adonis-icon icon-1x adonis-album-button" data-type="song"
                                                          data-album-id="{{$song->id}}"><svg
                                                                xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                    xlink:href="#icon-brand-play"></use></svg></span>
                                                </div>
                                                <a href="{{route('singleSong', ['songId' => $song->id])}}" class="item-title">{{$song->name}}</a>
                                                <div class="item-genre"><a href="{{route('singleGenres', ['genresId' => $song->genres->id])}}"
                                                                           class="hover-hide hover-lg-show">{{$song->genres->name}}</a>
                                                </div>
                                                <div class="item-tools">
                                                    <span class="hover-hide" id="likeSong{{$song->id}}">{{$song->view}}
                                                        <i class="fas fa-headphones-alt fa-1x"></i></span>
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
                <div class="pt-e-20 pt-e-lg-40"></div>
                <div class="title-box">
                    <h2 class="title h3-md">Xem thêm album của Danielle Bradbery</h2>
                </div>
                <div class="adonis-carousel auto-fit-columns" data-auto-width="yes"
                     data-item-parent=".owl-carousel" data-auto-fit-items=".item" data-dots="yes"
                     data-item-width="260" data-item-max-width="280">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($relateAlbum as $album)
                                <div class="item hover-bg-item">
                                    <div class="music-img-box">
                                        <div class="img-box box-rounded-sm">
                                            <img class="retina"
                                                 src="{{$album->cover_image}}"
                                                 data-2x="{{$album->cover_image}}"
                                                 alt="">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="album"
                                                              data-album-id="{{$album->id}}"><i
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
                                        <h6 class="title"><a href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a></h6>
                                        <p class="sub-title category"><a href="#">Adonis Music Pop</a></p>
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
