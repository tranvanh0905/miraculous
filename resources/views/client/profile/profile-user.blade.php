@extends('layouts.client.main')

@section('title')
    Profile
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>
    <div class="master-container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="title-box">
                    <h4 class="title h3 text-uppercase">Thông tin cá nhân</h4>
                </div>
            </div>
            <div class="col-sm-3"><!--left col-->
                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
                         alt="avatar">
                    <form action="">
                        <div class="form-group">
                            <input type="file" class="form-control mt-3">
                        </div>
                    </form>
                </div>
            </div><!--/col-3-->

            <div class="col-sm-9">
                <form class="form">
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="first_name"><h4>Họ</h4></label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                   placeholder="Jont">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="last_name"><h4>Tên</h4></label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                   placeholder="Henrry">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="phone"><h4>Số điện thoại</h4></label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="0123456789">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="jonthenrry@email.com" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-primary btn-lg" type="submit">Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--/col-9-->
    </div>
@endsection
