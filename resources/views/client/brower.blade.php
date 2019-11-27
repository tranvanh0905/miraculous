@extends('layouts.client.main')

@section('title')
    Khám phá
@endsection

@section('content')
    <div class="master-container-fluid">
        <div class="pt-4 pt-lg-5"></div>
        <div class="pr-0 pr-e-md-15">

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h2 class="title h3-md mb-e-20 mb-e-lg-40 text-uppercase">Khám phá</h2>
                        <h4 class="title">Bài hát</h4>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'songs'])}}" class="inactive-color mr-md-0 mb-4">Xem tất cả<span
                                    class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                    </div>
                </div>
                <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                     data-auto-width="no" data-loop="no" data-dots="yes"
                     data-items-responsive="0:1|600:2|900:3|1200:4|1500:5">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">


                            <div class="item">
                                <?php
                                $count_loop = 0;
                                $html = '</div><div class="item">';
                                ?>

                                @foreach($allSong as $song)
                                    <?php $count_loop++;?>
                                    <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                        <div class="img-box img-box-sm box-rounded-sm">
                                            <img src="{{$song->cover_image}}" alt="{{$song->name}}">
                                        </div>
                                        <div class="des">
                                            <h6 class="title"><a href="#">{{$song->name}}</a></h6>
                                            <p class="sub-title">
                                                @foreach($song->artists as $artist)
                                                    <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="hover-state d-flex justify-content-between align-items-center">
                                                <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                      data-album-id="{{$song->id}}" data-type="song"><i
                                                            class="play-icon"></i></span>
                                            <div class="d-flex align-items-center">
                                                    <span class="adonis-icon text-light pointer mr-2 icon-2x"><svg
                                                                xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                    xlink:href="#icon-heart-blank"></use></svg></span>
                                                <span class="pointer dropdown-menu-toggle"><span
                                                            class="icon-dot-nav-horizontal text-light"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($count_loop % 5==0)
                                        {!!$html!!}
                                    @endif
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
                <div class="pt-e-20 pt-e-lg-40"></div>
            </section>

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h4 class="title">Album</h4>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'albums'])}}" class="inactive-color mr-md-0 mb-4">Xem tất cả<span
                                    class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                    </div>
                </div>
                <div class="adonis-carousel auto-fit-columns viewport-animate" data-animation="slideUp"
                     data-animation-item=".item" data-auto-width="yes" data-item-parent=".owl-carousel"
                     data-auto-fit-items=".item" data-dots="yes" data-item-width="175"
                     data-item-max-width="180">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            <div class="item">
                                <?php
                                $count_loop = 0;
                                $html = '</div><div class="item">';
                                ?>
                                @foreach($allAlbum as $album)
                                    <?php $count_loop++ ?>
                                    <div class="music-img-box  @if($count_loop % 2 != 0) mb-2 @endif">
                                        <div class="img-box box-rounded-sm img-box-md">
                                            <img class="retina" src="{{url($album->cover_image)}}"
                                                 data-2x="{{url($album->cover_image)}}" alt="{{$album->name}}">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-15 pb-e-15">
                                                        <span
                                                                class="pointer play-btn-dark round-btn adonis-album-button"
                                                                data-type="album" data-album-id="{{$album->id}}"><i
                                                                    class="play-icon"></i></span>
                                                </div>
                                                <div class="absolute-top-right pr-e-15 pt-e-15">
                                                        <span class="pointer dropdown-menu-toggle"><span
                                                                    class="adonis-icon icon-4x"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                                            xlink:href="#icon-horizontal-dots"></use></svg></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title">
                                            <a href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a>
                                        </h6>
                                        <p class="sub-title category">
                                            <a href="{{route('singleArtist', ['artistId' => $album->artist->id])}}">{{$album->artist->nick_name}}</a>
                                        </p>
                                    </div>
                                    @if($count_loop % 2 == 0)
                                        {!!$html!!}
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="d-flex flex-row">
                    <div class="title-box">
                        <h4>Danh sách phát</h4>
                    </div>
                    <div class="button-right ml-auto ml-auto d-flex align-items-end">
                        <a href="{{route('all', ['type' => 'playlists'])}}" class="inactive-color mr-md-0 mb-4">Xem tất cả<span
                                    class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                            xlink:href="#icon-see-all-arrow-right"/></svg></span></a>
                    </div>
                </div>

                <div class="adonis-carousel auto-fit-columns adonis-animate" data-animation="slideUp"
                     data-animation-item=".item" data-auto-width="yes" data-item-parent=".owl-carousel"
                     data-auto-fit-items=".item" data-dots="yes" data-item-width="260"
                     data-item-max-width="280">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($allPlaylist as $playlist)
                                <div class="item">
                                    <div class="music-img-box">
                                        <div class="img-box box-rounded-sm">
                                            <img class="retina"
                                                 src="{{url($playlist->cover_image)}}"
                                                 data-2x="{{url($playlist->cover_image)}}"
                                                 alt="{{url($playlist->name)}}">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-20">
                                                        <span
                                                                class="pointer play-btn-dark round-btn adonis-album-button"
                                                                data-type="playList" data-album-id="{{$playlist->id}}"><i
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
                                        <h6 class="title"><a href="#">{{$playlist->name}}</a></h6>
                                        <p class="sub-title category">{{count($playlist->songs)}} bài hát</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
