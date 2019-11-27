@extends('layouts.admin.main')

@section('title')
    Bảng điều khiển
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <div class="card prod-p-card card-blue">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-30">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Tổng số bài hát hiện có</h6>
                                                <h3 class="m-b-0 f-w-700 text-white">{{\App\Song::count()}}</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-music text-c-blue f-18"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <div class="card prod-p-card card-red">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-30">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Tống số thành viên hiện có</h6>
                                                <h3 class="m-b-0 f-w-700 text-white">{{\App\User::count()}}</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users text-c-red f-18"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <div class="card prod-p-card card-yellow">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-30">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Tổng số ca sĩ hiện có</h6>
                                                <h3 class="m-b-0 f-w-700 text-white">{{\App\Artist::count()}}</h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Những bài hát mới nhất</h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i
                                                        class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-trash close-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block p-b-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                <tr>
                                                    <th>Tên bài hát</th>
                                                    <th>Người thể hiện</th>
                                                    <th>Số lượt xem</th>
                                                    <th>Số lượt yêu thích</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($songs as $song)
                                                    <tr>
                                                        <td>{{$song->name}}</td>
                                                        <td></td>
                                                        <td>{{$song->view}}</td>
                                                        <td>{{$song->like}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
