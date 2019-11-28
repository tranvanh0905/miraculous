@extends('layouts.client.main')

@section('title')
    Khám phá
@endsection

@section('content')
    <div class="container">
        <div class="pt-4 pt-lg-5"></div>
       <div class="row">
           <div class="col-xl-8">
               <section>
                   <div class="d-flex flex-row">
                       <div class="title-box">
                           <h3 class="title h3-md text-uppercase">Những Bài hát được yêu thích nhiều</h3>
                       </div>
                   </div>
                   <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                        data-auto-width="no" data-loop="no" data-dots="yes"
                        data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
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
                                           <div class="hover-state d-flex justify-content-between align-items-center">
                                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                          data-type="song"
                                                          data-album-id="{{$song->id}}"><i
                                                                class="play-icon"></i>
                                                    </span>
                                               <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
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
               </section>

               <section>
                   <div class="d-flex flex-row">
                       <div class="title-box">
                           <h3 class="title h3-md text-uppercase">Dựa trên ca sĩ bạn đã thích</h3>
                       </div>
                   </div>
                   <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                        data-auto-width="no" data-loop="no" data-dots="yes"
                        data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
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
                                           <div class="hover-state d-flex justify-content-between align-items-center">
                                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                          data-type="song"
                                                          data-album-id="{{$song->id}}"><i
                                                                class="play-icon"></i>
                                                    </span>
                                               <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
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
               </section>

               <section>
                   <div class="d-flex flex-row">
                       <div class="title-box">
                           <h3 class="title h3-md text-uppercase">Nhạc Việt Hay</h3>
                       </div>
                   </div>
                   <div class="adonis-carousel adonis-animate" data-animation="slideUp" data-animation-item=".item"
                        data-auto-width="no" data-loop="no" data-dots="yes"
                        data-items-responsive="0:1|600:2|900:2|1200:2|1500:3">
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
                                           <div class="hover-state d-flex justify-content-between align-items-center">
                                                    <span class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                          data-type="song"
                                                          data-album-id="{{$song->id}}"><i
                                                                class="play-icon"></i>
                                                    </span>
                                               <div class="d-flex align-items-center">
                                                        <span class="adonis-icon text-light pointer mr-2 icon-2x">
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                @if(!\App\Model_client\UserLikedSong::where('user_id', '=',\Illuminate\Support\Facades\Auth::user()->id)->where('song_id', '=', $song->id)->exists())
                                                                    <span class="adonis-icon icon-2x box-like-global">
                                                                    <i class="far fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                       data-id="{{$song->id}}"
                                                                    ></i>
                                                                  </span>
                                                                @else
                                                                    <span class="adonis-icon icon-2x box-dis-like-global">
                                                                <i class="fas fa-heart fa-2x font-14" id="likeGlobal" data-type="song"
                                                                   data-id="{{$song->id}}"></i>
                                                                </span>
                                                                @endif
                                                                <span class="pointer dropdown-menu-toggle"
                                                                      data-songid="{{$song->id}}" data-link="123">
                                                                    <span class="icon-dot-nav-horizontal text-light"></span>
                                                                </span>
                                                            @endif
                                                        </span>
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
               </section>
           </div>
           <div class="col-xl-4">
               <section>
                   <div class="d-flex flex-row">
                       <div class="title-box">
                           <h3 class="title h3-md text-uppercase">Thể loại nhạc</h3>
                       </div>
                   </div>
                   <div class="list-genres">
                       @foreach($genres as $genre)
                           <div class="item col-12 mb-3">
                               <div class="img-box-text-over lg box-rounded-lg">
                                   <img src="{{url($genre->image)}}" data-2x="{{url($genre->image)}}" alt="{{$genre->name}}" class="img-genres">
                                   <div class="absolute-info d-flex flex-column justify-content-between">
                                       <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">Thể Loại
                                       </div>
                                       <div>
                                           <h4 class="fs-7 m-0 text-light text-center">
                                               <span class="font-weight-bold">{{$genre->name}}</span>
                                           </h4>
                                       </div>
                                       <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                           <a href="{{route('singleGenres', ['genresId' => $genre->id])}}" class="color-white">Xem thể loại<span
                                                       class="adonis-icon pl-1 icon-arrow icon-1x"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                               xlink:href="#icon-see-all-arrow-right"></use></svg></span>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               </section>
           </div>
       </div>
    </div>
@endsection
