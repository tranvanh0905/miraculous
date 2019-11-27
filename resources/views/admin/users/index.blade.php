@extends('layouts.admin.main')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5>Quản lý tài khoản</h5>
                                        <div class="card-header-right">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Email</th>
                                                    <th>Ảnh đại diện</th>
                                                    <th>Phân quyền</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td><img src="{{url($user->avatar)}}" width="50px" alt=""></td>
                                                        <td>
                                                            @if ($user->role == 100)
                                                                {{"Thành viên mới"}}
                                                            @endif
                                                            @if ($user->role == 400)
                                                                {{"Thành viến cao cấp"}}
                                                            @endif
                                                            @if ($user->role == 600)
                                                                {{"Cộng tác viên"}}
                                                            @endif
                                                            @if ($user->role == 900)
                                                                {{"Quản trị viên"}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($user->status == 1)
                                                                <label
                                                                    class="label label-success">Đang hoạt
                                                                    động</label>
                                                            @endif
                                                            @if ($user->status == 0)
                                                                <label class="label label-danger">Ngừng hoạt
                                                                    động</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{route('users.update')}}"><i
                                                                    class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a><a
                                                                href="#!"><i
                                                                    class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
