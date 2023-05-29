@extends('layouts.master_home')

@section('title')
    Giới thiệu - Functional Food Store
@endsection

@section('css')
    <!-- Blog Style CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/blog-styles.css')}}" media="all" />
@endsection

@section('home')

<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-wrapper-area02"></div>
            <div class="em-main-container em-col2-left-layout">
                <div class="row"> 
                    <div class="col-sm-24 em-col-main">
                        <div class="em_post-item">                           
                            <div class="" style="text-align : justify; padding: 10px 10px; line-height : 30px;">
                                <p><strong>VỀ CHÚNG TÔI</strong></p>

                                <p>Cửa hàng thực phẩm chức năng - FUNCTIONAL FOOD STORE là nơi chuyên cung cấp các thực phẩm chức năng cho mọi lứa tuổi.</p>

                                <p>Với đội ngũ Dược sĩ tư vấn chuyên môn tốtchúng tôi mong muốn mang lại những sản phẩm tốt, nguồn gốc rõ ràng; những tư vấn hữu ích nhất cho các bạn.</p>

                                <p>Đội ngũ giao hàng chuyên nghiệp, giao hàng nhanh chóng cho bạn những trải nghiệm tốt nhất.</p>

                                <p>Mọi vấn đề thắc mắc, xin liên hệ số điện thoại hotline: 0978 478 178 hoặc gửi thư tới địa chỉ: anhhn@gmail.com</p>
                            </div>
                        </div>
                    </div><!-- /.em-col-main -->
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div>

@endsection
