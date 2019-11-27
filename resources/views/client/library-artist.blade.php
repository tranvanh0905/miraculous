@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Ca sĩ
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Ca sĩ</h2>
            </div>
        </div>

        <div class="row">
            @if(count($likedSong) == 0)
                <div class="col-12">
                    <div class="no-content-block text-center p-5 rounded">
                        <img src="{{url('client/images/audio_default.png')}}" alt="no-song" class="d-block mx-auto"
                             width="100px" height="auto">
                        <h3 class="m-3">Không có bài hát trong thư viện cá nhân</h3>
                        <a href="{{route('all', ['type' => 'songs'])}}">Nhấn để khám phá</a>
                    </div>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="adonis-carousel music-img-box-cont-sm viewport-animate" data-items="1"
                         data-animation="slideUp" data-animation-item=".item" data-auto-width="yes"
                         data-loop="no" data-dots="yes"
                         data-responsive-width="0:100%|600:50%|900:33.33%|1200:25%">
                        <div class="gutter-30">
                            <div class="owl-carousel owl-theme-adonis">
                                <div class="item">
                                    <?php
                                    $count_loop = 0;
                                    $html = '</div><div class="item">';
                                    ?>
                                    @foreach($likedSong as $song)
                                        <?php $count_loop++ ?>
                                        <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                            <div class="img-box img-box-sm box-rounded-sm">
                                                <img src="{{$song->cover_image}}" alt="{{$song->name}}">
                                            </div>
                                            <div class="des">
                                                <h6 class="title fs-2"><a href="#">{{$song->name}}</a></h6>
                                                <p class="sub-title">
                                                    @foreach($song->artists as $artist)
                                                        <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a>
                                                    @endforeach
                                                </p>
                                            </div>

                                            <div class="hover-state d-flex justify-content-between align-items-center">
                                                <span class="pointer play-btn-dark box-rounded-sm adonis-album-button" data-album-id="{{$song->id}}"
                                                      data-type="song">
                                                    <i class="play-icon"></i>
                                                </span>
                                                <div class="d-flex align-items-center">
                                                    <span class="pointer dropdown-menu-toggle">
                                                        <span class="icon-dot-nav-horizontal text-light"></span>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        @if($count_loop % 4==0)
                                            {!!$html!!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
