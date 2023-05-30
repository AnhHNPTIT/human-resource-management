@extends('layouts.master_admin') @section('controll') Accounts List @endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách người dùng</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @csrf
                    <div style="margin-bottom: 30px">
                        <a
                            href="/admin/new/account"
                            data-toggle="modal"
                            class="btn btn-info btn-add"
                            >Thêm tài khoản</a
                        >
                    </div>
                    <table
                        id="list-accounts"
                        class="table table-bordered table-striped"
                        style="margin-top: 10px"
                    >
                        <thead>
                            <tr>
                                <th class="col-sm-3 text-center">
                                    Tên đăng nhập
                                </th>
                                <th class="col-sm-3 text-center">
                                    Loại tài khoản
                                </th>
                                <th class="col-sm-3 text-center">Tham gia</th>
                                <th class="col-sm-3 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php Carbon\Carbon::setLocale('vi'); @endphp
                            @foreach ($accounts as $value)
                            <tr>
                                <td class="col-sm-3 text-center">
                                    {{$value->tenDN}}
                                </td>
                                <td class="col-sm-3 text-center">
                                    {{$value->loaiTK}}
                                </td>
                                <td class="col-sm-3 text-center">
                                    {{Carbon\Carbon::parse($value->created_at)->diffForHumans()}}
                                </td>

                                <td class="col-sm-3 text-center">
                                    <a
                                        href="/admin/account/{{$value->id}}"
                                        type="button"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button
                                        data-id="{{$value->id}}"
                                        type="button"
                                        title="Xóa"
                                        class="btn btn-danger btn-delete-account"
                                    >
                                        <i class="fa fa-user-times"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{$accounts->links()}} --}}
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
            $("#list-accounts").DataTable({
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
                url: "/admin/account/" + id,
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
                            window.location.href = "/admin/account/";
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
        $(".btn-delete-account").click(function () {
            if (confirm("Bạn có muốn xóa không?")) {
                var _this = $(this);
                var id = $(this).attr("data-id");
                $.ajax({
                    type: "delete",
                    url: "/admin/account/" + id,
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
                                window.location.href = "/admin/account/";
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
