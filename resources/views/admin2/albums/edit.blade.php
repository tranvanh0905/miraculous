@extends('layouts.admin2.main')

@section('title')
    Cập nhật album
@endsection

@section('content')
    <div class="col-md-8">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin album</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Tên album : </label>
                        <input type="text" value="{{$album->title}}" name="title"
                               class="form-control">
                        @if($errors->first('title'))
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label">Người thể hiện : </label>
                        <select name="artist_id" id="person_song_list"
                                class="form-control">
                            @foreach ($artists as $artist)
                                <option
                                    @if ($album->artist_id == $artist->id) {{'selected'}} @endif  value="{{$artist->id}}">{{$artist->nick_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('artist_id'))
                            <span class="text-danger">{{$errors->first('artist_id')}}</span>
                        @endif

                    </div>
                    <div id="ajax_artist">

                        <div class="form-group">
                            <label class="col-form-label">Bài hát : </label>
                            <select class="js-example-basic-multiple form-control"
                                    name="person_song[]" multiple="multiple">
                                @if ($song !== null)
                                    @foreach ($song as $list)
                                        <option @if($album->id == $list->album_id) {{"selected"}}  @endif
                                                value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->first('person_song'))
                                <span
                                    class="text-danger">{{$errors->first('person_song')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Ngày phát hành : </label>
                        <input value="{{$album->release_date}}" name="release_date" type="date"
                               class="form-control">
                        @if($errors->first('release_date'))
                            <span
                                class="text-danger">{{$errors->first('release_date')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mô tả: </label>
                        <textarea name="description" rows="10" cols="5" class="form-control"
                                  placeholder="Viết lời mô tả tại đây ...">{{$album->description}}</textarea>
                        @if($errors->first('description'))
                            <span
                                class="text-danger">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <button
                        class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                        Xác nhận
                    </button>
                    <a href="{{route('albums.home')}}">
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
                <h3 class="card-title">Thông tin album</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-block">
                    <div class="form-group">
                        <label class=" col-form-label">Trạng thái : </label>
                        <select name="status" class="form-control">
                            <option value="">Lựa chọn trạng thái</option>
                            <option @if ($album->status == 1) {{"selected"}} @endif value="1">Hoạt động</option>
                            <option  @if ($album->status == 0) {{"selected"}} @endif  value="0">Không hoạt động</option>
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
                        <img id="imgPreview" width="100%" src="{{url($album->cover_image)}}" alt="">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    $url = url('admin');
    ?>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {

            $("select#person_song_list").on("change", function () {
                var selected = $(this).children("option:selected").val();
                $.ajax({
                    type: "GET",
                    url: '{{$url}}' + "/ajax/artist_song/" + selected + "/" + '{{$album->id}}',
                    cache: false,
                    success: function (e) {
                        $("#ajax_artist").html(e);
                    },
                    error: function () {
                        $("#ajax_artist").html(' <label class="col-form-label">Bài hát : </label>\n' +
                            '<select readonly="true" ' + 'class="js-example-basic-multiple form-control"></select>');
                    }
                })
                ;
            })
        })

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
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection

