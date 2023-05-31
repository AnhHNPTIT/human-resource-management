@extends('layouts.master_admin') 

@section('controll')
Transactions List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	@csrf
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Lương theo phòng ban</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div>
						@if(isset($from_month) && isset($from_year))
							<div class="col-xs-4">
								<label for="">Từ tháng</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right" id="getFromDate" value ="{{$from_month}}-{{$from_year}}">
								</div><br>
							</div>
						@else
							<div class="col-xs-4">
								<label for="">Từ tháng</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right" id="getFromDate" value = {{Carbon\Carbon::now()->format('m-Y')}}>
								</div><br>
							</div>						
						@endif
						@if(isset($to_month) && isset($to_year))
							<div class="col-xs-4">
								<label for="">Đến tháng</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right" id="getToDate" value ="{{$to_month}}-{{$to_year}}">
								</div><br>
							</div>
						@else
							<div class="col-xs-4">
								<label for="">Đến tháng</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right" id="getToDate" value = {{Carbon\Carbon::now()->format('m-Y')}}>
								</div><br>
							</div>
						@endif
			
						<div class="col-xs-4 text-left">
							<button type="button" class="btn btn-info btn-search" style="margin-top: 25px;">Thống kê</button>
						</div>				
					</div>
				</div>

				<div class="box-body" style="margin-top : 20px;">
					<table id="list-transactions" class="table table-bordered table-striped">
						<thead>
							<tr>
							<th class="col-sm-2 text-center">Tên phòng ban</th>
							<th class="col-sm-1 text-center">Năm</th>
							<th class="col-sm-1 text-center">Tháng</th>
							<th class="col-sm-1 text-center">Tổng lương cơ bản</th>
							<th class="col-sm-1 text-center">Tổng lương tăng ca</th>
							<th class="col-sm-1 text-center">Tổng BHXH</th>
							<th class="col-sm-1 text-center">Tổng BHYT</th>
							<th class="col-sm-1 text-center">Tổng BHTN</th>
							<th class="col-sm-1 text-center">Tổng phụ cấp</th>
							<th class="col-sm-1 text-center">Tổng thuế TNCN</th>
							<th class="col-sm-1 text-center">Tổng lương thực tế</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($reports))
							@foreach ($reports as $value)
							<tr>
							<td class="col-sm-2 text-center">
								<p>{{$value->department->tenPB}}</p>
								<p>SĐT: <strong>{{$value->department->soDT}}</strong></p>
								<p>Địa chỉ: <strong>{{$value->department->diaChi}}</strong></p>
							</td>
							<td class="col-sm-1 text-center">{{$value->nam}}</td>
							<td class="col-sm-1 text-center">{{$value->thang}}</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongLCB * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongLTC * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongBHXH * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongBHYT * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongBHTN * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongPC * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongTTNCN * 1000)}} VND
							</td>
							<td class="col-sm-1 text-center">
								{{number_format($value->tongLTT * 1000)}} VND
							</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

    <script>
    	$(document).ready(function() {
    		$('#list-transactions').DataTable( {
    			"lengthMenu": [[30, 50, 100, 500, -1],[30, 50, 100, 500, "All"]],
    		} );
    	} );
		
		$(function () {
			$("#getFromDate").datepicker({
				format: "mm-yyyy",
				startView: "months",
				minViewMode: "months",
				autoclose: true,
			});
			$("#getToDate").datepicker({
				format: "mm-yyyy",
				startView: "months",
				minViewMode: "months",
				autoclose: true,
			});
    	});
    </script>

	<script type="text/javascript">
		$('.btn-search').click(function(){
			var url = '/admin/report-salary?';

			var from_date = $('#getFromDate').val();
			var from = []
			if(from_date.includes("-")){
				from = from_date.split("-");
				url += `from_month=${+from[0]}&from_year=${+from[1]}`
			}

			var to_date = $('#getToDate').val();
			var to = []
			if(to_date.includes("-")){
				to = to_date.split("-")
				url += url[url.length -1] === "?" ? "": "&";
				url += `to_month=${+to[0]}&to_year=${+to[1]}`;
			}

			$.ajax({
				type: 'get',
				url,
				success: function(response){
					setTimeout(function() {
						window.location.href = url;
					}, 1000);
				}
			});
		});
	</script>
	<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
</section>
<!-- /.content -->
@endsection