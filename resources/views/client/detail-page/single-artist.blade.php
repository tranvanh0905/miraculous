@extends('layouts.client.main')

@section('title')
    {{$singleArtist->nick_name}}
@endsection

@section('content')
    <div class="album-cover-bg blur-bottom artist-bg-1"
         style="background-image: url('{{url($singleArtist->cover_image)}}')"></div>
    <div class="container">
        <div class="album-spacer"></div>
        <div class="row justify-content-between">
            <div class="col-xl-7 text-center text-md-left">
                <h4 class="text-black">Ca sĩ</h4>
                <h1 class="fs-md-13 h1">{{$singleArtist->nick_name}}</h1>
                <div class="row">
                    <div class="col-md-5">
                        <div class="music-image-box text-center">
                            <div class="img-box mb-3"><img class="retina box-rounded-md"
                                                           src="{{url($singleArtist->avatar)}}"
                                                           data-2x="{{url($singleArtist->avatar)}}"
                                                           alt="{{url($singleArtist->nick_name)}}"></div>
                            <span class="adonis-icon"><i
                                    class="fas fa-users fa-1x"></i> {{number_format_short($singleArtist->follow)}}</span>
                            <span class="adonis-icon ml-3"><i class="fas fa-music fa-1x"></i> {{count($singleArtist->songs)}}</span>
                            <h4 class="font-weight- mt-3">{{$singleArtist->full_name}}</h4>
                        </div>
                    </div>
                    <div class="col-md-7 pt-3 pt-md-0">
                        <h3 class="mb-4">Giới thiệu</h3>
                        <div>
                            {!! $singleArtist->about !!}
                            <h6 class="inactive-color">Ngày sinh: {{convertDate($singleArtist->birthday)}}</h6>
                            @if($singleArtist->date_of_death != null)
                                <h6 class="inactive-color">Ngày mất: {{convertDate($singleArtist->date_of_death)}}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 text-center text-md-right mt-auto">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <button
                        class="btn btn-outline active-border rounded-btn btn-lg-wide mr-2 mr-md-4 btn-follow text-uppercase"
                        data-artist-id="{{$singleArtist->id}}">

                        @if(!\App\Model_client\UserFollowDetail::where('user_id', '=',
                        \Illuminate\Support\Facades\Auth::user()->id)
                        ->where
                        ('artist_id', '=', $singleArtist->id)->exists())
                            <i class="fas fa-user-plus"></i> Quan tâm
                        @else
                            <i class="fas fa-user-minus"></i> Bỏ quan tâm
                        @endif
                    </button>
                @endif
            </div>
        </div>
        <section>
            <div class="pt-4"></div>
            <div class="title-box">
                <h2 class="title h3-md">Bài hát</h2>
            </div>
            @if(count($singleArtist->songs) == 0)
                <div class="alert alert-secondary font-weight-bold"><i class="fas fa-exclamation fa-1x"></i> Các bài hát
                    của ca sĩ này đang được cập nhật...
                </div>
            @else
                <div class="adonis-carousel music-img-box-cont-sm" data-auto-width="no" data-loop="no"
                     data-dots="yes" data-items-responsive="0:1|600:2|900:3|1200:4">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            <div class="item">
                                <?php
                                $count_loop = 0;
                                $html = '</div><div class="item">';
                                ?>
                                @foreach($singleArtist->songs  as $song)
                                    <?php $count_loop++ ?>
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
                                                                      data-songid="{{$song->id}}">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($count_loop % 2==0)
                                        {!!$html!!}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
        <section>
            <div class="title-box">
                <h2 class="title h3-md">Albums</h2>
            </div>
            @if(count($singleArtist->albums) == 0)
                <div class="alert alert-secondary font-weight-bold"><i class="fas fa-exclamation fa-1x"></i> Các album
                    của ca sĩ này đang được cập nhật...
                </div>
            @else
                <div class="adonis-carousel auto-fit-columns" data-auto-width="yes" data-item-parent=".owl-carousel"
                     data-auto-fit-items=".item" data-dots="yes" data-item-width="260" data-item-max-width="280">
                    <div class="gutter-30">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach($singleArtist->albums  as $album)
                                <div class="item">
                                    <div class="music-img-box">
                                        <div class="img-box box-rounded-sm">
                                            <img class="retina" src="{{url($album->cover_image)}}"
                                                 data-2x="{{url($album->cover_image)}}" alt="{{$album->title}}">
                                            <div class="hover-state">
                                                <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                    <span class="pointer play-btn-dark round-btn adonis-album-button"
                                                          data-type="album" data-album-id="{{$album->id}}"><i
                                                            class="fas fa-play fs-21 text-light play-index"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="title"><a
                                                href="{{route('singleAlbum', ['album_id' => $album->id])}}">{{$album->title}}</a>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>
        <section>
            <div class="title-box">
                <h2 class="title h3-md">Các ca sĩ khác</h2>
            </div>
            <div class="row auto-columns adonis-animate" data-animation="slideRightSkew"
                 data-animation-item=".music-img-box"
                 data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%"
                 style="opacity: 1;">
                @foreach($otherArtist as $artist)
                    <div class="col-auto">
                        <div class="music-img-box mb-e-30 mb-e-md-40 text-center">
                            <div class="img-box rounded-circle img-artist-index">
                                <img class="retina" src="{{url($artist->avatar)}}"
                                     data-2x="{{url($artist->avatar)}}" alt="{{$artist->name}}">
                            </div>
                            <div class="desc top-sm text-center">
                                <h5 class="title fs-3">
                                    <a href="{{route('singleArtist', ['artistId' => $artist->id])}}" class="f-w-500
                                        h-underline">{{$artist->nick_name}}</a>
                                </h5>
                                <p class="sub-title"><span class="count-follow"
                                                           data-artist-id="{{$artist->id}}">{{number_format_short($artist->follow)}}</span>
                                    người quan tâm</p>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <a href="javascript:;" class="btn btn-primary btn-follow"
                                   data-artist-id="{{$artist->id}}">

                                    @if(!\App\Model_client\UserFollowDetail::where('user_id', '=',
                                    \Illuminate\Support\Facades\Auth::user()->id)
                                    ->where
                                    ('artist_id', '=', $artist->id)->exists())
                                        <i class="fas fa-user-plus"></i> Quan tâm
                                    @else
                                        <i class="fas fa-user-minus"></i> Bỏ quan tâm
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </section>
    </div>
@endsection
