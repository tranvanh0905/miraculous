@extends('layouts.client.main')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="second">
                    <div class="myform form ">
                        <div class="logo mb-3 pt-5">
                            <div class="col-md-12 text-center">
                                <h1>Quên mật khẩu</h1>
                                <p>Hãy nhập email cần lấy lại mật khẩu <br> Chúng tôi sẽ gửi mail xác kèm đường dẫn lấy lại mật khẩu cho bạn.</p>

                                <form action="{{route('forgotPassword')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email"
                                               class="form-control  @if($errors->first('email'))is-invalid @endif" id="email"
                                               placeholder="Nhập email" value="{{old('email')}}">
                                        @if($errors->first('email'))
                                            <p class="text-danger mt-1">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>

                                    <div class="col-md-12 p-0 text-center">
                                        <button type="submit" class="btn btn-block btn-primary">Gửi mail xác nhận</button>
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
