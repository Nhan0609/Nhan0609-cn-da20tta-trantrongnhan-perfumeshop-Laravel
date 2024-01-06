@extends('layouts.front')

@section('title', $products->name)
    
@section('content')
    
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{url('home')}}">Trang Chủ</a> / 

                <a href="{{ url('category') }}">
                     Bộ Sưu Tập
                </a> /

                <a href="{{ url('category/'.$products->category->slug) }}"> 
                    {{ $products->category->name}}
                </a> /

                <a href="{{ url('category/'.$products->category->slug.'/'.$products->slug) }}">
                    {{ $products->name}}
                </a>
                {{-- Bộ sưu tập / {{ $products->category->name }} / {{$products->name}} </h6> --}}
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <h2 class="mb-0">
                            {{ $products->name }}
                            @if($products->trending == '1')
                                <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending </label>
                            @endif
                        </h2>
                
                    <div class="col-md-6 mb-4 mt-3 border-right">
                        <div class="anhsanpham">
                            <div class="main">
                                <img src="{{ asset('assets/uploads/products/'.$products->image) }}" class="anhsanphamchinh" alt="">
                            </div>
                                <br>
                                <br>
                                <h3>Ảnh Chi Tiết</h3>
                                <div class="detail">
                                    <div class="row">
                                        @if($products->multiple_images->count() > 0)
                                            @foreach ($products->multiple_images as $img_detail)
                                                <div class="col-md-4 mt-3">
                                                    <img src="{{ asset('assets/multiple_image/products/'.$img_detail->image_path) }}" alt="Ảnh chi tiết sản phẩm">
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Không Có Ảnh Chi Tiết Cho Sản Phẩm Này.</p>
                                        @endif
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        

                        <hr>
                        <label class="me-3">Giá Gốc: <s> {{ number_format($products->original_price) }}</s></label>
                        <label class="fw-bold">Giảm Còn: {{ number_format($products->selling_price) }}</label>
                        <p class="mt-3">
                            <div class="col-md-5">
                            {!! $products->small_description !!}
                            </div>

                            <div class="col-md-5 mt-3">
                                Có Sẵn <b>{{ $products->qty }}</b> Sản Phẩm
                                <input type="hidden" value="{{ $products->qty }}" class="prod_qty">
                            </div>
                        </p>

                        

                        <hr>
                    @if($products->qty > 0)
                        <label class="bagde bg-success text-white">Còn Hàng</label>
                    @else
                        <label class="bagde bg-danger text-white">Hết Hàng</label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <input type="hidden" value="{{ $products->id }}" class="prod_id"> 
                            <label for="Quantity">Số lượng</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text decrement-btn"> - </button>
                                <input type="text" name="quantity " class="form-control qty-input text-center" value="1" >
                                <button class="input-group-text increment-btn"> + </button>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <br>

                        @if($products->qty > 0)
                            
                            <button type="button" class="btn btn-success me-3 addToCartBtn float-start">Mua Ngay <i class="fa fa-shopping-cart"></i></button>
                            {{-- <button class="btn btn-success addToCartBtn "> <i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ Hàng </button> --}}
                        
                        @endif

                            
                            <button type="button" class="btn btn-primary me-3 addToWishlist float-start">Thêm Vào Yêu Thích <i class="fa fa-heart"></i></button>
                        </div>
                    </div>
                    </div>
                    
                    {{-- <div class="col-md-12">
                       <h3> Chi Tiết Sản Phẩm</h3>
                        {!! $products->description !!}

                        
                    </div> --}}

                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 140px;">
                            Chi tiết sản Phẩm
                            </button>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text">{!! $products->description !!}</span></li>
                            
                            </ul>
                        </div>

                </div>
            </div>
            
        </div>
    </div>
    @include('layouts.inc.footer')
@endsection

