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
                <h3 class="box-title">Tạo hồ sơ</h3>
            </div>
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="maHDLD" style="margin-top: 10px">Mã hợp đồng lao động</label>
                    <select name="maHDLD" class="form-control" id="maHDLD">
                        <option value="">-----------Chọn hợp đồng-----------</option>
                        @foreach ($contracts as $value)
                        <option value={{$value->id}}>Mã HD {{$value->id}} - ({{$value->contractType->tenLHDLD}} - {{$value->position->chucVu}})</option>
                        @endforeach
                    </select><br />

                    <label for="maNV" style="margin-top: 10px">Mã nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        <option value="">-----------Chọn nhân viên-----------</option>
                        @foreach ($accounts as $value)
                        <option value={{$value->id}}>Mã NV {{$value->id}} - {{$value->tenDN}}</option>
                        @endforeach
                    </select><br />

                    <label for="hoTen" style="margin-top: 10px">Họ tên</label>
                    <input
                        name="hoTen"
                        type="text"
                        class="form-control"
                        id="hoTen"
                        placeholder="Ví dụ : Phan Khánh Hưng"
                    /><br />

                    <label for="" style="margin-top: 10px;">Ảnh nhân viên</label>
					<input name="image" type="file" class="form-control" id="getAnhThe" onchange="readURL(this);"><br>
					<div style="text-align : center; margin-top : 10px; margin-botom : 10px;">
						<img id="anhThe" src="#" alt=""/>
					</div>
					<script>
						function readURL(input) {
							if (input.files && input.files[0]) {
								var reader = new FileReader();

								reader.onload = function (e) {
									$('#anhThe')
										.attr('src', e.target.result)
										.width(150)
										.height(200);
								};

								reader.readAsDataURL(input.files[0]);
							}
						}
					</script>

                    <label for="ngaySinh">Ngày sinh</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" id="ngaySinh">
					</div>       

					<label for="gioiTinh" style="margin-top: 30px;">Giới tính</label>
					<select name="gioiTinh" class="form-control" id="gioiTinh">
                        <option value="1">Nam</option>
						<option value="2">Nữ</option>
					</select><br>

                    <label for="diaChi" style="margin-top: 10px">Địa chỉ</label>
                    <input
                        name="diaChi"
                        type="text"
                        class="form-control"
                        id="diaChi"
                    /><br />

                    <label for="soDT" style="margin-top: 10px">Số điện thoại</label>
                    <input
                        name="soDT"
                        type="text"
                        class="form-control"
                        id="soDT"
                    /><br />
                    <label for="bangCap" style="margin-top: 10px">Bằng cấp</label>
                    <input
                        name="bangCap"
                        type="text"
                        class="form-control"
                        id="bangCap"
                    /><br />
                    <label for="soCMND" style="margin-top: 10px">Số CMND</label>
                    <input
                        name="soCMND"
                        type="text"
                        class="form-control"
                        id="soCMND"
                    /><br />
                    <label for="email" style="margin-top: 10px">Email</label>
                    <input
                        name="email"
                        type="text"
                        class="form-control"
                        id="email"
                    /><br />

                    <label for="maBHXH" style="margin-top: 10px">Mã BHXH</label>
                    <input
                        name="maBHXH"
                        type="text"
                        class="form-control"
                        id="maBHXH"
                    /><br />
                    <label for="maBHYT" style="margin-top: 10px">Mã BHYT</label>
                    <input
                        name="maBHYT"
                        type="text"
                        class="form-control"
                        id="maBHYT"
                    /><br />
                    <label for="maBHTN" style="margin-top: 10px">Mã BHTN</label>
                    <input
                        name="maBHTN"
                        type="text"
                        class="form-control"
                        id="maBHTN"
                    /><br />

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
        $("#ngaySinh").datepicker({
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
        form_data.append("maNV", $("#maNV").val());
        form_data.append("hoTen", $("#hoTen").val());
        form_data.append('anhThe', $('input[type=file]')[0].files[0]);
        form_data.append("ngaySinh", formatDateTime($("#ngaySinh").val()));
        form_data.append("gioiTinh", $("#gioiTinh").val());
        form_data.append("diaChi", $("#diaChi").val());
        form_data.append("soDT", $("#soDT").val());
        form_data.append("bangCap", $("#bangCap").val());
        form_data.append("soCMND", $("#soCMND").val());
        form_data.append("email", $("#email").val());
        form_data.append("maHDLD", $("#maHDLD").val());
        form_data.append("maBHXH", $("#maBHXH").val());
        form_data.append("maBHYT", $("#maBHYT").val());
        form_data.append("maBHTN", $("#maBHTN").val());

        $.ajax({
            type: "post",
            url: "/admin/file",
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
