@extends('layouts.master_admin') 

@section('controll')
Products List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	@csrf
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Nhân viên theo phòng ban</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="list-products" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-3 text-center">Phòng ban</th>
								<th class="col-sm-3 text-center">Số điên thoại</th>
								<th class="col-sm-3 text-center">Địa chỉ</th>
								<th class="col-sm-3 text-center">Số lượng nhân viên</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($reports))
							@foreach ($reports as $value)
							<tr>
								<td class="col-sm-3 text-center">{{$value['tenPB']}}</td>
								<td class="col-sm-3 text-center">{{$value['soDT']}}</td>
								<td class="col-sm-3 text-center">{{$value['diaChi']}}</td>
								<td class="col-sm-3 text-center">{{$value['soLuongNv']}}</td>
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
    		$('#list-products').DataTable( {
    			"lengthMenu": [[15, 25, -1], [15, 25, "All"]],
				"ordering": false
    		} );
    	} );
    </script>

	<script type="text/javascript">
		// search
		$('.btn-search').click(function(){
			var $radio = $('input[name=product]:checked');
			var product = $radio.val();
			var id = $radio.attr('id');
			$.ajax({
				type: 'post',
				url: '/admin/report_product/' + id,
				data:{
					_token :$('[name="_token"]').val(),
					id : id,
				},
				success: function(response){
					setTimeout(function() {
						window.location.href = "/admin/report_product/" + id;
					}, 1000);
				}
			});
		});
	</script>
	<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
</section>
<!-- /.content -->
@endsection