@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Bài hát
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Bài hát</h2>
            </div>
        </div>
        @if(count($songLiked) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa thích bài hát nào</h3>
                        <a href="{{route('all', ['type' => 'songs'])}}">Nhấn để khám phá</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row auto-fit-columns adonis-animate" data-animation="slideUp" data-animation-item=".col-auto"
                 data-item-width="350" data-item-max-width="350">
                @foreach($songLiked as $song)
                    <div class="col-auto">
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
                                                                    <i class="far fa-heart fa-2x font-14"
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
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-3">
                    {{ $songLiked->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
