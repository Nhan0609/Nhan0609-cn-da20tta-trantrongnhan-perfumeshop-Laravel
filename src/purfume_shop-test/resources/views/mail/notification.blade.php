<div style="width: 600px; margin: 0 auto">
    <div>
        <h1>{{$name}}</h1>

        <h2>Xin chào, {{ Auth::user()->lname }}</h2>

        <p>Bạn đã đặt hàng tại hệ thống của chúng tôi, vui lòng kiểm tra lại đơn hàng của bạn.</p>
    </div>  

    <div class="col-md-6">
        <hr>
        <h2>Thông tin người đặt hàng</h2>
                <div>Tên người đặt: {{ Auth::user()->lname }}</div>
                <div>Mail liên lạc:{{ Auth::user()->email }} </div>
                <div>Số Điện Thoại: {{ Auth::user()->phone }}</div>
                <div>
                    Địa Chỉ Nhận Hàng: {{ Auth::user()->address1 }}, {{ Auth::user()->city }}, {{ Auth::user()->country }}
                </div>
                <div>
                    Địa Chỉ Bổ Sung: {{ Auth::user()->address2 }}, {{ Auth::user()->city }}, {{ Auth::user()->country }}
                </div>
            </tr>
        </table>
    </div>
    <div class="col-md-8">
        <hr>
        <h2>Thông Tin Đơn Hàng</h2>
        <div class="card-body">
            <table border="1" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_item as $item)
                        <tr>
                            <td> {{$item->products->name}} </td>
                            <td> {{$item->qty}}</td>
                            <td> {{number_format($item->price)}} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h3>Tổng Tiền: {{number_format($order->total_price)}} VNĐ</h3>
    </div>
</div>
