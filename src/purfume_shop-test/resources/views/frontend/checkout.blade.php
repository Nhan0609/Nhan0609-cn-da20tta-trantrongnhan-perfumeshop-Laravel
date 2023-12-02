@extends('layouts.front')

@section('title')
    Thanh Toán
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">

            <a href="{{ url('/home') }}">
                 Trang Chủ
            </a> /

            <a href="{{ url('cart') }}"> 
                Giỏ Hàng
            </a> /

            <a href="{{ url('checkout')}}">
                Đặt Hàng
           </a>

        </h6>
    </div>
</div>

    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Chi tiết</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">Họ</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="fname" placeholder="Nhập Họ">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Tên</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->lname }}" name="lname" placeholder="Nhập Tên">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email" placeholder="Nhập Email">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Số Điện Thoại</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="phone" placeholder="Nhập Số Điện Thoại">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 1</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address1 }}" name="address1" placeholder="Nhập Địa Chỉ 1">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 2</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address2 }}" name="address2" placeholder="Nhập Địa Chỉ 2">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Thành Phố</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->city }}" name="city" placeholder="Nhập Tên Thành Phố">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Tỉnh</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->state }}" name="state" placeholder="Nhập Tình Trạng">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Quốc Gia</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->country }}" name="country" placeholder="Nhập Quốc Gia">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Nhập mã PIN</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Nhập Mã PIN">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Chi tiết đặt hàng</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> Tên </th>
                                        <th> Số Lượng </th>
                                        <th> Giá </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartitems as $item)
                                        <tr>
                                            <td> {{ $item -> products-> name}} </td>
                                            <td> {{ $item -> prod_qty }} </td>
                                            <td> {{ $item -> products-> selling_price }} </td>
                                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary float-end">Đặt Hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection