@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')          

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{url('home')}}">Trang Chủ</a> / 
                <a href="{{ url('category') }}"> Bộ Sưu Tập </a> /
               <a href=""> {{ $category->name }} </a> 
            </h6>
        </div>
    </div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <h2>{{ $category->name }}</h2>
                        @foreach($products as $prod)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <a href="{{url( 'category/'.$category->slug.'/'.$prod->slug )}}">
                                    <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="Ảnh Sản Phẩm">
                                        <div class="card-body">
                                            <h5>{{ $prod->name }}</h5>
                                            <span class="float-start">{{ number_format($prod->selling_price) }} VNĐ</span>
                                            <span class="float-end"> <s> {{ number_format($prod->original_price) }} VNĐ</s> </span>
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