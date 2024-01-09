@extends('layouts.front')

@section('title')
    Đổi Mật Khẩu
@endsection

@section('content')
    @include('layouts.inc.slider')
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary ">
                    <h4> Đổi Mật Khẩu
                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm float-end"> Trở Về </a>
                        
                    </h4>
                    <hr>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="POST" onsubmit="return false;" id="formChangePass">
                                    <div class="form-group small-text">
                                        <label for="user_signin">Mật khẩu cũ</label>
                                        <input type="password" class="form-control" id="old_pass">
                                    </div>
                                    <div class="form-group small-text">
                                        <label for="user_signin">Mật khẩu mới</label>
                                        <input type="password" class="form-control" id="new_pass">
                                    </div>
                                    <div class="form-group small-text">
                                        <label for="user_signin">Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control" id="re_new_pass">
                                    </div>
                                    <button class="btn btn-primary" id="submit_change_pass">
                                        <span class="glyphicon glyphicon-ok"></span> Thay đổi
                                    </button>
                                    <br><br>
                                    <div class="alert alert-danger hidden"></div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>




@include('layouts.inc.footer')
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endsection                    
<!-- ... Các phần khác của trang ... -->

{{-- @section('scripts')
    <script>
        $(document).ready(function () {
            // Lắng nghe sự kiện khi nút "Thay đổi" được nhấn
            $('#submit_change_pass').click(function () {
                // Lấy giá trị mật khẩu cũ, mật khẩu mới và xác nhận mật khẩu mới
                var oldPassword = $('#old_pass').val();
                var newPassword = $('#new_pass').val();
                var reNewPassword = $('#re_new_pass').val();

                // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu mới có giống nhau không
                if (newPassword !== reNewPassword) {
                    $('.alert-danger').html('Mật khẩu mới và xác nhận mật khẩu mới không khớp.').removeClass('hidden');
                    return;
                }

                // Gửi dữ liệu đổi mật khẩu thông qua Ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/change_password') }}', // Thay đổi route theo đúng định dạng của ứng dụng Laravel của bạn
                    data: {
                        old_password: oldPassword,
                        new_password: newPassword,
                        _token: '{{ csrf_token() }}' // Sử dụng CSRF token để bảo vệ khỏi tấn công CSRF
                    },
                    success: function (data) {
                        // Xử lý kết quả từ máy chủ
                        if (data.success) {
                            $('.alert-danger').addClass('hidden');
                            alert('Đổi mật khẩu thành công!');
                        } else {
                            $('.alert-danger').html('Mật khẩu cũ không đúng. Vui lòng thử lại.').removeClass('hidden');
                        }
                    },
                    error: function () {
                        // Xử lý lỗi Ajax
                        $('.alert-danger').html('Đã có lỗi xảy ra. Vui lòng thử lại sau.').removeClass('hidden');
                    }
                });
            });
        });
    </script>
@endsection --}}
