@extends('layouts.admin')

@section('title')
    Đơn Đặt Hàng
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Lịch Sử Đơn Hàng
                        <a href="{{ 'orders' }} " class="btn btn-warning float-right"> Đơn Hàng Mới</a>
                    </h4>
                </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tracking Number</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Hình Thức Thanh Toán</th>
                                    <th>Xử Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)

                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ number_format($item->total_price) }} VNĐ </td>
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
                                            @if ($item->status == '-1')
                                                Đã Hủy
                                            @elseif ($item->status == '2' && $item->message == 'COD') 
                                                Tiền mặt
                                            @elseif ($item->message == 'COD') 
                                                Thanh Toán Khi Nhận Hàng
                                            @elseif ($item->message == 'VNP') 
                                                Ví Điện Tử VNPay
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/view-order/'.$item->id)}}" class="btn btn-primary">Xem</a>
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
    
@endsection