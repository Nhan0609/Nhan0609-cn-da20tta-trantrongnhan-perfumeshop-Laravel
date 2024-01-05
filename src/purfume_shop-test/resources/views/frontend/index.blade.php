@extends('layouts.front')

@section('title')
    Welcome to Perfume Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    @include('interact.interface')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Mới</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($newProducts as $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span> 
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                    <h5> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        {{ $prod->view_count }} Lượt Xem
                                    </h5>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>
    


    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Danh Mục</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($trending_category as $tcategory)
                        <div class="item">
                            <a href="{{ url('category/'.$tcategory->slug)}}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/'.$tcategory->image) }}" alt="Ảnh Danh Mục Trending">
                                    <div class="card-body">
                                        <h5>{{ $tcategory->name }}</h5>
                                        <p>
                                            {{ $tcategory->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Thịnh Hành</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($featured_products as $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span> 
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                    <h5> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        {{ $prod->view_count }} Lượt Xem
                                    </h5>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>

        
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Nhiều Lượt Xem</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($productsRecommend->take(6) as $keyRecommend => $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span>
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                    <h5> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        {{ $prod->view_count }} Lượt Xem
                                    </h5>
                                </div>
                            </a>
                        </div> 
                    @endforeach
                </div> 
            </div>
        </div>
    </div>   

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Sản Phẩm Bodycare</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($productbodycare as $prod)
                        <div class="item">
                            <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                    <div class="card-body">
                                        <h5>{{ $prod->name }}</h5>
                                        <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span> 
                                        <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ </s> </span>
                                    </div>
                                    <h5> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                        {{ $prod->view_count }} Lượt Xem
                                    </h5>
                                </div>
                            </a>
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