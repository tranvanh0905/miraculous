@extends('layouts.admin2.main')

@section('title')

@endsection

@section('content')

    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header" style="background-color: #fff;">
                <a href="{{route('slider.add')}}" class="btn btn-primary mr-auto"> <i class="nav-icon fas fa-plus"></i>
                    Thêm slider</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Đường dẫn</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        <tbody class="row_position">
                        @if ($sliders !== null)
                            @foreach ($sliders as $slider)
                                <tr id="{{$slider->id}}" data-sort="{{$slider->sort}}">
                                    <td style="width:10%">{{$slider->id}}</td>
                                    <td style="width:50%"><a href="{{$slider->url}}">{{$slider->url}}</a></td>
                                    <td><img src="{{url($slider->image)}}" width="50px" alt=""></td>
                                    <td>
                                        @if ($slider->status == 0) {!! '<span class="badge bg-danger">Không hiển thị</span>'!!} @endif
                                        @if ($slider->status == 1) {!! '<span class="badge bg-success">Hiển thị</span>'!!} @endif
                                    </td>
                                    <td><a href="{{route('slider.updateform', $slider->id)}}" class="mr-3"><i class="nav-icon fas
                            fa-edit"></i></a><a class="btn-remove text-danger"  href="javascript:;" data-remove="{{$slider->id}}"><i
                                                class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
<?php
$url = url('admin');
?>
@section('custom-js')
    <script>
        $(".row_position").sortable({
            delay: 150,
            stop: function () {
                var selectedData = new Array();
                var selectedSort = new Array();
                $('.row_position>tr').each(function () {
                    selectedData.push($(this).attr("id"));
                    selectedSort.push($(this).attr("data-sort"));
                });
                updateOrder(selectedData, selectedSort);
            }
        });

        function updateOrder(data, sort) {
            $.ajax({
                url: '{{url()->current()}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    data,
                    sort
                },
                success: function () {
                    alert('Đổi chỗ thành công');
                }
            })
        }
        $('body').on('click', '.btn-remove', function () {
            let id = $(this).data('remove');
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa slider này',
                text: "Bạn sẽ không lấy lại được dữ liệu đã xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa slider!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "slider/delete/" + id,
                        method: 'GET',
                    }).done((result) => {
                        if (result) {
                            location.reload();

                        }
                    })
                }
            })
        })
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
                type: 'success',
                title: '{{ session('status') }}'
            })
        </script>
    @endif
@endsection
