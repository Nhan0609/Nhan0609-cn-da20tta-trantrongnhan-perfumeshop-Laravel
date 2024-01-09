@extends('layouts.front')

@section('title')
    Welcome to Perfume Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary ">
                    <h4> Chi Tiết Thông Tin 
                        <a href="{{ url('/') }}" class="btn btn-primary btn-sm float-end"> Trở Về </a>
                        
                    </h4>
                    <hr>
                </div>
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Thay đổi mật khẩu
                    </button> --}}
                    <a class="btn btn-primary btn-sm" href="{{url('/change_password')}}">Thay Đổi Mật Khẩu</a>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for=""> Vai Trò </label>
                            <div class="p-2 border">{{ auth()->user()->role_as == '0' ? 'Người Dùng' : 'Admin' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Họ </label>
                            <div class="p-2 border">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Tên </label>
                            <div class="p-2 border">{{ auth()->user()->lname }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Email </label>
                            <div class="p-2 border">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Số Điện Thoại </label>
                            <div class="p-2 border">{{ auth()->user()->phone }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Địa Chỉ 1 </label>
                            <div class="p-2 border">{{ auth()->user()->address1 }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Địa Chỉ 2 </label>
                            <div class="p-2 border">{{ auth()->user()->address2 }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Thành Phố </label>
                            <div class="p-2 border">{{ auth()->user()->city }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Tỉnh </label>
                            <div class="p-2 border">{{ auth()->user()->state }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Quốc Gia </label>
                            <div class="p-2 border">{{ auth()->user()->country }}</div>
                        </div>

                        {{-- <div class="col-md-4">
                            <label for=""> Mã Pin </label>
                            <div class="p-2 border">{{ auth()->user()->pincode }}</div>
                        </div> --}}
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal change password -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi Mật Khẩu</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <label>Mật Khẩu Hiện Tại</label>
                        <div class="form-group pass_show"> 
                            <input type="password" value="" class="form-control" style="font-size: 15px" placeholder="Nhập mật khẩu hiện tại"> 
                        </div> 
                        <label>Mật Khẩu Mới</label>
                        <div class="form-group pass_show"> 
                            <input type="password" value="" class="form-control" style="font-size: 15px" placeholder="Nhập mật khẩu mới"> 
                        </div> 
                        <label>Nhập Lại Mật Khẩu</label>
                        <div class="form-group pass_show"> 
                            <input type="password" value="" class="form-control" style="font-size: 15px" placeholder="Xác nhận mật khẩu mới"> 
                        </div> 
                        
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary">Lưu</button>
            </div>
        </div>
        </div>
    </div>
</div> --}}

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
