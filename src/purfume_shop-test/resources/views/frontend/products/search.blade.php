@extends('layouts.front')

@section('title')
    Kết Quả Tìm Kiếm
@endsection

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Kết Quả Tìm Kiếm Của "{{ $keywords }}"</h2>
            <div class="owl-carousel featured-carousel owl-theme">
                @if($search_product->count() > 0)
                        @foreach($search_product as $product)
                            <div class="item mt-3">
                                <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}">
                                    <div class="card">
                                        <img src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Ảnh Sản Phẩm">
                                        <div class="card-body">
                                            <h5>{{ $product->name }}</h5>
                                            <span class="float-start">{{ $product->selling_price }}</span>
                                            <span class="float-end"> <s> {{ $product->original_price }} </s> </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
            {{ $search_product->links() }}
                @else
                    <p>No results found.</p>
                @endif
            </div> 
        </div>
    </div>
</div>   
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