@extends('layouts.admin2.main')

@section('title')
    Cập nhật danh sách phát
@endsection

@section('content')

    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin danh sách phát</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Tên danh sách phát : </label>
                        <input type="text" value="{{$playlist->name}}" name="name" class="form-control">
                        @if($errors->first('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="js-example-basic-multiple form-control"
                                name="song_playlist[]" multiple="multiple">
                            @if ($song !== null)
                                @foreach ($song as $list)
                                    <option
                                        @foreach ($song_of_playlist as $list2)
                                        @if ($list->id == $list2->song_id) {{"selected"}} @endif
                                            @endforeach
                                        value="{{$list->id}}">{{$list->name}}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mô tả chi tiết : </label>
                        <textarea type="text" name="description" rows="10"
                                  class="form-control">{{$playlist->description}} </textarea>
                        @if($errors->first('description'))
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <button
                        class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                        Xác nhận
                    </button>
                    <a href="{{route('playlist.home')}}">
                        <button type="button"
                                class="btn btn-danger m-t-20 m-l-10 waves-effect waves-light js-programmatic-disable">
                            Quay lại
                        </button>
                    </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin danh sách phát</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-block">

                    <div class="form-group">
                        <label class="col-form-label">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="">Lựa chọn trạng thái</option>
                            <option @if ($playlist->status == 1) {{'selected'}} @endif value="1">Hoạt động</option>
                            <option @if ($playlist->status == 0) {{'selected'}} @endif  value="0">Không hoạt động
                            </option>
                        </select>
                        @if($errors->first('status'))
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh bìa</label>

                        <div class="custom-file">
                            <input id="fileInput" type="file" name="cover_image" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Lựa chọn ảnh</label>
                        </div>
                        @if($errors->first('cover_image'))
                            <span class="text-danger">{{$errors->first('cover_image')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <img id="imgPreview" src="{{url($playlist->cover_image)}}" width="100%" alt="">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-js')

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
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    @if (session('status'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                type: 'error',
                title: '{{ session('status') }}'
            })
        </script>
    @endif
@endsection
