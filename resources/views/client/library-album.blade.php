@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Album đã thích
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Album</h2>
            </div>
        </div>

        @if(count($likedAlbum) == 0)
            <div class="row">
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Bạn chưa thích album nào</h3>
                        <a href="{{route('all', ['type' => 'albums'])}}">Nhấn để khám phá</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row auto-fit-columns adonis-animate" data-animation="slideUp"
                 data-animation-item=".music-img-box" data-item-width="230" data-item-max-width="260">
                @foreach($likedAlbum as $album)
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
                            <p class="sub-title category">
                                <a href="{{route('singleArtist', ['artistId' => $album->artist_id])}}">{{$album->artist->nick_name}}</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-3">
                    {{ $likedAlbum->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
