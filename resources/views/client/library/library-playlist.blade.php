@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Danh sách phát đã thích
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Danh sách phát</h2>
            </div>
        </div>

        @if(count($likedPlaylist) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa thích danh sách phát nào nào</h3>
                        <a href="{{route('all', ['type' => 'playlists'])}}">Nhấn để khám phá</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                 data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                @foreach($likedPlaylist as $playList)
                    <div class="col-auto">
                        <div class="music-img-box mb-e-30 mb-e-lg-40">
                            <div class="img-box box-rounded-sm">
                                <img class="retina" src="{{url($playList->cover_image)}}"
                                     data-2x="{{url($playList->cover_image)}}" alt="{{$playList->title}}">
                                <div class="hover-state">
                                    <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                            <span class="pointer play-btn-dark round-btn adonis-album-button" data-type="playlist"
                                                  data-album-id="{{$playList->id}}"><i
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
                            <h6 class="title mb-3"><a href="{{route('singlePlaylist', ['playlistId' => $playList->id])}}">{{$playList->name}}</a></h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-3">
                    {{ $likedPlaylist->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
