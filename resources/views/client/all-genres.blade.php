@extends('layouts.client.main')

@section('title')
    Tất cả thể loại
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="container">
        <section>
            <div class="title-box">
                <h4 class="title h3 text-uppercase">Tất cả thể loại</h4>
            </div>
            <div class="genres-list row">
                @foreach($allGenres as $genres)
                    <div class="item col-lg-2 mb-3">
                        <div class="img-box-text-over lg box-rounded-lg">
                            <img src="{{$genres->image}}"
                                 data-2x="{{$genres->image}}" alt="{{$genres->name}}" height="155" class="img-genres">
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
            <div class="row">
                <div class="col-12 pt-3">
                    {{ $allGenres->links() }}
                </div>
            </div>
        </section>

    </div>
@endsection
