@extends('layouts.admin2.main')

@section('title')
    Cài đặt website
@endsection

@section('content')

    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Thông tin website</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Số điện thoại : </label>
                        <input name="phone_website" value="{{$webSettings[0]->phone_website}}" type="text"
                               class="form-control">
                        @if($errors->first('phone_website'))
                            <span class="text-danger">{{$errors->first('phone_website')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email : </label>
                        <input name="email_website" value="{{$webSettings[0]->email_website}}" type="text"
                               class="form-control">
                        @if($errors->first('email_website'))
                            <span class="text-danger">{{$errors->first('email_website')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Tên website : </label>
                        <input name="name_website" value="{{$webSettings[0]->name_website}}" type="text"
                               class="form-control">
                        @if($errors->first('name_website'))
                            <span class="text-danger">{{$errors->first('name_website')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Facebook link : </label>
                        <input name="url_facebook" value="{{$webSettings[0]->url_facebook}}" type="text"
                               class="form-control">
                        @if($errors->first('url_facebook'))
                            <span class="text-danger">{{$errors->first('url_facebook')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Instagram link : </label>
                        <input name="url_instagram" value="{{$webSettings[0]->url_instagram}}" type="text"
                               class="form-control">
                        @if($errors->first('url_instagram'))
                            <span class="text-danger">{{$errors->first('url_instagram')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Google link : </label>
                        <input name="url_google" value="{{$webSettings[0]->url_google}}" type="text"
                               class="form-control">
                        @if($errors->first('url_google'))
                            <span class="text-danger">{{$errors->first('url_google')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Skype link : </label>
                        <input name="url_skype" value="{{$webSettings[0]->url_skype}}" type="text"
                               class="form-control">
                        @if($errors->first('url_skype'))
                            <span class="text-danger">{{$errors->first('url_skype')}}</span>
                        @endif
                    </div>

                        <!-- /.card-header -->
                    <div class="form-group">
                        <label class="col-form-label">Giới thiệu website : </label>
                        <textarea class="textarea" name="about_website" rows="10" placeholder="Place some text here"
                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$webSettings[0]->about_website}}</textarea>
                        @if($errors->first('about_website'))
                            <span class="text-danger">{{$errors->first('about_website')}}</span>
                        @endif
                        </div>

                    <button
                        class="btn btn-success m-t-20 waves-effect waves-light js-programmatic-enable ">
                        Xác nhận
                    </button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </form>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $(function () {
                // Summernote
                $('.textarea').summernote()
            })
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
        });

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
