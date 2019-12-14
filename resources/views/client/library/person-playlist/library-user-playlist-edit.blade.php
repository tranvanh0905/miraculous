@extends('layouts.client.main-account-library')

@section('title')
    Thư viện - Chỉnh sửa danh sách phát cá nhân
@endsection

@section('content')
    <section>
        <div class="pt-3"></div>
        <div class="d-flex">
            <div class="title-box">
                <h2 class="title h3-md">Chỉnh sử danh sách phát - {{$userPlaylist->name}}</h2>
            </div>
        </div>

        <div class="box-add-playlist">
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorHtml-form"></div>
                    <form action="{{route('user-library-personal-playlist-edit', ['playlistId' => $userPlaylist->id])}}" method="post" enctype="multipart/form-data" id="add-user-playlist">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh sách phát</label>
                            <input type="text" name="name"
                                   class="form-control text-dark" id="name" value="{{$userPlaylist->name}}">
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả danh sách phát</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$userPlaylist->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Chỉnh sửa ảnh danh sách phát</label>
                            <div class="tower-file mb-2">
                                <input type="file" id="cover_image" name="cover_image">

                                <label for="cover_image" class="btn btn-info">
                                    <span class="mdi mdi-upload"></span>Chọn ảnh
                                </label>
                                <button type="button" class="btn btn-danger tower-file-clear" title="Clear Selected Files">
                                    <span class="mdi mdi-cancel pr-1"></span>Xóa ảnh đã chọn
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="btn btn-primary btn-lg" id="addUserPlaylist" data-playlist-id="{{$userPlaylist->id}}">Sửa danh sách phát</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#cover_image').fileInput({
            iconClass: 'mdi mdi-fw mdi-upload'
        });
    </script>
@endsection
