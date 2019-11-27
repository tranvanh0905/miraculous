<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admindek | Admin Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description"
          content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs."/>
    <meta name="keywords"
          content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"/>
    <meta name="author" content="colorlib"/>
    @include('layouts.admin.style')
    @include('layouts.admin.script')
    <link rel="stylesheet" href="{{url('css/pager.css')}}">
</head>
<body themebg-pattern="theme1">
<section class="login-block">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <form class="md-float-material form-material" method="post">
                @csrf
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Đăng nhập</h3>
                                </div>
                            </div>
                            <p class="text-muted text-center p-b-5">Đăng nhập với tài khoản quản trị</p>
                            <div class="form-group form-primary">
                                <input type="text" name="email" class="form-control" >
                                <span class="form-bar"></span>
                                <label class="float-label">Email</label>
                                @if($errors->first('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Mật khẩu</label>
                                @if($errors->first('password'))
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            @if (session('status'))
                                <ul>
                                    <li class="text-danger"> {{ session('status') }}</li>
                                </ul>
                            @endif
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                        Đăng nhập
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

    </div>

</section>

</html>
