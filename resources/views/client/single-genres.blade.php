@extends('layouts.client.main')

@section('title')
    {{$genres->name}}
@endsection

@section('content')
    <div class="container">
        <div class="pt-4 pt-lg-5"></div>
        <div class="pr-0 pr-e-md-15">
            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h2 class="title h3-md mb-e-20 mb-e-lg-40">{{$genres->name}}</h2>
                        <h4 class="title">Mới nhất của {{$genres->name}}</h4>
                    </div>
                </div>

                @if(count($latestSong) == 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="no-content-block text-center p-5 rounded">
                                <img src="{{url('client/images/audio_default.png')}}" alt="no-song"
                                     class="d-block mx-auto img-genres"
                                     width="100px" height="auto">
                                <h3 class="m-3">Các bài hát đang được cập nhật...</h3>
                                <a href="{{route('client.genres')}}">Khám phá thể loại khác</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="adonis-carousel auto-fit-columns viewport-animate" data-animation="slideUp"
                         data-animation-item=".item" data-auto-width="yes" data-item-parent=".owl-carousel"
                         data-auto-fit-items=".item" data-dots="yes" data-item-width="175"
                         data-item-max-width="180">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                @foreach($latestSong as $song)
                                    <div class="item">

                                        <div class="music-img-box  mb-e-30 mb-e-md-40 ">
                                            <div class="img-box box-rounded-sm img-box-md">
                                                <img class="retina" src="{{$song->cover_image}}"
                                                     data-2x="{{$song->cover_image}}" alt="{{$song->name}}">
                                                <div class="hover-state">
                                                    <div
                                                            class="absolute-bottom-left pl-e-15 pb-e-15 adonis-album-button"
                                                            data-type="song" data-album-id="{{$song->id}}">
                                                        <span class="pointer play-btn-dark round-btn"><i
                                                                    class="play-icon"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="title"><a
                                                        href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a>
                                            </h6>
                                            <p class="sub-title category"><a href="#">Adonis Music Pop</a></p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h4 class="title">Yêu thích nhiều nhất</h4>
                    </div>
                </div>

                @if(count($mostLikeGenres) == 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="no-content-block text-center p-5 rounded">
                                <img src="{{url('client/images/audio_default.png')}}" alt="no-song"
                                     class="d-block mx-auto"
                                     width="100px" height="auto">
                                <h3 class="m-3">Các bài hát đang được cập nhật...</h3>
                                <a href="{{route('client.genres')}}">Khám phá thể loại khác</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="adonis-carousel auto-fit-columns viewport-animate" data-animation="slideUp"
                         data-animation-item=".item" data-auto-width="yes" data-item-parent=".owl-carousel"
                         data-auto-fit-items=".item" data-dots="yes" data-item-width="175"
                         data-item-max-width="180">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                @foreach($mostLikeGenres as $song)
                                    <div class="item">

                                        <div class="music-img-box  mb-e-30 mb-e-md-40 ">
                                            <div class="img-box box-rounded-sm img-box-md">
                                                <img class="retina" src="{{$song->cover_image}}"
                                                     data-2x="{{$song->cover_image}}" alt="{{$song->name}}">
                                                <div class="hover-state">
                                                    <div
                                                            class="absolute-bottom-left pl-e-15 pb-e-15 adonis-album-button"
                                                            data-type="song" data-album-id="{{$song->id}}">
                                                        <span class="pointer play-btn-dark round-btn"><i
                                                                    class="play-icon"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="title"><a
                                                        href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a>
                                            </h6>
                                            <p class="sub-title category"><a href="#">Adonis Music Pop</a></p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </section>

            <div class="title-box">
                <h6 class="sub-title inactive-color">{{$genres->name}}</h6>
                <h3 class="title">Tất cả bài hát thể loại {{$genres->name}}</h3>
            </div>
            @if(count($songOfGenres) == 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="no-content-block text-center p-5 rounded">
                            <img src="{{url('client/images/audio_default.png')}}" alt="no-song"
                                 class="d-block mx-auto"
                                 width="100px" height="auto">
                            <h3 class="m-3">Các bài hát đang được cập nhật...</h3>
                            <a href="{{route('client.genres')}}">Khám phá thể loại khác</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row auto-columns viewport-animate" data-animation="slideUp" data-animation-item=".col-auto"
                     data-item-parent=".auto-columns"
                     data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%">
                    @foreach($songOfGenres as $song)
                        <div class="col-auto">
                            <div class="music-img-box mb-e-30 mb-e-lg-40">
                                <div class="img-box box-rounded-sm">
                                    <img class="retina" src="{{$song->cover_image}}"
                                         data-2x="{{$song->cover_image}}" alt="{{$song->name}}">
                                    <div class="hover-state">
                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                        <span class="pointer play-btn-dark round-btn adonis-album-button"
                                              data-album-id="{{$song->id}}" data-type="song"><i
                                                    class="play-icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="title"><a
                                            href="{{route('singleSong', ['songId' => $song->id])}}">{{$song->name}}</a></h6>
                                <p class="sub-title category">
                                    @foreach($song->artists as $artist)
                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a>
                                    @endforeach
                                </p>
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
            <div class="title-box">
                <h3 class="title">Các thể loại khác</h3>
            </div>
            <div class="genres-list row">
                @foreach($otherGenres as $genres)
                    <div class="item col-lg-2 mb-3">
                        <div class="img-box-text-over lg box-rounded-lg">
                            <img src="{{$genres->image}}"
                                 data-2x="{{$genres->image}}" alt="{{$genres->name}}" height="155">
                            <div class="absolute-info d-flex flex-column justify-content-between">
                                <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">Thể Loại
                                </div>
                                <div>
                                    <h4 class="fs-7 m-0 text-light text-center"><span
                                                class="font-weight-bold">{{$genres->name}}</span>
                                    </h4>
                                </div>
                                <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                    <a href="{{route('singleGenres', ['genresId' => $genres->id])}}"
                                       class="color-white">Xem<span
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
@endsection
