@extends('layouts.client.main')

@section('title')
    Thay đổi mật khẩu
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="second">
                    <div class="myform form ">
                        <div class="logo mb-3 pt-5">
                            <div class="col-md-12 ">
                                <h1 class="text-center">Tạo mật khẩu mới cho tài khoản của bạn</h1>
                                <p class="text-center">Hãy đặt lại mật khẩu mới cho tài khoản của mình.</p>

                                <form action="{{route('saveChangePassword')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="email" value="{{$_GET['email'] ?? ''}}">
                                        <label for="password">Mật khẩu mới</label>
                                        <input type="password" name="password"
                                               class="form-control  @if($errors->first('password'))is-invalid @endif"
                                               id="password"
                                               placeholder="Nhập mật khẩu mới" value="{{old('password')}}">
                                        @if($errors->first('password'))
                                            <p class="text-danger mt-1">{{$errors->first('password')}}</p>
                                        @endif
                                        <label for="cf_password">Nhập lại mật khẩu mới</label>
                                        <input type="password" name="cf_password"
                                               class="form-control  @if($errors->first('cf_password'))is-invalid @endif"
                                               id="cf_password"
                                               placeholder="Nhập lại mật khẩu mới" value="{{old('cf_password')}}">
                                        @if($errors->first('cf_password'))
                                            <p class="text-danger mt-1">{{$errors->first('cf_password')}}</p>
                                        @endif
                                    </div>

                                    <div class="col-md-12 p-0 text-center">
                                        <button type="submit" class="btn btn-block btn-primary">Thay đổi mật khẩu
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
