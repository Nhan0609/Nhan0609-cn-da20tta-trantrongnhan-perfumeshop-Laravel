@extends('layouts.front')

@section('title')
    Đơn Đặt Hàng Của Tôi
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Đơn Hàng Của Tôi
                            <a href="{{ url()->previous() }}" class="btn btn-warning text-white float-end"> Trở Lại</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4> Chi tiết Vận Chuyển</h4>
                                <hr>
                                <label for="">Họ</label>
                                <div class="border">{{ $orders->fname }}</div>
                                <label for="">Tên</label>
                                <div class="border">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="border">{{ $orders->email }}</div>
                                <label for="">Số Điện Thoại</label>
                                <div class="border">{{ $orders->phone }}</div>
                                <label for="">Địa Chỉ Giao Hàng</label>
                                <div class="border">
                                Địa Chỉ 1: {{ $orders->address1 }}, <br>
                                Địa Chỉ 2: {{ $orders->address2 }}, <br>
                                Thành Phố: {{ $orders->city }}, <br>
                                Tỉnh: {{ $orders->state }},
                                Quốc Gia: {{ $orders->country }},
                                </div>
                                <label for="">Hình Thức Đặt Hàng: </label>
                                <div class="border">
                                    @if ($orders->message == 'COD') 
                                        Thanh Toán Khi Nhận Hàng
                                    @elseif ($orders->message == 'VNP') 
                                        Ví Điện Tử VNPay
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <h4>Chi Tiết Đơn Hàng</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Số Lượng</th>
                                            <th>Giá</th>
                                            <th>Hình Ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders->orderitems as $item)
                                        
                                            <tr>
                                                <td>{{ $item->products->name }} </td>
                                                <td>{{ $item->qty }} </td>
                                                <td>{{ number_format($item->price) }} VNĐ </td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" width="50px" alt="Ảnh Sản Phẩm">
                                                </td>
                                            </tr> 
                
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2"> Tổng Cộng: <span class="float-end">{{ number_format($orders->total_price) }} VNĐ </span></h4>
                                <div class="mt-5 px-2">
                                    <label for="">Tình Trạng Đặt Hàng</label>
                                    <form action="{{ url('update-order/'.$orders->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name="order_status" >
                                            @if($orders->status == '0')
                                            <option {{ $orders->status == '0'? 'selected':'' }} value="0"> Chưa Xử Lý </option>
                                            @endif
                                            
                                            @if($orders->status == '3' || ($orders->status == '1'  && $orders->message == 'COD'))
                                            <option {{ $orders->status == '3'? 'selected':'' }} value="3"> Đã Thanh Toán </option>
                                            @endif

                                            @if($orders->status == '0' || $orders->status == '1' || ($orders->status == '3' && $orders->message != 'COD'))
                                            <option {{ $orders->status == '1'? 'selected':'' }} value="1"> Đang Giao Hàng </option>
                                            @endif

                                            @if($orders->status == '2' || ($orders->status == '1'  && $orders->message != 'COD') 
                                                                        || ($orders->status == '3' && $orders->message == 'COD'))
                                            <option {{ $orders->status == '2'? 'selected':'' }} value="2"> Đã Giao Hàng </option>
                                            
                                            @endif

                                            @if($orders->status != '2')
                                            <option {{ $orders->status == '-1'? 'selected':'' }} value="-1"> Hủy đơn hàng </option>
                                            @endif
                                        </select>
                                        
                                        @if($orders->status != '2' && $orders->status != '-1')
                                        <button type="submit" class="btn btn-primary float-end mt-3"> Cập Nhật </button>
                                        @endif

                                        @if($orders->status == '2' )
                                            <a href="#" class="btn btn-primary float-end mt-3">In Hóa Đơn</a>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>


@endsection