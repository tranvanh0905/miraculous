@extends('layouts.admin.main')

@section('title')
    Thêm bài hát
@endsection

@section('content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Thêm bài hát mới</h5>
                                    </div>
                                    <div class="card-block">
                                        <form method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label class="col-form-label">Email: </label>
                                                <input name="email" value="{{old('email')}}" type="text"
                                                       class="form-control">
                                                @if($errors->first('email'))
                                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                                @endif
                                                <div class="form-group">
                                                    <label class="col-form-label">Mật khẩu : </label>
                                                    <input name="password" type="text" value="{{old('password')}}" class="form-control">
                                                    @if($errors->first('password'))
                                                        <span class="text-danger">{{$errors->first('password')}}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Tên đầy đủ : </label>
                                                    <input  name="full_name" type="text" value="{{old('full_name')}}" class="form-control">
                                                    @if($errors->first('full_name'))
                                                        <span class="text-danger">{{$errors->first('full_name')}}</span>
                                                    @endif
                                                </div>
                                                <button
                                                    class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                                                    Xác nhận
                                                </button>
                                                <button
                                                    class="btn btn-danger m-t-20 m-l-10 waves-effect waves-light js-programmatic-disable">
                                                    Quay lại
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Thêm bài hát mới</h5>
                                    </div>
                                    <div class="card-block">
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-form-label">Thư mục âm thanh : </label>
                                            <input id="mp3Input" type="file" name="mp3_url" class="form-control">
                                            @if($errors->first('mp3_url'))
                                                <span class="text-danger">{{$errors->first('mp3_url')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <audio id="previewMp3" class="form-control" controls></audio>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Trạng thái : </label>
                                            <select name="status" class="form-control">
                                                <option value="">Lựa chọn trạng thái</option>
                                                <option value="0">Ngừng hoạt động</option>
                                                <option value="1" selected >Đang hoạt động</option>
                                            </select>
                                            @if($errors->first('status'))
                                                <span class="text-danger">{{$errors->first('status')}}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label">Ảnh đại diện : </label>
                                            <input type="file" name="cover_image" id="fileInput" class="form-control">
                                            @if($errors->first('cover_image'))
                                                <span class="text-danger">{{$errors->first('cover_image')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <img id="imgPreview" width="100%" alt="">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileInput").change(function () {
            readURL(this);
        });
        $("#mp3Input").on('change', function (e) {
            var sound = document.getElementById('previewMp3');
            sound.src = URL.createObjectURL(this.files[0]);
            // not really needed in this exact case, but since it is really important in other cases,
            // don't forget to revoke the blobURI when you don't need it
            sound.onend = function (e) {
                URL.revokeObjectURL(this.src);
            }
        })
    </script>
@endsection
