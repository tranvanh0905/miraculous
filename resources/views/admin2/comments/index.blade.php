@extends('layouts.admin2.main')

@section('title')
    Danh sách bình luận
@endsection

@section('content')

    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="song_table" class="table table-bordered table-striped dataTable hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Người bình luận</th>
                                    <th class="text-center">Nội dung bình luận</th>
                                    <th class="text-center">Bài hát</th>
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
                    url: "{{route('comments.getData')}}",
                    "data": {
                        "status": getUrlParameter('status')
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
                        "width": "30%",
                        "class": "text-center"

                    },
                    {
                        "targets": [2],
                        "searchable": false,
                        "orderable": false,
                        "width": "30%",
                        "class": "text-center"
                    },
                    {
                        "targets": [3],
                        "searchable": true,
                        "orderable": false,
                        "class": "text-center",
                    },
                    {
                        "targets": [4],
                        "searchable": false,
                        "orderable": false, "width": "8%",
                        "class": "text-center"
                    }, {
                        "targets": [5],
                        "searchable": false,
                        "orderable": false, "width": "8%",
                        "class": "text-center"
                    },

                ],
                columns: [
                    {
                        data: 'id',
                    },
                    {
                        data: 'user.username',

                    },
                    {
                        data: 'content',
                    },
                    {
                        data: 'song',
                        render: function (data, type, row) {
                            let str = '';
                            let array = [data];
                            if (typeof data == "object") {
                                array.forEach(function (item, index) {
                                    str += `<a href="../single-song/${item.id}" class="mx-auto d-block text-center">${item.name}</a>`;
                                });
                                return str;
                            } else {
                                return str;
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
                            let html = `<a
                            href="javascript:;" data-remove="${data}" class="btn-remove text-danger"><i class="fas fa-trash-alt"></i></a>`;
                            return html;
                        },
                    }

                ],

                initComplete: function () {
                    $('body').on('click', '.btn-remove', function () {
                        let id = $(this).data('remove');
                        Swal.fire({
                            title: 'Bạn có chắc chắn muốn xóa bình luận này',
                            text: "Bạn sẽ không lấy lại được dữ liệu đã xóa!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Có, xóa bình luận!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: "comment/delete/" + id,
                                    method: 'GET',
                                }).done((result) => {
                                    if (result) {
                                        Swal.fire(
                                            'Xóa bình luận!',
                                            'Bình luận đã bị xóa',
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
