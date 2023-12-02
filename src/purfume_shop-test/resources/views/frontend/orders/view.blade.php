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
                            <a href="{{ url('my-orders') }}" class="btn btn-warning text-white float-end"> Trở Lại</a>
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
                                    {{ $orders->address1 }}, <br>
                                    {{ $orders->address2 }}, <br>
                                    {{ $orders->city }}, <br>
                                    {{ $orders->state }},
                                    {{ $orders->country }},
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border">{{ $orders->pincode }}</div>
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
                                                <td>{{ $item->price }} </td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" width="50px" alt="Ảnh Sản Phẩm">
                                                </td>
                                            </tr> 
                
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2"> Tổng Cộng: <span class="float-end">{{ $orders->total_price }} </span></h4>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>


@endsection