@extends('layouts.client.main')

@section('title')
    Đã gửi yêu cầu thành công
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
                                    <h1 class="font-weight-bold">Gửi yêu cầu đặt lại mật khẩu thành công !!</h1>
                                    <p class="lead">Hãy kiểm tra email của bạn, tìm email đặt lại mật khẩu của chúng tôi và làm theo hướng dẫn !</p>
                                    <hr class="my-4">
                                    <p>Sau khi đặt lại mật khẩu bạn có thể đăng nhập vào tài khoản của mình bình thường.</p>
                                    <a class="btn btn-primary" href="{{route('client.home')}}">Về trang chủ</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
