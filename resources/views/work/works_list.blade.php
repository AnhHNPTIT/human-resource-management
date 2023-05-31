@extends('layouts.master_admin') @section('controll') works List @endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách lịch trình công tác</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @csrf
                    <div style="margin-bottom: 30px">
                        <a
                            href="/admin/new/work"
                            data-toggle="modal"
                            class="btn btn-info btn-add"
                            >Thêm lịch trình công tác</a
                        >
                    </div>
                    <table
                        id="list-works"
                        class="table table-bordered table-striped"
                        style="margin-top: 10px"
                    >
                        <thead>
                            <tr>
                                <th class="col-sm-2 text-center">Nhân viên</th>
                                <th class="col-sm-2 text-center">Chức vụ</th>
                                <th class="col-sm-2 text-center">Phòng ban</th>
                                <th class="col-sm-2 text-center">Ngày đến công tác</th>
                                <th class="col-sm-2 text-center">Ngày chuyển công tác</th>
                                <th class="col-sm-2 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($works as $value)
                            <tr>
                                <td class="col-sm-2 text-center">
                                    {{$value->account->hoTen}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->department->tenPB}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->position->chucVu}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->ngayDenCT}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->ngayChuyenCT}}
                                </td>

                                <td class="col-sm-2 text-center">
                                    <a
                                        href="/admin/work/{{$value->id}}"
                                        type="button"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button
                                        data-id="{{$value->id}}"
                                        type="button"
                                        title="Xóa"
                                        class="btn btn-danger btn-delete-work"
                                    >
                                        <i class="fa fa-user-times"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{$works->links()}} --}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <script>
        $(document).ready(function () {
            $("#list-works").DataTable({
                lengthMenu: [
                    [25, 50, 100, 500, 1000, 5000, -1],
                    [25, 50, 100, 500, 1000, 5000, "All"],
                ],
                order: [[6, "desc"]],
            });
        });
    </script>

    <script type="text/javascript">
        // block or unblock
        $(".btn-edit").click(function () {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "put",
                url: "/admin/work/" + id,
                data: {
                    _token: $('[name="_token"]').val(),
                    id: id,
                },
                success: function (response) {
                    if (response.is === "success") {
                        swal({
                            title: "Hoàn thành!",
                            text: response.complete,
                            icon: "success",
                            buttons: true,
                            buttons: ["Ok"],
                            timer: 1000,
                        });

                        setTimeout(function () {
                            window.location.href = "/admin/work/";
                        }, 1000);
                    }
                    if (response.is === "unsuccess") {
                        swal({
                            title: "Thất bại!",
                            text: response.uncomplete,
                            icon: "error",
                            buttons: true,
                            buttons: ["Ok"],
                            timer: 5000,
                        });
                    }
                },
            });
        });

        // delete
        $(".btn-delete-work").click(function () {
            if (confirm("Bạn có muốn xóa không?")) {
                var _this = $(this);
                var id = $(this).attr("data-id");
                $.ajax({
                    type: "delete",
                    url: "/admin/work/" + id,
                    data: {
                        _token: $('[name="_token"]').val(),
                    },
                    success: function (response) {
                        _this.parent().parent().remove();
                        if (response.is === "success") {
                            _this.parent().parent().remove();
                            swal({
                                title: "Hoàn thành!",
                                text: response.complete,
                                icon: "success",
                                buttons: true,
                                buttons: ["Ok"],
                                timer: 1000,
                            });

                            setTimeout(function () {
                                window.location.href = "/admin/work/";
                            }, 1000);
                        }
                        if (response.is === "unsuccess") {
                            swal({
                                title: "Thất bại!",
                                text: response.uncomplete,
                                icon: "error",
                                buttons: true,
                                buttons: ["Ok"],
                                timer: 5000,
                            });
                        }
                    },
                });
            }
        });
    </script>
    <script
        type="text/javascript"
        src="{{ asset('home/js/sweetalert.min.js') }}"
    ></script>
</section>

@endsection
