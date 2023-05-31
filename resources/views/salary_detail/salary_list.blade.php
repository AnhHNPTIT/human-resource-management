@extends('layouts.master_admin') @section('controll') Salary details @endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Chi tiết bảng lương</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @csrf
                    <div style="margin-bottom: 30px">
                        @if(Auth::guard('admin')->user()->loaiTK != "NV")
                        <a
                            href="/admin/new/salary/detail"
                            data-toggle="modal"
                            class="btn btn-info btn-add"
                            >Thêm bảng lương</a
                        >
                        @endif
                    </div>
                    <table
                        id="list-salary-details"
                        class="table table-bordered table-striped"
                        style="margin-top: 10px"
                    >
                        <thead>
                            <tr>
                                <th class="col-sm-1 text-center">Nhân viên</th>
                                <th class="col-sm-1 text-center">Lương cơ bản</th>
                                <th class="col-sm-1 text-center">Lương tăng ca</th>
                                <th class="col-sm-1 text-center">BHXH</th>
                                <th class="col-sm-1 text-center">BHYT</th>
                                <th class="col-sm-1 text-center">BHTN</th>
                                <th class="col-sm-1 text-center">Phụ cấp</th>
                                <th class="col-sm-1 text-center">Thuế TNCN</th>
                                <th class="col-sm-1 text-center">Lương thực tế</th>
                                <th class="col-sm-1 text-center">Ghi chú</th>
                                <th class="col-sm-1 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaryDetails as $value)
                            <tr>
                                <td class="col-sm-1 text-center">
                                    <p>{{$value->account->hoTen}}</p>
                                    <p style="font-weight: 600;">(Lương: T{{$value->thang}} - {{$value->nam}})</p>
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->LCB * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->LTC * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->BHXH * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->BHYT * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->BHTN * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->PC * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->TTNCN * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{number_format($value->LTT * 1000)}} VND
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->ghiChu}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    @if(Auth::guard('admin')->user()->loaiTK != "NV")
                                    <a
                                        href="/admin/salary/detail/{{$value->id}}"
                                        type="button"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button
                                        data-id="{{$value->id}}"
                                        type="button"
                                        title="Xóa"
                                        class="btn btn-danger btn-delete-salary-detail"
                                    >
                                        <i class="fa fa-user-times"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{$salary-details->links( * 1000)}} --}}
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
            $("#list-salary-details").DataTable({
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
                url: "/admin/salary/detail/" + id,
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
                            window.location.href = "/admin/salary/detail/";
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
        $(".btn-delete-salary-detail").click(function () {
            if (confirm("Bạn có muốn xóa không?")) {
                var _this = $(this);
                var id = $(this).attr("data-id");
                $.ajax({
                    type: "delete",
                    url: "/admin/salary/detail/" + id,
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
                                window.location.href = "/admin/salary/detail/";
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
