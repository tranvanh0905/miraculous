@extends('layouts.client.main')

@section('title')
    Tất cả @if($type == 'albums') Album @elseif($type == 'songs') Bài hát @elseif($type == 'playlists') Danh sách phát @elseif($type == 'artists')
        Ca sĩ @endif
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    @if($type == 'albums')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase">Tất cả album</h4>
                </div>
                <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                    @foreach($allAlbum as $album)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-lg-40">
                                <div class="img-box box-rounded-sm">
                                    <img class="retina" src="{{url($album->cover_image)}}"
                                         data-2x="{{url($album->cover_image)}}" alt="{{$album->title}}">
                                    <div class="hover-state">
                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                            <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="album"
                                                  data-album-id="{{$album->id}}"><i
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
                                <h6 class="title"><a href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a></h6>
                                <p class="sub-title category"><a href="{{route('singleArtist', ['artistId' => $album->artist->id])
                            }}">{{$album->artist->nick_name}}</a></p>
                            </div>
                        </div>
                    @endforeach

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
                                                  data-album-id="{{$playlist->id}}"><i
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
                                <h6 class="title"><a href="{{route('singlePlaylist', ['playlistId' => $playlist->id])}}">{{$playlist->name}}</a></h6>
                                <p class="sub-title category">{{count($playlist->songs)}} bài hát</p>
                            </div>
                        </div>
                    @endforeach

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
                <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                    @foreach($allSong as $song)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-lg-40">
                                <div class="img-box box-rounded-sm">
                                    <img class="retina" src="{{url($song->cover_image)}}"
                                         data-2x="{{url($song->cover_image)}}" alt="{{$song->name}}">
                                    <div class="hover-state">
                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                            <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="song"
                                                  data-album-id="{{$song->id}}"><i
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
                                <h6 class="title"><a href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a></h6>
                                <p class="sub-title category">
                                    @foreach($song->artists as $artist)
                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @elseif($type == 'artists')
        <div class="container">
            <main id="main">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase">Tất cả ca sĩ</h4>
                </div>
                <div class="row auto-columns adonis-animate" data-animation="slideRightSkew"
                     data-animation-item=".music-img-box"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                    @foreach($allArtist as $artist)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-md-40">
                                <div class="img-box rounded-circle">
                                    <img class="retina" src="{{url($artist->avatar)}}"
                                         data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                                </div>
                                <div class="desc top-sm text-center">
                                    <h5 class="title fs-3">
                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}" class="f-w-500
                                        h-underline">{{$artist->nick_name}}</a>
                                    </h5>
                                    <h6 class="f-w-400"><a href="#">Theo dõi</a></h6>
                                    <p class="sub-title"><a href="#">{{$artist->follow}} người theo dõi</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </div>
    @endif
@endsection
