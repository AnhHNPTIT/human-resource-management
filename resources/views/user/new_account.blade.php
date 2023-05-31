@extends('layouts.master_admin') @section('controll') New account @endsection
@section('content')

<div class="container box box-body pad">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger error-msg" style="display: none">
                <ul></ul>
            </div>

            <div class="alert alert-success success-msg" style="display: none">
                <ul></ul>
            </div>

            <div
                class="alert alert-warning unsuccess-msg"
                style="display: none"
            >
                <ul></ul>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="box-header">
                <h3 class="box-title">Tạo tài khoản</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="maNV" style="margin-top: 10px">Nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        @foreach ($files as $value)
                        <option value="{{$value->id}}">{{$value->hoTen}} - Mã NV {{$value->id}}</option>
                        @endforeach
                    </select><br />

                    <label for="tenDN" style="margin-top: 10px">Tên đăng nhập</label>
                    <input
                        name="tenDN"
                        type="text"
                        class="form-control"
                        id="tenDN"
                        placeholder="Ví dụ : Phan Khánh Hưng"
                    /><br />

                    <label for="matKhau" style="margin-top: 10px">Mật khẩu</label>
                    <input
                        name="matKhau"
                        type="password"
                        class="form-control"
                        id="matKhau"
                        placeholder="Mật khẩu"
                    /><br />

                    <label for="loaiTK" style="margin-top: 10px"
                        >Loại tài khoản</label
                    >
                    <select name="loaiTK" class="form-control" id="loaiTK">
                        <option value="NV_NHANSU">Nhân viên nhân sự</option>
                        <option value="NV">Nhân viên</option>
                        <option value="NV_KETOAN">Nhân viên kế toán</option>
                        <option value="GIAMDOC">Giám đốc</option></select
                    ><br />

                    <div style="margin-top: 10px">
                        <a href="/admin/account" class="btn btn-danger"
                            >Hủy bỏ</a
                        >
                        <button
                            type="button"
                            class="btn btn-success btn-register-account"
                        >
                            Tạo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        //Date picker
        $("#datepicker").datepicker({
            autoclose: true,
        });
    });
</script>

<script type="text/javascript">
    $(".btn-register-account").click(function () {
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("maNV", $("#maNV").val());
        form_data.append("tenDN", $("#tenDN").val());
        form_data.append("loaiTK", $("#loaiTK").val());
        form_data.append("matKhau", $("#matKhau").val());

        $.ajax({
            type: "post",
            url: "/admin/account",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.is === "failed") {
                    $(".error-msg").find("ul").html("");
                    $(".error-msg").css("display", "block");
                    $(".success-msg").css("display", "none");
                    $(".unsuccess-msg").css("display", "none");
                    $.each(response.error, function (key, value) {
                        $(".error-msg")
                            .find("ul")
                            .append("<li>" + value + "</li>");
                    });
                }
                if (response.is === "success") {
                    $(".success-msg").find("ul").html("");
                    $(".success-msg").css("display", "block");
                    $(".error-msg").css("display", "none");
                    $(".unsuccess-msg").css("display", "none");
                    $(".success-msg")
                        .find("ul")
                        .append("<li>" + response.complete + "</li>");
                }
                if (response.is === "unsuccess") {
                    $(".unsuccess-msg").find("ul").html("");
                    $(".unsuccess-msg").css("display", "block");
                    $(".error-msg").css("display", "none");
                    $(".success-msg").css("display", "none");
                    $(".unsuccess-msg")
                        .find("ul")
                        .append("<li>" + response.uncomplete + "</li>");
                }
                window.scroll({
                    top: 0,
                    behavior: "smooth",
                });
            },
        });
    });
</script>
@endsection
