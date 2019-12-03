@extends('layouts.client.main')

@section('title')
    Thay đổi mật khẩu thành công
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="second">
                    <div class="myform form ">
                        <div class="logo mb-3 pt-5">
                            <div class="col-md-12 text-center">
                                <div class="jumbotron">
                                    <h1>Chúc mừng bạn đã đặt lại mật khẩu thành công</h1>
                                    <p class="lead">Hãy luôn ghi nhớ mật khẩu mình đã tạo, bây giờ bạn đã có thể tiếp tục  <br> đăng nhập vào tài khoản của mình để nghe nhạc trên Miraculous !</p>
                                    <hr class="my-4">
                                    <a href="{{route('login')}}" class="btn btn-primary">Đăng nhập</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
