@extends('layouts.front')

@section('title')
    Tất Cả Sản Phẩm
@endsection

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2 class="chopchop text-center">Danh sách Sản Phẩm</h2>
            <div class="row">
                @foreach ($allProducts as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card md-4 mt-3">
                            <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Ảnh Sản Phẩm">
                                <div class="row">
                                    @if($product->multiple_images->count() > 0)
                                        @foreach ($product->multiple_images as $img_detail)
                                            <div class="col-md-4 mt-3">
                                                <img style="width: 100px" height="100px" src="{{ asset('assets/multiple_image/products/'.$img_detail->image_path) }}" alt="Ảnh chi tiết sản phẩm">
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Không Có Ảnh Chi Tiết Cho Sản Phẩm Này.</p>
                                    @endif
                                </div>
                                <div class="card-body">
                                                                       
                                    <h5>{{ $product->name }}</h5>

                                    <h5>Danh Mục: {{ $product->category->name }}</h5>
                                    
                                    <span class="float-start">{{ number_format($product->selling_price) }} VNĐ</span>
                                    <span class="float-end"> <s> {{ number_format($product->original_price) }} VNĐ</s> </span>
                                    
                                </div>
                                <div class="float-start mt-3">                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                    {{ $product->view_count }} Lượt Xem                                
                                </div>
                                
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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