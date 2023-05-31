@extends('layouts.master_admin') 

@section('controll')
Account Detail
@endsection

@section('content')

<script src="{{ asset("layout_user/plugins/selectize.min.js") }}"></script>
<link rel="stylesheet" href="{{ asset("layout_user/plugins/selectize.bootstrap3.min.css") }}">

<div class="container box pad">
	<div class="row">
	<div class="col-xs-12"> 
				<div class="alert alert-danger error-msg" style="display:none">
					<ul></ul>
				</div>

				<div class="alert alert-success success-msg" style="display:none">
					<ul></ul>
				</div>

				<div class="alert alert-warning unsuccess-msg" style="display:none">
					<ul></ul>
				</div>
		</div>
		@if(isset($account))
		<div class="col-xs-12">
			<div class="box-header">
				<h3 class="box-title">Cập nhật tài khoản</h3>
			</div>
				<div class="box-body">
					<div class="form-group">
						@csrf
						<input type="hidden" class="form-control" id="getAccountId" value="{{ $account->id }}"><br>

						<label for="maNV" style="margin-top: 10px">Nhân viên</label>
						<select name="maNV" class="form-control" id="getMaNV">
							@foreach ($files as $value)
							<option value={{$value->id}} {{ $value->id==$account->maNV ? "selected" : "" }}>{{$value->hoTen}} - Mã NV {{$value->id}}</option>
							@endforeach
						</select><br />
							
						<label for="tenDN" style="margin-top: 10px;">Tên đăng nhập</label>
						<input name="tenDN" type="text" class="form-control" id="getTenDN" placeholder="Ví dụ : Phan Khánh Hưng" value="{{$account->tenDN}}"><br>

						<label for="loaiTK" style="margin-top: 10px;">Loại tài khoản</label>
						<div class="input-box">
							<select name="loaiTK" id="getLoaiTK" class="form-control pull-right">
								<option value="NV_NHANSU" {{ $account->loaiTK=='NV_NHANSU' ? "selected" : "" }}>Nhân viên nhân sự</option>
								<option value="NV"  {{ $account->loaiTK=='NV' ? "selected" : "" }}>Nhân viên</option>
								<option value="NV_KETOAN"  {{ $account->loaiTK=='NV_KETOAN' ? "selected" : "" }}>Nhân viên kế toán</option>
								<option value="GIAMDOC"  {{ $account->loaiTK=='GIAMDOC' ? "selected" : "" }}>Giám đốc</option>
							</select><br>
						</div><br>

						<label for="matKhau" style="margin-top: 20px">Mật khẩu</label>
						<input
							name="matKhau"
							type="password"
							class="form-control"
							id="getMatKhau"
							placeholder="Mật khẩu"
						/><br />
					</div>
					<button type="button" class="btn btn-primary btn-save">Cập nhật</button>
				</div>
		</div>
		@endif
	</div>

	<script type="text/javascript">
		$('.btn-save').click(function(){
			var id = $('#getAccountId').val();
			var form_data = new FormData();
			form_data.append("maNV", $('#getMaNV').val());
			form_data.append("tenDN", $('#getTenDN').val());
			form_data.append("loaiTK", $('#getLoaiTK').val());
			form_data.append("matKhau", $('#getMatKhau').val());
			$.ajax({
				type : 'post',
				url : `/admin/account/${id}`,
				data : form_data,
				dataType : 'json',
				contentType: false,
				processData: false,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success : function(response){
					if(response.is === 'failed'){
						$(".error-msg").find("ul").html('');
						$(".error-msg").css('display','block');
						$(".success-msg").css('display','none');
						$(".unsuccess-msg").css('display','none');
						$.each(response.error, function( key, value ) {
							$(".error-msg").find("ul").append('<li>'+value+'</li>');
						});
					}
					if(response.is === 'success'){
						$(".success-msg").find("ul").html('');
						$(".success-msg").css('display','block');
						$(".error-msg").css('display','none');
						$(".unsuccess-msg").css('display','none');
						$(".success-msg").find("ul").append('<li>'+response.complete+'</li>');
					}
					if(response.is === 'unsuccess'){
						$(".unsuccess-msg").find("ul").html('');
						$(".unsuccess-msg").css('display','block');
						$(".error-msg").css('display','none');
						$(".success-msg").css('display','none');
						$(".unsuccess-msg").find("ul").append('<li>'+response.uncomplete+'</li>');
					}
					window.scroll({
						top: 100,
						behavior: 'smooth'
					});
				}
			});
		});
	</script>
@endsection