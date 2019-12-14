@extends('layouts.client.main')

@section('title')
    {{$genres->name}}
@endsection

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="col-xl-9">
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h3 class="title h3-md"><i class="fas fa-music fs-19"></i> {{$genres->name}}</h3>
                    </div>
                </div>
                {!! $genres->description !!}
                <hr class="w-100 mt-0">
                @if(count($songOfGenres) == 0)
                    <div class="text-center pt-3 mb-3 rounded update">
                        <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                        <img src="{{url('client/images/loading.gif')}}" alt="loading" width="100px"
                             height="auto">
                    </div>
                @else
                    <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                         data-animation-item=".col-auto"
                         data-item-width="350" data-item-max-width="520">
                        @foreach($songOfGenres as $song)
                            <div class="col-auto">
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
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 pt-3">
                            {{ $songOfGenres->links() }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-xl-3">
                <div class="widget">
                    <div class="d-flex justify-content-between inactive-colored-links mb-3">
                        <h3><i class="fas fa-headphones fs-19"></i> Nghe nhiều của {{$genres->name}}</h3>
                    </div>
                    @if(count($mostViewOfGenres) == 0)
                        <div class="text-center pt-3 mb-3 rounded update">
                            <h3 class="mb-0 text-light">Đang cập nhật bài hát...</h3>
                            <img src="{{url('client/images/loading.gif')}}" alt="loading" width="100px"
                                 height="auto">
                        </div>
                    @else
                        @foreach($mostViewOfGenres as $song)
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
                        @endforeach
                    @endif
                </div>
                <div class="widget">
                    <h3 class="widget-title h3-md"><i class="fas fa-boxes"></i> Thể loại khác</h3>
                    <div class="tagcloud">
                        @foreach($otherGenres as $genre)
                            <a href="{{route('singleGenres', ['genresId' => $genre->id])}}">{{$genre->name}}</a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
