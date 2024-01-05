@extends('layouts.front')

@section('title')
    Giỏ Hàng Của Tôi
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
            </a> 

           

        </h6>
    </div>
</div>

    <div class="container my-5">
        <div class="card shadow ">
            @if (count($cartitems) > 0 )
                
                <div class="card-body">

                    @php
                        $total = 0;
                    @endphp

                    @foreach($cartitems as $item)

                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" height="70px" width="70px" alt="Hình ảnh">
                        </div>

                        <div class="col-md-2 my-auto">
                            <h6> {{ $item->products->name}} </h6>
                        </div>

                        <div class="col-md-2 my-auto">
                            <h6> {{ number_format($item->products->selling_price)}}</span> VNĐ </h6>
                        </div>

                        <div class="col-md-2 my-auto">
                            <h6> Hiện Còn {{ $item->products->qty }} Sản Phẩm</h6>
                            <input type="hidden" class="prod_qty" value="{{$item->products->qty }}">
                        </div>

                        <div class="col-md-2 my-auto">
                            <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">

                            @if($item->products->qty >= $item->prod_qty)

                            <label for="Quantity"> Số lượng </label>
                            <div class="input-group text-center mb-3" style="width: 130px;">
                                <button class="input-group-text changeQuantity decrement-btn"> - </button>
                                <input type="text" name="quantity" class="form-control qty-input text-center" value="{{$item->prod_qty}}" >
                                <button class="input-group-text changeQuantity increment-btn"> + </button>
                            </div>

                            @php
                                $total += $item->products->selling_price * $item->prod_qty;
                            @endphp
                            @else
                                <h6>Hết Hàng</h6>
                            @endif
                        </div>

                        <div class="col-md-2 my-auto">
                            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> </button>
                        </div>
                    </div>

                    @endforeach
                </div>
           
                <div class="card-footer">
                    <h6> Tổng tiền: <span class="total_price">{{ number_format($total) }}</span> VNĐ
                    <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end"> Tiếp tục </a>
                    </h6>
                </div>

                @else
                    <div class="card-body text-center">
                        <h2> Chưa Thêm Sản Phẩm Nào Vào Giỏ Hàng</h2>
                        <a href="{{ url('allprod') }}" class="btn btn-outline-primary float-end"> Mua Sắm Ngay</a>
                    </div>

                @endif
        </div>
    </div>
    @include('layouts.inc.footer')
@endsection