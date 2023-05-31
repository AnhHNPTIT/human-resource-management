@extends('layouts.master_admin') @section('controll') Files List @endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách hồ sơ</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @csrf
                    <div style="margin-bottom: 30px">
                        @if(Auth::guard('admin')->user()->loaiTK != "NV")
                        <a
                            href="/admin/new/file"
                            data-toggle="modal"
                            class="btn btn-info btn-add"
                            >Thêm hồ sơ</a
                        >
                        @endif
                    </div>
                    <table
                        id="list-files"
                        class="table table-bordered table-striped"
                        style="margin-top: 10px"
                    >
                        <thead>
                            <tr>
                                <th class="col-sm-1 text-center">Nhân viên</th>
                                <th class="col-sm-2 text-center">Họ tên</th>
                                <th class="col-sm-1 text-center">Ảnh thẻ</th>
                                <th class="col-sm-1 text-center">Giới tính</th>
                                <th class="col-sm-2 text-center">Số ĐT</th>
                                <th class="col-sm-1 text-center">Số CMND</th>
                                <th class="col-sm-1 text-center">Bằng cấp</th>
                                <th class="col-sm-1 text-center">Ngày sinh</th>
                                <th class="col-sm-2 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php Carbon\Carbon::setLocale('vi'); @endphp
                            @foreach ($files as $value)
                            <tr>
                                <td class="col-sm-1 text-center">
                                    {{$value->id}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->hoTen}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    <img src="{{asset('images/'.$value->anhThe)}}" style="width: 100px; height: 120px;">
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->gioiTinh == 1 ? 'Nam' : 'Nữ'}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->soDT}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->soCMND}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->bangCap}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->ngaySinh}}
                                </td>

                                <td class="col-sm-2 text-center">
                                    <a
                                        href="/admin/file/{{$value->id}}"
                                        type="button"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @if(Auth::guard('admin')->user()->loaiTK != "NV")
                                    <button
                                        data-id="{{$value->id}}"
                                        type="button"
                                        title="Xóa"
                                        class="btn btn-danger btn-delete-file"
                                    >
                                        <i class="fa fa-user-times"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{$files->links()}} --}}
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
            $("#list-files").DataTable({
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
                url: "/admin/file/" + id,
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
                            window.location.href = "/admin/file/";
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
        $(".btn-delete-file").click(function () {
            if (confirm("Bạn có muốn xóa không?")) {
                var _this = $(this);
                var id = $(this).attr("data-id");
                $.ajax({
                    type: "delete",
                    url: "/admin/file/" + id,
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
                                window.location.href = "/admin/file/";
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
