@extends('layouts.master_admin') @section('controll') New file @endsection
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
                <h3 class="box-title">Tạo lịch trình công tác</h3>
            </div>
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="maNV" style="margin-top: 10px">Nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        @foreach ($files as $value)
                        <option value="{{$value->id}}">{{$value->hoTen}} - Mã NV {{$value->id}}</option>
                        @endforeach
                    </select><br />

                    <label for="maPB" style="margin-top: 10px">Phòng ban</label>
                    <select name="maPB" class="form-control" id="maPB">
                        @foreach ($departments as $value)
                        <option value="{{$value->id}}"> {{$value->tenPB}} </option>
                        @endforeach
                    </select><br />

                    <label for="maCV" style="margin-top: 10px">Chức vụ</label>
                    <select name="maCV" class="form-control" id="maCV">
                        @foreach ($positions as $value)
                        <option value="{{$value->id}}"> {{$value->chucVu}} </option>
                        @endforeach
                    </select><br />

                    <label for="ngayDenCT" style="margin-top: 10px">Ngày đến công tác</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" id="ngayDenCT">
					</div>       

                    <label for="ngayChuyenCT" style="margin-top: 30px">Ngày chuyển công tác</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" id="ngayChuyenCT">
					</div>       

                    <div style="margin-top: 20px">
                        <a href="/admin/file" class="btn btn-danger"
                            >Hủy bỏ</a
                        >
                        <button
                            type="button"
                            class="btn btn-success btn-create-file"
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
        $("#ngayDenCT").datepicker({
            autoclose: true,
        });
        $("#ngayChuyenCT").datepicker({
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
    $(".btn-create-file").click(function () {
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("maPB", $("#maPB").val());
        form_data.append("maNV", $("#maNV").val());
        form_data.append("maCV", $("#maCV").val());
        form_data.append("ngayDenCT", formatDateTime($("#ngayDenCT").val()));
        form_data.append("ngayChuyenCT", formatDateTime($("#ngayChuyenCT").val()));

        $.ajax({
            type: "post",
            url: "/admin/work",
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
