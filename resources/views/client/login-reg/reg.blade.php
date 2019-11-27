@extends('layouts.client.main')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="second">
                    <div class="myform form ">
                        <div class="logo mb-3 pt-5">
                            <div class="col-md-12 text-center">
                                <h1>Đăng ký</h1>
                            </div>
                        </div>
                        <form action="{{route('reg')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">Tên tài khoản</label>
                                <input type="text" name="username" class="form-control @if($errors->first('username'))is-invalid @endif"
                                       id="username"
                                       placeholder="Nhập tên tài khoản của bạn" value="{{old('username')}}">
                                @if($errors->first('username'))
                                    <p class="text-danger mt-1">{{$errors->first('username')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="full_name">Họ và tên</label>
                                <input type="text" name="full_name" class="form-control @if($errors->first('full_name'))is-invalid @endif"
                                       id="full_name"
                                       placeholder="Nhập họ và tên của bạn" value="{{old('full_name')}}">
                                @if($errors->first('full_name'))
                                    <p class="text-danger mt-1">{{$errors->first('full_name')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control @if($errors->first('email'))is-invalid @endif" id="email"
                                       placeholder="Nhập email" value="{{old('email')}}">
                                @if($errors->first('email'))
                                    <p class="text-danger mt-1">{{$errors->first('email')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" class="form-control @if($errors->first('password'))is-invalid
@endif" placeholder="Nhập mật khẩu" value="{{old('password')}}">
                                @if($errors->first('password'))
                                    <p class="text-danger mt-1">{{$errors->first('password')}}</p>
                                @endif
                            </div>

                            <div class="col-md-12 text-center mb-3 p-0">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">
                                    Đăng ký
                                </button>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <p class="text-center"><a href="{{route('login')}}" id="login">Bạn đã có tài khoản
                                            ?</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
