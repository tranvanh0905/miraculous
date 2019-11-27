@extends('layouts.admin2.main')

@section('title')
    Cập nhật ca sĩ
@endsection

@section('content')

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin ca sĩ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Nghệ danh : </label>
                        <input value="{{$model->nick_name}}" name="nick_name" type="text"
                               class="form-control">
                        @if($errors->first('nick_name'))
                            <span class="text-danger">{{$errors->first('nick_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Họ và tên đầy đủ : </label>
                        <input value="{{$model->full_name}}" name="full_name" type="text"
                               class="form-control">
                        @if($errors->first('full_name'))
                            <span class="text-danger">{{$errors->first('full_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label">Ngày sinh : </label>
                        <input type="date" value="{{$model->birthday}}" name="birthday"
                               class="form-control">
                        @if($errors->first('birthday'))
                            <span class="text-danger">{{$errors->first('birthday')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label">Giới thiệu : </label>
                        <textarea row="10" cols="5" name="about" class="form-control"
                                  placeholder="">{{$model->about}}</textarea>
                        @if($errors->first('about'))
                            <span class="text-danger">{{$errors->first('about')}}</span>
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

    <div class="col-md-4">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin ca sĩ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-block">
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh đại diện</label>

                        <div class="custom-file">
                            <input id="mp3Input" type="file" name="avatar" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Lựa chọn ảnh</label>
                        </div>
                        @if($errors->first('avatar'))
                            <span class="text-danger">{{$errors->first('avatar')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <img src="{{url($model->avatar)}}" style="width:100%" alt="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh bìa</label>

                        <div class="custom-file">
                            <input id="mp3Input" type="file" name="cover_image" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Lựa chọn ảnh</label>
                        </div>
                        @if($errors->first('cover_image'))
                            <span class="text-danger">{{$errors->first('cover_image')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <img src="{{url($model->cover_image)}}" style="width:100%;" alt="">
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label">Trạng thái : </label>
                        <select name="status" class="form-control">
                            <option value="">Lựa chọn trạng thái</option>
                            <option @if ($model->status == 1) {{'selected'}} @endif  value="1">Hoạt
                                động
                            </option>
                            <option @if ($model->status == 0) {{'selected'}} @endif value="0">Không
                                hoạt động
                            </option>
                        </select>
                        @if($errors->first('status'))
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileInput1").change(function () {
            readURL(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileInput2").change(function () {
            readURL2(this);
        });
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
