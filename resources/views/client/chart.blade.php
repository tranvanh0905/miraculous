@extends('layouts.client.main')

@section('title')
    Bảng xếp hạng
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="container">
        <section>
            <div class="adonis-carousel js-effect adonis-animate" data-animation="slideUp"
                 data-animation-item=".item"
                 data-dots="yes" data-auto-width="yes" data-responsive-width="0:100%|600:50%|900:33.33%">
                <div class="gutter-30">
                    <div class="owl-carousel owl-theme-adonis">
                        <div class="item">
                            <div class="img-box-text-over lg box-rounded-lg">
                                <img src="{{url('client/images/radios/genres-3.jpg')}}"
                                     data-2x="{{url('client/images/radios/genres-3.jpg')}}"
                                     alt="">
                                <div class="absolute-info d-flex flex-column justify-content-between">
                                    <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">BẢNG XẾP HẠNG BÀI HÁT
                                    </div>
                                    <div>
                                        <h4 class="fs-7 m-0 text-light text-center"><span
                                                class="font-weight-bold">TOP 50</span><br>
                                            <em><span class="font-weight-light">Bài hát nghe nhiều nhất</span> </em>
                                        </h4>
                                    </div>
                                    <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto"><a href="{{route('client.chart-song')}}"
                                                                                      class="color-white">Xem bảng xếp hạng<span
                                                class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"></use></svg></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img-box-text-over lg box-rounded-lg">
                                <img src="{{url('client/images/radios/genres-2.jpg')}}"
                                     data-2x="{{url('client/images/radios/genres-2@2x.jpg')}}"
                                     alt="">
                                <div class="absolute-info d-flex flex-column justify-content-between">
                                    <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">BẢNG XẾP HẠNG ALBUM
                                    </div>
                                    <div>
                                        <h4 class="fs-7 m-0 text-center text-light"><span
                                                class="text-light font-weight-bold">Top 50</span><br>
                                            <em><span class="font-weight-light">Album nghe nhiều nhất</span>
                                            </em></h4>
                                    </div>
                                    <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto"><a href="{{route('client.chart-album')}}"
                                                                                      class="color-white">Xem bảng xếp hạng<span
                                                class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"></use></svg></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img-box-text-over lg box-rounded-lg">
                                <img src="{{url('client/images/radios/genres-4.jpg')}}"
                                     data-2x="{{url('client/images/radios/genres-4.jpg')}}"
                                     alt="">

                                <div class="absolute-info d-flex flex-column justify-content-between">
                                    <div class="pt-3 pt-lg-4 pl-3 pl-lg-4 h5 text-light">TOP CA SĨ</div>
                                    <div>
                                        <h4 class="fs-7 m-0 text-dark text-center"><span
                                                class="text-light font-weight-bold">Ca Sĩ</span><br>
                                            <em><span
                                                    class="font-weight-light text-light">Top Ca Sĩ Quan Tâm Nhiều Nhất</span>
                                            </em></h4>
                                    </div>
                                    <div class="pb-3 pb-lg-4 pr-3 pr-lg-4 ml-auto"><a href="{{route('topArtists')}}"
                                                                                      class="color-white">Xem tất
                                            cả<span
                                                class="adonis-icon pl-1 icon-arrow icon-1x"><svg
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"><use
                                                        xlink:href="#icon-see-all-arrow-right"></use></svg></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-e-20 pt-e-lg-40"></div>
        </section>
    </div>
@endsection

