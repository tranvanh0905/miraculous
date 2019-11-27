@extends('layouts.admin2.main')

@section('title')
    Thêm thể loại
@endsection

@section('content')

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin bài hát</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post"
                      enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Tên thể loại : </label>
                        <input type="text" name="name" class="form-control">
                        @if($errors->first('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mô tả : </label>
                        <textarea rows="10" cols="5" name="description" class="form-control"
                                  placeholder="Viết mô tả tại đây ..."></textarea>
                        @if($errors->first('description'))
                            <span
                                class="text-danger">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <button type="submit"
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
                <h3 class="card-title">Thông tin bài hát</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-block">

                    <div class="form-group">
                        <label class="col-form-label">Trạng thái : </label>
                        <select name="status" class="form-control">
                            <option value="">Lựa chọn trạng thái</option>
                            <option value="0">Không hoạt động</option>
                            <option value="1" selected>Hoạt động</option>
                        </select>
                        @if($errors->first('status'))
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh bìa</label>

                        <div class="custom-file">
                            <input id="fileInput" type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Lựa chọn ảnh</label>
                        </div>
                        @if($errors->first('image'))
                            <span class="text-danger">{{$errors->first('image')}}</span>
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

@endsection
@section('custom-js')

    <script>

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
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
