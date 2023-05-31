@extends('layouts.master_admin') @section('controll') New salary detail
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

            <div
                class="alert alert-warning unsuccess-msg"
                style="display: none"
            >
                <ul></ul>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="box-header">
                <h3 class="box-title">Thêm chi tiết bảng lương</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="maNV" style="margin-top: 10px">Nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        @foreach ($files as $value)
                        <option value="{{$value->id}}">
                            {{$value->hoTen}}
                        </option>
                        @endforeach</select
                    ><br />

                    <label for="thang">Tháng (Lương của tháng nào)</label>
                    <input type="text" class="form-control" id="thang" />

                    <label for="nam" style="margin-top: 10px">Năm (Lương theo năm nào)</label>
                    <input type="text" class="form-control" id="nam" />

                    <label for="LCB">Lương cơ bản</label>
                    <input type="text" class="form-control" id="LCB" />

                    <label for="LTC" style="margin-top: 10px"
                        >Lương tăng ca</label
                    >
                    <input type="text" class="form-control" id="LTC" />

                    <label for="BHXH" style="margin-top: 10px">BHXH</label>
                    <input type="text" class="form-control" id="BHXH" />

                    <label for="BHYT" style="margin-top: 10px">BHYT</label>
                    <input type="text" class="form-control" id="BHYT" />

                    <label for="BHTN" style="margin-top: 10px">BHTN</label>
                    <input type="text" class="form-control" id="BHTN" />

                    <label for="PC" style="margin-top: 10px">Phụ cấp</label>
                    <input type="text" class="form-control" id="PC" />

                    <label for="TTNCN" style="margin-top: 10px"
                        >Thuế TNCN</label
                    >
                    <input type="text" class="form-control" id="TTNCN" />

                    <label for="ghiChu" style="margin-top: 10px"
                        >Ghi chú</label
                    >
                   <div>
                    <textarea name="ghiChu" id="ghiChu" rows="5" class="form-control"></textarea>
                   </div>

                    <div style="margin-top: 20px">
                        <a href="/admin/salary/detail" class="btn btn-danger"
                            >Hủy bỏ</a
                        >
                        <button
                            type="button"
                            class="btn btn-success btn-create-salary"
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
    $(".btn-create-salary").click(function () {
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("maNV", $("#maNV").val());
        form_data.append("thang", $("#thang").val());
        form_data.append("nam", $("#nam").val());
        form_data.append("LCB", $("#LCB").val());
        form_data.append("LTC", $("#LTC").val());
        form_data.append("BHXH", $("#BHXH").val());
        form_data.append("BHYT", $("#BHYT").val());
        form_data.append("BHTN", $("#BHTN").val());
        form_data.append("PC", $("#PC").val());
        form_data.append("TTNCN", $("#TTNCN").val());
        form_data.append("ghiChu", $("#ghiChu").val());

        $.ajax({
            type: "post",
            url: "/admin/salary/detail",
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
