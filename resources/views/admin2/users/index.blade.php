@extends('layouts.admin2.main')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <a href="{{route('users.add')}}" class="btn btn-primary mr-auto"> <i class="nav-icon fas fa-plus"></i>
                    Thêm tài khoản</a>
                <form action="">
                    <div class="card-tools ml-auto">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="searchs" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="song_table" class="table table-bordered table-striped dataTable hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Ảnh đại diện</th>
                                    <th class="text-center">Phân quyền</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection

@section('custom-js')
    <script>
        $(function () {
            let getUrlParameter = function getUrlParameter(sParam) {
                let sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            };

            let table = $('#song_table').DataTable({
                "ordering": true,
                "searching": false,
                "language": {
                    "lengthMenu": "_MENU_ ",
                    "zeroRecords": "Không có dữ liệu để hiển thị",
                    "info": "Trang _PAGE_/_PAGES_",
                    // "infoEmpty": "No records available",
                    "infoEmpty": "Không có dữ liệu để hiển thị",
                    // "infoFiltered": "(filtered from _MAX_ total records)",
                    "infoFiltered": "(_MAX_/tổng số)",
                    "search": false,
                    "paginate": {
                        "first": "Trang đầu",
                        "last": "Trang cuối",
                        "next": "Trang sau",
                        "previous": "Trang trước"
                    },
                },
                serverSide: true,
                processing: true,
                responsive: true,
                stateSave: true,
                ajax: {
                    url: "{{ route('users.getData') }}",
                    "data": {
                        "searchs": getUrlParameter('searchs')
                    }
                },
                contentType: "application/json",

                cache: false,
                async: false,
                lengthMenu: [20, 30, 50, 100],
                iDisplayLength: 20,
                columnDefs: [
                    {
                        "targets": [0],
                        "searchable": true,
                        "orderable": true,
                        "width": "5%",
                        "class": "text-center"
                    },
                    {
                        "targets": [1],
                        "searchable": true,
                        "orderable": true,
                    },
                    {
                        "targets": [2],
                        "searchable": false,
                        "orderable": false,
                        "width": "8%",
                        "class": "text-center"
                    },
                    {
                        "targets": [3],
                        "searchable": true,
                        "orderable": false,
                    },
                    {
                        "targets": [4],
                        "searchable": false,
                        "orderable": false, "width": "8%",
                        "class": "text-center"

                    },
                    {
                        "targets": [5],
                        "searchable": false,
                        "orderable": false,
                        "width": "8%",
                        "class": "text-center"
                    },
                ],
                columns: [
                    {
                        data: 'id',
                    },
                    {
                        data: "email",
                    },
                    {
                        data: 'avatar',
                        render: function (data) {
                            return "<img src='../" + data + "' width='50px' >";
                        }
                    },
                    {
                        data: "role",
                        render: function (data) {
                            if (data == 100) {
                                return "<p>Thành viên</p>";
                            } else if (data == 400) {
                                return "<p>Thành viên VIP</p>";
                            } else if (data == 600) {
                                return "<p>Cộng tác viên</p>";
                            } else if (data == 900) {
                                return "<p>Admin</p>";
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function (data, type, row) {
                            let str = '';
                            if (data === 1) {
                                return `<span class="badge bg-success">Hiển thị</span>`;
                            } else {
                                return `<span class="badge bg-danger">Ẩn</span>`;
                            }
                        },
                    },
                    {
                        data: 'id',
                        title: "Hành động",
                        autoWidth: true,
                        render: function (data, type, row) {
                            let html = `<a href="songs/update/${data}" data-edit="' + data + '" class="mr-3"><i class="nav-icon fas
                            fa-edit"></i></a><a
                            href="javascript:;" data-remove="${data}" class="btn-remove text-danger"><i class="fas fa-trash-alt"></i></a>`;
                            return html;
                        },
                    }

                ],

                initComplete: function () {
                    $('body').on('click', '.btn-remove', function () {
                        let id = $(this).data('remove');
                        Swal.fire({
                            title: 'Bạn có chắc chắn muốn xóa bài hát này',
                            text: "Bạn sẽ không lấy lại được dữ liệu đã xóa!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Có, xóa bài hát!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: "users/delete/" + id,
                                    method: 'GET',
                                }).done((result) => {
                                    if (result) {
                                        Swal.fire(
                                            'Xóa bài hát!',
                                            'Bài hát đã bị xóa',
                                            'success'
                                        )
                                    }
                                    setTimeout(function () {
                                        table.ajax.reload();
                                    }, 500);
                                })
                            }
                        })
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

