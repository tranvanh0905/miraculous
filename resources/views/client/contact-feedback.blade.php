@extends('layouts.client.main')

@section('title')
    Liên hệ
@endsection

@section('content')
    <div class="pt-4 pt-lg-5"></div>

    <div class="master-container-fluid">
        <div class="title-box">
            <h4 class="title h3 text-uppercase">Liên hệ</h4>
        </div>

        <div class="box-contact-feedback">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <h5>Liên hệ với chúng tôi</h5>
                        <p> Chúng tôi luôn ghi nhận các đóng góp ý kiến của bạn để cải tiến và nâng cấp sản phẩm
                            Micralous ngày một hoàn thiện và hữu ích hơn. Đừng ngại chia sẻ ý tưởng cho chúng tôi</p>
                        <form action="">
                            <div class="form-group">
                                <label for="fullname">
                                    Họ tên
                                </label>
                                <input type="text" name="fullname" id="fullname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">
                                    Số điện thoại
                                </label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type_respon">
                                    Liên quan đến
                                </label>
                                <select name="type_respon" id="type_respon" class="form-control">
                                    <option value="" selected>Chọn vấn đề cần liên hệ</option>
                                    <option value="">Báo lỗi</option>
                                    <option value="">Góp ý sản phẩm</option>
                                    <option value="">Gia hạn, mua VIP</option>
                                    <option value="">Phát hành nội dung</option>
                                    <option value="">Hợp tác nội dung</option>
                                    <option value="">Vấn đề khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">
                                    Nội dung
                                </label>
                                <textarea name="content" id="content" rows="5" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
