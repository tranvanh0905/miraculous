@extends('layouts.client.main')

@section('title')
    {{$singleSong->name}}
@endsection

@section('content')
    <div class="album-wrap">
        <div class="container">

            <div class="pt-4 pt-lg-5"></div>

            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 col-md-9">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="album-image">
                                <div class="music-img-box d-inline-block">
                                    <div class="img-box">
                                        <img class="retina box-rounded-md" src="{{url($singleSong->cover_image)}}"
                                             data-2x="{{url($singleSong->cover_image)}}"
                                             alt="{{url($singleSong->name)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="pb-4 d-inline-block album-likes ">
                                <span class="adonis-icon pr-2 icon-2x">
                                    <i class="fas fa-heart fs-19"></i>
                                </span>
                                <span class="pr-2">{{$singleSong->like}}</span>
                                <span class="adonis-icon pr-2 icon-1x">
                                    <i class="fas fa-play-circle fs-19"></i>
                                </span>
                                <span>{{$singleSong->view}}</span>
                            </div>
                            <div class="button-save-share pb-4 text-center">
                                <div class="btn btn-primary mx-auto adonis-album-button" data-type="song"
                                     data-album-id="{{$singleSong->id}}"><i class="fas fa-play fs-14 mr-2"></i> Phát bài
                                    hát
                                </div>
                            </div>
                            <div class="about">
                                <h4>Mô tả</h4>
                                {!! $singleSong->description !!}
                            </div>
                        </div>

                        <div class="col-md-9 pl-e-xl-40">
                            <div class="album-top-box text-center text-md-left">
                                <h6 class="inactive-color">BÀI HÁT</h6>
                                <h1 class="album-title">{{$singleSong->name}}</h1>
                                <p class="mb-2">
                                    Ca sĩ:
                                    @foreach($singleSong->artists as $artist)
                                        <a href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                            , @endif
                                    @endforeach

                                    @if($singleSong->genres !== null && $singleSong->genres->name !== null)
                                        <br> Thể loại:
                                        <a href="{{route('singleGenres', ['genresId' => $singleSong->genres_id])}}">
                                            {{$singleSong->genres->name}}
                                        </a>
                                    @endif

                                    @if($singleSong->album_id != 0)
                                        <br> Thuộc album:
                                        <a href="{{route('singleAlbum', ['albumId' => $singleSong->album_id])}}">{{$singleSong->album->title}}</a>
                                    @endif
                                </p>
                                <div class="separator mb-4 mt-4">
                                    <span class="separator-md"></span>
                                </div>
                                <p class="mb-2">Ra mắt chính thức {{convertDate($singleSong->release_date)}}</p>
                            </div>
                            <div class="lyrics">
                                <hr>
                                <h5 class="font-weight-bold"><i class="fas fa-music fa-1x mb-3"></i> Lời bài hát</h5>
                                <div class="main-lyric" style="height: 200px; overflow-y: scroll;">
                                    {!! $singleSong->lyric !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <div class="col-12 mt-auto mb-2 mb-xl-auto">
                                        <form id="comment_form" action="javascript:;">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="content">Viết bình luận</label>
                                                <textarea name="content" id="content" cols="30" rows="5"
                                                          class="form-control"></textarea>
                                                <div class="print-error-msg mt-2" style="display:none">
                                                </div>
                                            </div>
                                            <div class="btn btn-primary btn-submit"
                                                 data-songid="{{$singleSong->id}}"> Bình luận
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                <div class="col-12  pt-4 customer-review">
                                    @if(count($comment) == 0 || count($comment) == null )
                                        <div class="panel panel-default widget">
                                            <div class="panel-heading">
                                                <span class="glyphicon glyphicon-comment"></span>
                                                <h4 class="panel-title font-weight-bold"><i
                                                        class="fas fa-comments mb-3"></i> Bình luận của người cùng nghe
                                                </h4>
                                                <span class="label label-info">{{count($comment)}} bình luận</span>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-group all-comment">
                                                    <p class="font-weight-bold mb-0 font-italic no-comment p-2 bg-light text-center">
                                                        Bài hát chưa có bình luận
                                                        nào! Hãy là người đầu tiên bình luận. <br>
                                                        @if(!\Illuminate\Support\Facades\Auth::check())
                                                            <a href="{{route('login')}}" class="btn btn-primary">Đăng
                                                                nhập</a>
                                                        @endif
                                                    </p>
                                                </ul>
                                            </div>
                                            <div class="mt-2 text-center"> {{ $comment->links() }}</div>
                                        </div>
                                    @else
                                        <div class="panel panel-default widget">
                                            <div class="panel-heading">
                                                <span class="glyphicon glyphicon-comment"></span>
                                                <h5 class="panel-title font-weight-bold"><i
                                                        class="fas fa-comments mb-3"></i> Bình luận của người cùng nghe
                                                </h5>
                                                <span class="label label-info">{{count($comment)}} bình luận</span>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-group all-comment">
                                                    @foreach($comment as $cm)
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-3 col-md-3 col-xl-2 ">
                                                                    <img src="{{url($cm->user->avatar)}}"
                                                                         class="rounded-circle img-fluid"
                                                                         alt="{{$cm->user->username}}"/>
                                                                </div>
                                                                <div class="col-9 col-md-9 col-xl-10 ">
                                                                    <div>
                                                                        <div class="mic-info font-weight-bold">
                                                                            Đăng bởi: {{$cm->user->username}}
                                                                            - {{time_elapsed_string($cm->created_at)}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-text">
                                                                        {{$cm->content}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="mt-2 text-center"> {{ $comment->links() }}</div>
                                        </div>
                                    @endif
                                </div>

                                <div class="pb-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="more-items pt-4">
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Nghe thêm của ca sĩ
                                    này</h3>
                            </div>
                        </div>

                        <div class="adonis-carousel auto-fit-columns" data-auto-width="yes"
                             data-item-parent=".owl-carousel" data-auto-fit-items=".item" data-dots="yes"
                             data-item-width="260" data-item-max-width="280">
                            <div class="gutter-30">
                                <div class="owl-carousel owl-theme-adonis">
                                    <div class="item hover-bg-item">
                                        <?php
                                        $count_loop = 0;
                                        $html = '</div><div class="item">';
                                        ?>
                                        @foreach($relatedSongArtist as $song)
                                            <?php $count_loop++ ?>
                                            <div class="music-img-box">
                                                <div class="img-box box-rounded-sm">
                                                    <img class="retina"
                                                         src="{{url($song->cover_image)}}"
                                                         data-2x="{{url($song->cover_image)}}"
                                                         alt="">
                                                    <div class="hover-state">
                                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span
                                                            class="pointer play-btn-dark round-btn adonis-album-button"
                                                            data-type="song"
                                                            data-album-id="{{$song->id}}">
                                                          <i class="fas fa-play fs-21 text-light play-index"></i>
                                                        </span>
                                                        </div>
                                                        <div class="absolute-top-right pr-e-15 pt-e-15">
                                                            <span class="pointer dropdown-menu-toggle"
                                                                  data-songid="{{$song->id}}">
                                                                <span class="adonis-icon icon-4x">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 class="title"><a href="{{route('singleSong', ['songId' => $song->id])
                                                }}">{{$song->name}}</a></h6>
                                                <p class="sub-title category mb-4">
                                                    @foreach($song->artists as $artist)
                                                        <a href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                            , @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                            @if($count_loop % 1==0)
                                                {!!$html!!}
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="pt-e-5 pt-e-lg-10"></div>
                    </div>

                    <div class="more-items ">
                        <div class="d-flex flex-row">
                            <div class="title-box">
                                <h3 class="title h3-md text-uppercase"><i class="fas fa-music"></i> Bài hát cùng thể
                                    loại</h3>
                            </div>
                            <div class="button-right ml-auto ml-auto mt-auto mb-4 d-flex">
                                <a href="{{route('singleGenres', ['genres_id' => $singleSong->genres_id])}}">Xem thêm
                                    <span class="adonis-icon pl-1 icon-arrow icon-1x">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="adonis-carousel auto-fit-columns" data-auto-width="yes"
                             data-item-parent=".owl-carousel" data-auto-fit-items=".item" data-dots="yes"
                             data-item-width="260" data-item-max-width="280">
                            <div class="gutter-30">
                                <div class="owl-carousel owl-theme-adonis">
                                    <div class="item hover-bg-item">
                                        <?php
                                        $count_loop = 0;
                                        $html = '</div><div class="item">';
                                        ?>
                                        @foreach($relatedSong as $song)
                                            <?php $count_loop++ ?>
                                            <div class="music-img-box">
                                                <div class="img-box box-rounded-sm">
                                                    <img class="retina"
                                                         src="{{url($song->cover_image)}}"
                                                         data-2x="{{url($song->cover_image)}}"
                                                         alt="">
                                                    <div class="hover-state">
                                                        <div class="absolute-bottom-left pl-e-20 pb-e-20">
                                                        <span
                                                            class="pointer play-btn-dark round-btn adonis-album-button"
                                                            data-type="song"
                                                            data-album-id="{{$song->id}}">
                                                            <i class="fas fa-play fs-21 text-light play-index"></i>
                                                        </span>
                                                        </div>
                                                        <div class="absolute-top-right pr-e-15 pt-e-15">
                                                            <span class="pointer dropdown-menu-toggle"
                                                                  data-songid="{{$song->id}}">
                                                                <span class="adonis-icon icon-4x">
                                                                    <span
                                                                        class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 class="title"><a href="{{route('singleSong', ['songId' => $song->id])
                                                }}">{{$song->name}}</a></h6>
                                                <p class="sub-title category mb-4">
                                                    @foreach($song->artists as $artist)
                                                        <a href="{{route('singleArtist', ['artisId' => $artist->id])}}">{{$artist->nick_name}}</a> @if ($loop->last) @else
                                                            , @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                            @if($count_loop % 2==0)
                                                {!!$html!!}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-e-5 pt-e-lg-10"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12 flex-column-sidebar-xl">
                    <div class="widget mb-3">
                        <div class="d-flex justify-content-between inactive-colored-links">
                            <h3 class="widget-title h3-md text-uppercase"><i class="fas fa-boxes"></i> Thể loại</h3>
                            <a href="{{route('all', ['type' => 'genres'])}}" class="inactive-color mt-2">Xem tất cả <i
                                    class="fas fa-arrow-right"></i> </a>
                        </div>
                        <div class="tagcloud">
                            @foreach($genres as $genre)
                                <a href="{{route('singleGenres', ['genresId' => $genre->id])}}">{{$genre->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="widget mb-3">
                        <div class="d-flex justify-content-between inactive-colored-links">
                            <h3 class="widget-title text-uppercase h3-md"><i class="fas fa-users"></i> Ca sĩ nổi bật
                            </h3>
                            <a href="{{route('all', ['type' => 'artists'])}}" class="inactive-color mt-2">Xem tất cả</a>
                        </div>
                        @foreach($artists as $artist)
                            <div class="media img-box-horizontal follower-box">
                                <div class="img-box img-box-sm">
                                    <img class="rounded-circle" src="{{$artist->avatar}}" alt="{{$artist->name}}">
                                </div>
                                <div class="des d-flex justify-content-between">
                                    <div class="clearfix">
                                        <h5 class="artist">
                                            <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">
                                                {{$artist->nick_name}}
                                            </a>
                                        </h5>
                                        <span class="adonis-icon icon-1x"><i class="fas fa-user-tag"></i> {{$artist->follow}}</span>
                                        <span class="adonis-icon ml-3 icon-1x"><i class="fas fa-music"></i> {{count($artist->songs)}}</span>
                                    </div>
                                    <div class="float-right">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <a href="javascript:;" class="btn btn-primary btn-follow text-light"
                                               data-artist-id="{{$artist->id}}">

                                                @if(!\App\Model_client\UserFollowDetail::where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->where('artist_id', '=', $artist->id)->exists())
                                                    <i class="fas fa-user-plus"></i> Quan tâm
                                                @else
                                                    <i class="fas fa-user-minus"></i> Bỏ quan tâm
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="widget">
                        <div class="d-flex justify-content-between inactive-colored-links">
                            <h3 class="text-uppercase widget-title h3-md"><i class="fas fa-heart"></i> Yêu thích nhiều
                                nhất</h3>
                        </div>
                        @foreach($mostLikeSong as $song)
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
                                            <a href="{{route('singleArtist', ['artistId' => $artist->id])}}">{{$artist->nick_name}}</a>
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
                                            <span class="pointer dropdown-menu-toggle" data-songid="{{$song->id}}">
                                            <span class="adonis-icon icon-4x">
                                                <span
                                                    class="icon-dot-nav-horizontal text-light"></span>
                                                </span>
                                            </span>
                                        @endif
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
