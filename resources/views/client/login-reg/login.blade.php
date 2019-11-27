@extends('layouts.client.main')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form ">
                        <div class="logo pt-5 mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Đăng nhập</h1>
                            </div>
                        </div>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email"
                                       class="form-control  @if($errors->first('email'))is-invalid @endif" id="email"
                                       placeholder="Nhập email" value="{{old('email')}}">
                                @if($errors->first('email'))
                                    <p class="text-danger mt-1">{{$errors->first('email')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password"
                                       class="form-control @if($errors->first('password'))is-invalid @endif"
                                       placeholder="Nhập mật khẩu">
                                @if($errors->first('password'))
                                    <p class="text-danger mt-1">{{$errors->first('password')}}</p>
                                @endif
                            </div>
                            <div class="col-md-12 p-0 text-center">
                                <button type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
                            </div>
                            <div class="form-group pt-3">
                                <p class="text-center">Bạn chưa có tài khoản ? <a href="{{route('reg')}}" id="signup">Đăng
                                        ký ở đây</a>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
