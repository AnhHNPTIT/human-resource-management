@extends('layouts.master_admin') @section('controll') Contract detail
@endsection @section('content')

<div class="container box box-body pad">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger error-msg" style="display: none">
                <ul></ul>
            </div>

            <div class="alert alert-success success-msg" style="display: none">
                <ul></ul>
            </div>

            <div class="alert alert-warning unsuccess-msg" style="display: none">
                <ul></ul>
            </div>
        </div>

        @if(isset($file))
        <div class="col-xs-12">
            <div class="box-header">
                <h3 class="box-title">Cập nhật hồ sơ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @csrf
                <input type="hidden" class="form-control" id="getFileId" value="{{ $file->id }}" /><br />
                <div class="form-group">
                    <label for="maHDLD" style="margin-top: 10px">Mã hợp đồng lao động</label>
                    <select name="maHDLD" class="form-control" id="maHDLD">
                        @foreach ($contracts as $value)
                        <option value="{{$value->id}}" {{ $file->maHDLD==$value->id ? "selected" : "" }}>Mã HD {{$value->id}} - ({{$value->contractType->tenLHDLD}}
                            - {{$value->position->chucVu}})
                        </option>
                        @endforeach
                    </select><br />

                    <label for="maNV" style="margin-top: 10px">Mã nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        @foreach ($accounts as $value)
                        <option value="{{$value->id}}" {{ $file->maNV==$value->id ? "selected" : "" }}>Mã NV {{$value->id}} - {{$value->tenDN}}
                        </option>
                        @endforeach</select
                    ><br />

                    <label for="hoTen" style="margin-top: 10px">Họ tên</label>
                    <input name="hoTen" type="text" class="form-control" id="hoTen" value="{{$file->hoTen}}" /><br />

                    <label for="" style="margin-top: 10px">Ảnh nhân viên</label>
                    <input name="image" type="file" class="form-control" id="getAnhThe"
                        onchange="readURL(this);" /><br />
                    <div style="
                            text-align: center;
                            margin-top: 10px;
                            margin-botom: 10px;
                        ">
                        <img id="anhThe" src="#" alt="" />
                    </div>
                    <script>
                        var image = "<?php echo $file->anhThe ?>";
                        $('#anhThe').attr('src', '/images/'+image).width(150).height(200);
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function (e) {
                                    $("#anhThe")
                                        .attr("src", e.target.result)
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
                        <input type="text" class="form-control pull-right" id="ngaySinh" value="{{$file->ngaySinh}}" />
                    </div>

                    <label for="gioiTinh" style="margin-top: 30px">Giới tính</label>
                    <select name="gioiTinh" class="form-control" id="gioiTinh">
                        <option value="1" {{ $file->gioiTinh==1 ? "selected" : "" }}>Nam</option>
						<option value="2" {{ $file->gioiTinh==2 ? "selected" : "" }}>Nữ</option>
                    </select><br />

                    <label for="diaChi" style="margin-top: 10px">Địa chỉ</label>
                    <input name="diaChi" type="text" class="form-control" id="diaChi" value="{{$file->diaChi}}" /><br />

                    <label for="soDT" style="margin-top: 10px">Số điện thoại</label>
                    <input name="soDT" type="text" class="form-control" id="soDT" value="{{$file->soDT}}" /><br />
                    <label for="bangCap" style="margin-top: 10px">Bằng cấp</label>
                    <input name="bangCap" type="text" class="form-control" id="bangCap"
                        value="{{$file->bangCap}}" /><br />
                    <label for="soCMND" style="margin-top: 10px">Số CMND</label>
                    <input name="soCMND" type="text" class="form-control" id="soCMND" value="{{$file->soCMND}}" /><br />
                    <label for="email" style="margin-top: 10px">Email</label>
                    <input name="email" type="text" class="form-control" id="email" value="{{$file->email}}" /><br />

                    <label for="maBHXH" style="margin-top: 10px">Mã BHXH</label>
                    <input name="maBHXH" type="text" class="form-control" id="maBHXH" value="{{$file->maBHXH}}" /><br />
                    <label for="maBHYT" style="margin-top: 10px">Mã BHYT</label>
                    <input name="maBHYT" type="text" class="form-control" id="maBHYT" value="{{$file->maBHYT}}" /><br />
                    <label for="maBHTN" style="margin-top: 10px">Mã BHTN</label>
                    <input name="maBHTN" type="text" class="form-control" id="maBHTN" value="{{$file->maBHTN}}" /><br />

                    <div style="margin-top: 20px">
                        <a href="/admin/file" class="btn btn-danger">Hủy bỏ</a>
                        <button type="button" class="btn btn-success btn-update-file">
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
        $("#ngaySinh").datepicker({
            autoclose: true,
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"
    integrity="sha512-CryKbMe7sjSCDPl18jtJI5DR5jtkUWxPXWaLCst6QjH8wxDexfRJic2WRmRXmstr2Y8SxDDWuBO6CQC6IE4KTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    function formatDateTime(time) {
        if (time) {
            return moment(time).format("YYYY-MM-DD");
        }
        return null;
    }
    $(".btn-update-file").click(function () {
        var form_data = new FormData();
        var id = $("#getFileId").val();
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
            url: `/admin/file/${id}`,
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