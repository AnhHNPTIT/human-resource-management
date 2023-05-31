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
                <h3 class="box-title">Cập nhật</h3>
            </div>
            <!-- /.box-header -->
            @if(isset($salaryDetail))
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" id="getId" value="{{ $salaryDetail->id }}"><br>
                    <label for="maNV">Nhân viên</label>
                    <select name="maNV" class="form-control" id="maNV">
                        @foreach ($files as $value)
                        <option value="{{$value->id}}" {{ $salaryDetail->maNV==$value->id ? "selected" : "" }}>
                            {{$value->hoTen}}
                        </option>
                        @endforeach</select
                    ><br />

                    <label for="thang">Tháng (Lương của tháng nào)</label>
                    <input type="text" class="form-control" id="thang" value="{{$salaryDetail->thang}}" />

                    <label style="margin-top: 20px" for="nam">Năm (Lương theo năm nào)</label>
                    <input type="text" class="form-control" id="nam" value="{{$salaryDetail->nam}}"/>

                    <label style="margin-top: 20px" for="LCB" style="margin-top: 20px">Lương cơ bản (Đơn vị: Nghìn. VD: LCB nhập vào 1000 sẽ có giá trị là 1.000.000 VND)</label>
                    <input type="text" class="form-control" id="LCB" value="{{$salaryDetail->LCB}}" />

                    <label style="margin-top: 20px" for="LTC"
                        >Lương tăng ca</label
                    >
                    <input type="text" class="form-control" id="LTC" value="{{$salaryDetail->LTC}}"/>

                    <label style="margin-top: 20px" for="BHXH">BHXH (Đơn vị: Nghìn)</label>
                    <input type="text" class="form-control" id="BHXH" value="{{$salaryDetail->BHXH}}"/>

                    <label style="margin-top: 20px" for="BHYT">BHYT (Đơn vị: Nghìn)</label>
                    <input type="text" class="form-control" id="BHYT" value="{{$salaryDetail->BHYT}}"/>

                    <label style="margin-top: 20px" for="BHTN">BHTN (Đơn vị: Nghìn)</label>
                    <input type="text" class="form-control" id="BHTN" value="{{$salaryDetail->BHTN}}"/>

                    <label style="margin-top: 20px" for="PC">Phụ cấp (Đơn vị: Nghìn)</label>
                    <input type="text" class="form-control" id="PC" value="{{$salaryDetail->PC}}"/>

                    <label style="margin-top: 20px" for="TTNCN"
                        >Thuế TNCN (Đơn vị: Nghìn)</label
                    >
                    <input type="text" class="form-control" id="TTNCN" value="{{$salaryDetail->TTNCN}}"/>

                    <label style="margin-top: 20px" for="ghiChu"
                        >Ghi chú</label
                    >
                   <div>
                    <textarea name="ghiChu" id="ghiChu" rows="5" class="form-control">{{$salaryDetail->ghiChu}}</textarea>
                   </div>

                    <div style="margin-top: 20px">
                        <a href="/admin/salary/detail" class="btn btn-danger"
                            >Hủy bỏ</a
                        >
                        <button
                            type="button"
                            class="btn btn-success btn-update-salary"
                        >
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".btn-update-salary").click(function () {
        var id = $("#getId").val();
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
            url: `/admin/salary/detail/${id}`,
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
