@extends('layouts.front')

@section('title')
    Bảng Báo Giá
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-primary">Bảng Báo Giá</h4>
        <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Giá Gốc</th>
                    <th>Giá Giảm</th>  
                    <th>Số Lượng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                    <tr>
                        <td>
                            <a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">
                            <img src="{{ asset('assets/uploads/products/'.$item->image) }}" alt="Ảnh Sản Phẩm" style="width: 100px; height: 100px;">
                            </a>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ optional($item->category)->name }}</td>
                        <td><span><s>{{ number_format($item->original_price) }} VNĐ</s></span></td>
                        <td><b> {{ number_format($item->selling_price) }} VNĐ </b></td>
                       
                        @if( $item->qty == 0)
                            <td>Hết Hàng</td>
                        @else
                            <td>Còn {{ $item->qty }} Sản Phẩm</td>
                        @endif 
                        <td><a class="btn btn-primary btn-sm" href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">Xem Sản Phẩm</a></td>   
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layouts.inc.footer')
@endsection
