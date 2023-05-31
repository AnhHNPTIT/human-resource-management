@extends('layouts.master_admin') 
@section('controll') 
Contract detail
@endsection
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

		@if(isset($contract))
        <div class="col-xs-12">
            <div class="box-header">
                <h3 class="box-title">Cập nhật hợp đồng</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @csrf
				<input type="hidden" class="form-control" id="getContractId" value="{{ $contract->id }}"><br>
                <div class="form-group">
                    <label for="maLHDLD" style="margin-top: 10px"
                        >Loại hợp đồng</label
                    >
                    <select name="maLHDLD" class="form-control" id="maLHDLD">
                        @foreach ($contract_types as $value)
                        <option value="{{$value->id}}" {{ $contract->maLHDLD==$value->id ? "selected" : "" }}>{{$value->tenLHDLD}}</option>
                        @endforeach
                    </select><br />

                    <label for="maCV"
                        >Chức vụ</label
                    >
                    <select name="maCV" class="form-control" id="maCV">
                        @foreach ($positions as $value)
                        <option value="{{$value->id}}" {{ $contract->maCV==$value->id ? "selected" : "" }} >{{$value->chucVu}}</option>
                        @endforeach
                    </select><br />

                    <label for="ngayKyHD">Ngày ký hợp đồng</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input
                            type="text"
                            class="form-control pull-right"
                            id="ngayKyHD"
							value="{{$contract->ngayKyHD}}"
                        />
                    </div>

                    <label for="ngayBD" style="margin-top: 10px">Ngày bắt đầu</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input
                            type="text"
                            class="form-control pull-right"
                            id="ngayBD"
							value="{{$contract->ngayBD}}"
                        />
                    </div>

                    <label for="ngayKT" style="margin-top: 10px">Ngày kết thúc</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input
                            type="text"
                            class="form-control pull-right"
                            id="ngayKT"
							value="{{$contract->ngayKT}}"
                        />
                    </div>

                    <div style="margin-top: 20px">
                        <a href="/admin/contract" class="btn btn-danger"
                            >Hủy bỏ</a
                        >
                        <button
                            type="button"
                            class="btn btn-success btn-create-contract"
                        >
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </div>
		@endif
    </div>
</div>

<script type="text/javascript">
    $(function () {
        //Date picker
        $("#ngayKyHD").datepicker({
            autoclose: true,
        });
        $("#ngayBD").datepicker({
            autoclose: true,
        });
        $("#ngayKT").datepicker({
            autoclose: true,
        });
    });
</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"
    integrity="sha512-CryKbMe7sjSCDPl18jtJI5DR5jtkUWxPXWaLCst6QjH8wxDexfRJic2WRmRXmstr2Y8SxDDWuBO6CQC6IE4KTA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>

<script type="text/javascript">
    function formatDateTime(time) {
        if (time) {
            return moment(time).format("YYYY-MM-DD");
        }
        return null;
    }
    $(".btn-create-contract").click(function () {
        var form_data = new FormData();
        var id = $("#getContractId").val();
        var ngayKyHD = $("#ngayKyHD").val();
        var ngayBD = $("#ngayBD").val();
        var ngayKT = $("#ngayKT").val();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("maLHDLD", $("#maLHDLD").val());
        form_data.append("maCV", $("#maCV").val());
        form_data.append("ngayKyHD", formatDateTime(ngayKyHD));
        form_data.append("ngayBD", formatDateTime(ngayBD));
        form_data.append("ngayKT", formatDateTime(ngayKT));

        $.ajax({
            type: "post",
            url: `/admin/contract/${id}`,
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
