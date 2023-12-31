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

            <a href="{{ url('wishlist') }}"> 
                Danh Sách Yêu Thích
            </a> 

           

        </h6>
    </div>
</div>

    <div class="container my-5">
        <div class="card shadow ">   
            <div class="card-body">                  
                {{-- Danh Sách Yêu Thích Của Tôi --}}
                @if ($wishlist-> count() > 0)
                

                    
                    @foreach($wishlist as $item)

                    <div class="row product_data">
                        <div class="col-md-2 my-auto mt-3">
                            <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" height="70px" width="70px" alt="Hình ảnh">
                        </div>

                        <div class="col-md-2 my-auto mt-3">
                            <h6> {{ $item->products->name}} </h6>
                        </div>

                        <div class="col-md-2 my-auto mt-3">
                            <h6> {{ number_format($item->products->selling_price)}} VNĐ </h6>
                        </div>

                        <div class="col-md-2 my-auto mt-3">
                            <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">

                            @if($item->products->qty > 0)
                                <h6>{{$item->products->qty}}</h6>
                                <label for="Quantity" hidden> Số lượng </label>
                            <div class="input-group text-center mb-3" hidden style="width: 130px;">
                                <button class="input-group-text decrement-btn"> - </button>
                                <input type="text" name="quantity" class="form-control qty-input text-center" value="1" >
                                <button class="input-group-text increment-btn"> + </button>
                            </div>

                            @else
                                <h6>Hết Hàng</h6>
                            @endif
                        </div>

                        <div class="col-md-2 my-auto mt-3">
                            <button class="btn btn-success addToCartBtn "> <i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ Hàng </button>
                        </div>

                        <div class="col-md-2 my-auto mt-3">
                            <button class="btn btn-danger remove-wishlist-item "> <i class="fa fa-trash"></i> </button>
                        </div>
                    </div>

                    @endforeach
                </div>
           
                
                @else
                    <div class="card-body text-center">
                        <h2 class="card-body text-center"> Không Có Sản Phẩm Nào Trong Danh Sách Yêu Thích </h2>
                        <a href="{{ url('category') }}" class="btn btn-outline-primary float-end"> Mua Sắm Ngay</a>
                    </div>  
                    
                @endif
            </div>  
        </div>
    </div>
    @include('layouts.inc.footer')
@endsection


