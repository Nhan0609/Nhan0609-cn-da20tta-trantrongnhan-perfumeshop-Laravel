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
                            @if (Auth::check())
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
                                    <input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="phone" required placeholder="Nhập Số Điện Thoại">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 1</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address1 }}" required name="address1" placeholder="Nhập Địa Chỉ 1">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 2</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address2 }}" required name="address2" placeholder="Nhập Địa Chỉ 2">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Thành Phố</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->city }}" required name="city" placeholder="Nhập Tên Thành Phố">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Tỉnh</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->state }}" required name="state" placeholder="Nhập Tỉnh">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Quốc Gia</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->country }}" required name="country" placeholder="Nhập Quốc Gia">
                                </div>

                                {{-- <div class="col-md-6 mt-3">
                                    <label for="">Nhập mã PIN</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->pincode }}" required name="pincode" placeholder="Nhập Mã PIN">
                                </div> --}}

                            </div>
                            @else
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">Họ</label>
                                    <input type="text" class="form-control" value="" name="name" placeholder="Nhập Họ">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Tên</label>
                                    <input type="text" class="form-control" value="" name="lname" placeholder="Nhập Tên">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="" name="email" placeholder="Nhập Email">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Số Điện Thoại</label>
                                    <input type="text" class="form-control" value="" name="phone" required placeholder="Nhập Số Điện Thoại">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 1</label>
                                    <input type="text" class="form-control" value="" required name="address1" placeholder="Nhập Địa Chỉ 1">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Địa Chỉ 2</label>
                                    <input type="text" class="form-control" value="" required name="address2" placeholder="Nhập Địa Chỉ 2">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Thành Phố</label>
                                    <input type="text" class="form-control" value="" required name="city" placeholder="Nhập Tên Thành Phố">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Tỉnh</label>
                                    <input type="text" class="form-control" value="" required name="state" placeholder="Nhập Tỉnh">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Quốc Gia</label>
                                    <input type="text" class="form-control" value="" required name="country" placeholder="Nhập Quốc Gia">
                                </div>

                                {{-- <div class="col-md-6 mt-3">
                                    <label for="">Nhập mã PIN</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->pincode }}" required name="pincode" placeholder="Nhập Mã PIN">
                                </div> --}}

                            </div> 
                            @endif
                            
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-5">
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
                                            <td> {{ number_format($item -> products-> selling_price) }} VNĐ</td>

                                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div>Tổng Thanh Toán: {{ number_format($total) }} VNĐ</div>
                            <button type="submit" class="btn btn-primary float-end">Đặt Hàng</button>
                        </div>
                    </div>
                </div> --}}
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
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($cartitems as $item)
                                        <tr>
                                            <td> {{ $item->products->name }} </td>
                                            <td> {{ $item->prod_qty }} </td>
                                            <td> 
                                                {{ number_format($item->products->selling_price) }} VNĐ
                                                @php
                                                    $total += $item->products->selling_price * $item->prod_qty;
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            {{-- Tổng thanh toán --}}
                            @if ($total > 0)
                                <div>Tổng Thanh Toán: <b> {{ number_format($total) }} VNĐ </b> </div>
                            @endif 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-7 mt-3">
                                        {{-- <label class="float-end mb-2" for="payment_type">Hình Thức Thanh Toán</label>
                                        <select class="form-control float-end" name="payment_type">
                                            <option value="COD">Thanh toan tiem mat</option>
                                            <option value="VNP">Vi VN Pay</option>
                                        </select> --}}
                                        <label class="mt-3" for="payment_type"><b>Hình Thức Thanh Toán</b></label>
                                        <select class="form-select mt-1" aria-label="Default select example" name="payment_type">
                                            {{-- <option selected>Chọn Hình Thức Thanh Toán</option> --}}
                                            <option value="COD">Thanh Toán Khi Nhận Hàng</option>
                                            <option value="VNP">Thanh Toán Bằng Ví VNPAY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mt-5 float-end">Thanh Toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    @include('layouts.inc.footer')
@endsection