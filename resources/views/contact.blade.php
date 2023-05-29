@extends('layouts.master_home')

@section('title')
    Liên hệ - Functional Food Store
@endsection

@section('css')
    <!-- Blog Style CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/blog-styles.css')}}"/>
@endsection

@section('home')

<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-wrapper-area02"></div>
            <div class="em-main-container em-col2-left-layout">
                <div class="row">
                    <div class="em-col-main col-sm-24">
                    
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1423582762823!2d105.83637835002351!3d20.98692989451333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac67a2b03f19%3A0xd0b09d018f61dfb4!2zUGjhu5EgTmd1eeG7hW4gVsSDbiBUcuG7l2ksIFBoxrDGoW5nIExp4buHdCwgVGhhbmggWHXDom4sIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1606063045341!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        <div class="row" style="margin-top : 50px; margin-bottom : 50px;">
                            
                            <div class="col-sm-12" style="line-height : 28px; padding-top : 25px;">
                                <div class="em-maps-wrapper" style="margin-b : 25px; padding-bottom : 25px;">
                                    <h1>Cửa hàng thưc phẩm chức năng Functional Food Store</h1>
                                </div>

                                <address><span class="fa fa-map-marker secondary2">&nbsp;</span>Địa chỉ: phố Nguyễn Văn Trỗi, Phường Mộ Lao, Quận Hà Đông, Hà Nội </address>
                                
                                <p class="em-phone"><span class="fa fa-user-md secondary2">&nbsp;</span>Phụ trách chuyên môn: <span class="primary">Hoàng Ngọc Ánh</span>
                                </p>

                                <p class="em-phone"><span class="fa fa-phone secondary2">&nbsp;</span>Điện thoại: <span class="primary"> 0978 478 178</span>
                                </p>
                                
                                <p class="em-email"><span class="fa fa-envelope secondary2">&nbsp;</span>Email: <span class="secondary2">anhhn@gmail.com</span>
                                </p>
                            </div><!-- /.col-sm-12 -->

                            <div class="col-sm-12">
                                <div class="error-message-contact" style="display:none; font-size:14px; font-weight: 500; line-height: 28px;">
                                    <ul style="color : #0000FF;"></ul>
                                </div>

                                <div class="alert success-message-contact" style="display:none; font-size:14px; color : #32ca00; font-weight: 500; line-height: 28px;">
                                    <ul></ul>
                                </div>

                                <div class="alert unsuccess-message-contact" style="display:none; font-size:14px; color : #0000FF; font-weight: 500; line-height: 28px;">
                                    <ul style="color : #0000FF;"></ul>
                                </div>
                                <form id="contactForm">
                                    @csrf
                                    <div class="fieldset">
                                        <ul class="form-list">
                                            <li style="margin-top : 20px;">
                                                <label for="name" class="required"><em>*</em>Tên của bạn</label>
                                                <div class="input-box">
                                                    <input name="name" id="name" value="" class="input-text required-entry" type="text" />
                                                </div>
                                            </li>

                                            <li style="margin-top : 20px;">
                                                <label for="email" class="required"><em>*</em>Email</label>
                                                <div class="input-box">
                                                    <input name="email" id="email" value="" class="input-text required-entry validate-email" type="text" />
                                                </div>
                                            </li>
                                            
                                            <li class="wide" style="margin-top : 20px;">
                                                <label for="content" class="required"><em>*</em>Nội dung</label>
                                                <div class="input-box">
                                                    <textarea name="content" id="content" class="required-entry input-text" cols="5" rows="3"></textarea>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="buttons-set">
                                        <button type="button" class="button btn-contact" style="font-size : 14px; width : 100px;">GỬI
                                        </button>
                                    </div>
                                </form><!-- /#contactForm -->
                            </div><!-- /.col-sm-12 -->
                        </div>
                    </div>
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div>
<script>
    $('.btn-contact').click(function(){
        var form_data = new FormData();
        form_data.append("_token", '{{csrf_token()}}');
        form_data.append("name", $('#name').val());
        form_data.append("email", $('#email').val());
        form_data.append("content", $('#content').val());
        $.ajax({
            type : 'post',
            url : '/lien-he',
            data : form_data,
            dataType : 'json',
            contentType: false,
            processData: false,
            success : function(response){
                if(response.is === 'failed'){
                    $(".error-message-contact").find("ul").html('');
                    $(".error-message-contact").css('display','block');
                    $(".success-message-contact").css('display','none');
                    $(".unsuccess-message-contact").css('display','none');

                    $.each(response.error, function( key, value ) {
                        $(".error-message-contact").find("ul").append('<li><i class="fa fa-exclamation-triangle" style="color: #ff0000;"></i> '+value+'</li>');
                    });

                    window.scroll({
                        top: 500,
                        behavior: 'smooth'
                    });
                }
                if(response.is === 'success'){
                    $(".success-message-contact").find("ul").html('');
                    $(".success-message-contact").css('display','block');
                    $(".error-message-contact").css('display','none');
                    $(".unsuccess-message-contact").css('display','none');

                    $(".success-message-contact").find("ul").append('<li><i class="fa fa-check"></i> '+response.complete+'</li>');
                    
                    window.scroll({
                        top: 500,
                        behavior: 'smooth'
                    });
                }
                if(response.is === 'unsuccess'){
                    $(".unsuccess-message-contact").find("ul").html('');
                    $(".unsuccess-message-contact").css('display','block');
                    $(".error-message-contact").css('display','none');
                    $(".success-message-contact").css('display','none');

                    $(".unsuccess-message-contact").find("ul").append('<li><i class="fa fa-exclamation-triangle"></i> '+response.uncomplete+'</li>');
                    
                    window.scroll({
                        top: 500,
                        behavior: 'smooth'
                    });
                }
            }

        });
    })
</script>
@endsection
