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
                                <p class="mb-2">Ra mắt chính thức {{$singleSong->release_date}}</p>
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
                                                 data-songid="{{$singleSong->id}}">Bình
                                                luận
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
                                                        nào! Hãy là người đầu tiên bình luận. <br><a
                                                            href="{{route('login')}}" class="btn btn-primary">Đăng
                                                            nhập</a></p>
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
                                                                <div class="col-xs-2 col-md-2">
                                                                    <img src="{{url($cm->user->avatar)}}"
                                                                         class="rounded-circle img-responsive"
                                                                         alt="{{$cm->user->username}}"/>
                                                                </div>
                                                                <div class="col-xs-10 col-md-10">
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
                                        <span class="adonis-icon icon-1x"><svg class="mr-2" version="1.1"
                                                                               xmlns="http://www.w3.org/2000/svg"
                                                                               height="15"
                                                                               viewBox="0 0 32 32"><path
                                                    d="M14.496 22c4.136 0 7.504-4.096 7.504-9.128s-3.368-9.12-7.504-9.12c-2.195 0.041-4.134 1.105-5.363 2.735l-0.013 0.017c-1.323 1.704-2.121 3.874-2.121 6.23 0 0.060 0 0.12 0.002 0.179l-0-0.009c0 5 3.4 9.096 7.496 9.096zM14.496 5.752c3.040 0 5.504 3.2 5.504 7.12s-2.464 7.128-5.504 7.128-5.496-3.2-5.496-7.128 2.464-7.12 5.496-7.12zM20.8 21c-0.552 0-1 0.448-1 1s0.448 1 1 1v0c3.422 0.005 6.195 2.778 6.2 6.2v0c0 0.442-0.358 0.8-0.8 0.8v0h-23.4c-0.442 0-0.8-0.358-0.8-0.8v0c0.005-3.422 2.778-6.195 6.2-6.2h0c0.552 0 1-0.448 1-1s-0.448-1-1-1v0c-4.527 0.005-8.195 3.673-8.2 8.2v0c0 1.546 1.254 2.8 2.8 2.8v0h23.4c1.546 0 2.8-1.254 2.8-2.8v0c-0.005-4.527-3.673-8.195-8.2-8.2h-0zM15.2 2.64c0.647-0.4 1.432-0.637 2.271-0.64h0.001c3.032 0 5.496 3.2 5.496 7.128 0.001 0.047 0.001 0.102 0.001 0.158 0 0.678-0.073 1.339-0.213 1.975l0.011-0.061c-0.017 0.068-0.026 0.146-0.026 0.227 0 0.471 0.325 0.865 0.763 0.972l0.007 0.001c0.035 0.004 0.075 0.006 0.116 0.006s0.081-0.002 0.121-0.006l-0.005 0c0.477-0.006 0.873-0.344 0.967-0.793l0.001-0.007c0.183-0.749 0.288-1.61 0.288-2.494 0-0.006 0-0.012-0-0.019v0.001c0-4.992-3.4-9.088-7.496-9.088-1.215 0.004-2.35 0.345-3.316 0.936l0.028-0.016c-0.37 0.152-0.626 0.51-0.626 0.927 0 0.552 0.448 1 1 1 0.23 0 0.443-0.078 0.612-0.209l-0.002 0.002zM24 17.040c-0.552 0-1 0.448-1 1s0.448 1 1 1v0c3.326 0.053 6.002 2.761 6.002 6.095 0 0.059-0.001 0.118-0.003 0.177l0-0.009c-0.001 0.119-0.027 0.232-0.074 0.333l0.002-0.005c-0.052 0.118-0.083 0.256-0.083 0.401 0 0.407 0.241 0.758 0.589 0.917l0.006 0.003c0.114 0.056 0.249 0.088 0.391 0.088 0.006 0 0.012-0 0.018-0h-0.001c0.414-0.011 0.764-0.27 0.91-0.633l0.002-0.007c0.152-0.333 0.24-0.723 0.24-1.133 0-0.004 0-0.008-0-0.012v0.001c0.001-0.048 0.002-0.104 0.002-0.161 0-4.438-3.571-8.042-7.997-8.095l-0.005-0z"></path></svg>
                                            {{$artist->follow}}</span>
                                        <span class="adonis-icon ml-3 icon-1x"><svg class="mr-2" version="1.1"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    height="15" viewBox="0 0 32 32"><path
                                                    d="M31.286 0.469c-0.363-0.305-0.818-0.469-1.285-0.469-0.115 0-0.232 0.010-0.348 0.031l-17.002 3c-0.956 0.168-1.652 0.998-1.652 1.969v17.17c-1.015-0.736-2.332-1.17-3.794-1.17-0.85 0-1.7 0.141-2.529 0.416-1.898 0.633-3.42 1.902-4.176 3.484-0.584 1.223-0.659 2.553-0.214 3.746 0.761 2.038 2.923 3.354 5.508 3.354 0.85 0 1.7-0.139 2.528-0.416 1.897-0.631 3.419-1.9 4.175-3.48 0.325-0.682 0.477-1.396 0.483-2.104h0.018v-16c0.115 0 0.232-0.010 0.348-0.029l16.655-2.939v12.138c-1.016-0.736-2.332-1.17-3.795-1.17-0.85 0-1.701 0.141-2.529 0.416-1.898 0.633-3.42 1.902-4.174 3.484-0.584 1.223-0.66 2.553-0.215 3.746 0.762 2.038 2.922 3.354 5.508 3.354 0.85 0 1.701-0.139 2.529-0.416 1.896-0.631 3.418-1.9 4.174-3.48 0.326-0.682 0.477-1.396 0.484-2.104h0.018v-21c0-0.59-0.262-1.152-0.715-1.531zM7.688 29.688c-2.396 0.799-4.873 0.018-5.529-1.74-0.658-1.76 0.751-3.834 3.146-4.633 2.396-0.799 4.873-0.020 5.529 1.74 0.659 1.759-0.75 3.834-3.146 4.633zM26.653 26.688c-2.398 0.799-4.875 0.018-5.531-1.74-0.658-1.76 0.752-3.834 3.146-4.633 2.398-0.799 4.875-0.020 5.531 1.74 0.659 1.759-0.749 3.834-3.146 4.633zM29.96 5l-17.002 3v-3l17.002-3v3z"></path></svg>
                                            {{count($artist->songs)}}</span>
                                    </div>
                                    <div class="float-right">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <a href="javascript:;" class="btn btn-primary btn-follow text-light"
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
                                            <a href="{{route('singleArtist', ['artistId' => $artist->id])
                                                            }}">{{$artist->nick_name}}</a>
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
