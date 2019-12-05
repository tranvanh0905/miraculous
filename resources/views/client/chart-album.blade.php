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
                               <h4 class="title h3 text-uppercase d-inline-block"><i class="fas fa-compact-disc"></i> Bảng xếp hạng Top 50 album</h4>
                           </div>
                       </div>
                   </div>
                    <?php
                    $count = 1;
                    ?>
                    @foreach($top50album as $album)
                        <div class="item d-flex">
                            <h2 class="number-rank"><?php echo $count; $count++;?></h2>
                            <div class="img-box-horizontal music-img-box h-g-bg h-d-shadow">
                                <div class="img-box img-box-sm box-rounded-sm">
                                    <img src="{{$album->cover_image}}" alt="{{$album->title}}">
                                </div>
                                <div class="des">
                                    <h6 class="title fs-2"><a
                                            href="{{route('singleAlbum', ['albumId' => $album->id])}}">{{$album->title}}</a>
                                    </h6>
                                    <p class="sub-title">
                                            <a href="{{route('singleArtist', ['artistId' => $album->artist->id])
                                                            }}">{{$album->artist->nick_name}}</a>
                                    </p>
                                </div>
                                <span style="line-height: 50px;">{{$album->like}} <i class="fas fa-grin-hearts fs-19"></i></span>
                                <div
                                    class="hover-state d-flex justify-content-between align-items-center">
                                                    <span
                                                        class="pointer play-btn-dark box-rounded-sm adonis-album-button"
                                                        data-type="album"
                                                        data-album-id="{{$album->id}}">
                                                         <i class="fas fa-play fs-19 text-light"></i>
                                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

