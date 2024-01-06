@extends('layouts.front')

@section('title')
    Đơn Đặt Hàng Của Tôi
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('home')}}">Trang Chủ</a> / 
            <a href="{{ url('my-orders') }}"> Đơn Hàng </a> 
        </h6>
    </div>
</div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-primary">
                        <h4>Đơn Hàng Của Tôi</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tracking Number</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Xử Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ number_format($item->total_price) }}VNĐ</td>
                                        <td>
                                            @if ($item->status == '0') 
                                                Chưa Xử Lý
                                            @elseif ($item->status == '3') 
                                                Đã Thanh Toán
                                            @elseif ($item->status == '1') 
                                                Đang Giao Hàng
                                            @elseif ($item->status == '2') 
                                                Đã Giao Hàng
                                            @elseif ($item->status == '-1') 
                                                Đã Hủy
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('view-order/'.$item->id)}}" class="btn btn-primary">Xem</a>
                                        </td>
                                    </tr> 
        
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    @include('layouts.inc.footer')
@endsection