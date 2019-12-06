@extends('layouts.client.main')

@section('title')
    Bảng xếp hạng
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="container">
        <section>
            <div class="row">
                <div class="col-12">
                    <div class="adonis-carousel" data-items="1" data-stagePadding="0"
                         data-loop="yes" data-dots="yes">
                        <div class="owl-carousel owl-theme-adonis">
                            @foreach(getSlider() as $slider)
                                <a href="{{url($slider->url)}}" class="box-img-slider">
                                    <img src="{{url($slider->image)}}" alt="{{url($slider->url)}}" class="img-slider">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="title-box ">
                                <h4 class="title h3 text-uppercase d-inline-block"><i class="fas fa-users"></i> Bảng xếp hạng Top 50 ca sĩ </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row auto-columns adonis-animate" data-animation="slideUp"
                         data-animation-item=".music-img-box"
                         data-responsive-width="0:100%|300:50%|560:33%|820:25%|980:20%|1240:16.66%|1500:14.2858%"
                         style="opacity: 1;">
                        @foreach($top50Artist as $artist)
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
                                                                   data-artist-id="{{$artist->id}}">{{$artist->follow}}</span>
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
                </div>
                <div class="col-lg-4">
                    <div class="title-box">
                        <h4 class="title h3 text-uppercase"><i class="fas fa-boxes"></i> Thể loại hay</h4>
                    </div>
                    <div class="row">
                        @foreach($allGenres as $genres)
                            <div class="item col-12 mb-3 pr-0">
                                <div class="img-box-text-over lg box-rounded-lg">
                                    <img src="{{$genres->image}}"
                                         data-2x="{{$genres->image}}" alt="{{$genres->name}}" height="155" width="100%">
                                    <div
                                        class="absolute-info d-flex flex-column justify-content-between">
                                        <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">Thể Loại
                                        </div>
                                        <div>
                                            <h4 class="fs-7 m-0 text-light text-center"><span
                                                    class="font-weight-bold">{{$genres->name}}</span>
                                            </h4>
                                        </div>
                                        <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto">
                                            <a href="{{route('singleGenres', ['genresId' => $genres->id])}}"
                                               class="color-white">Xem thể loại<span
                                                    class="adonis-icon pl-1 icon-arrow icon-1x"><i class="fas fa-arrow-right fs-19"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </section>
    </div>
@endsection

