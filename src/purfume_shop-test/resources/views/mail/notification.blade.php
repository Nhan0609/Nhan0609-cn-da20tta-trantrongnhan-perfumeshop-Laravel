<div style="width: 600px; margin: 0 auto">
    <div>
        <h1>{{$name}}</h1>

        <h2>Xin chào, {{ Auth::user()->address1 }}</h2>

        <p>Bạn đã đặt hàng tại hệ thống của chúng tôi, vui lòng kiểm tra lại đơn hàng của bạn.</p>
    </div>  

    <div class="col-md-6">
        <hr>
            <h3>Người đặt hàng: </h3>
            <table border="1" cellspacing="0" style="width: 100%;">
                <tr>
                    <th>Tên</th>
                    <td>{{ Auth::user()->lname }}</td>
                </tr>

                <tr>
                    <th>Mail</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>

                <tr>
                    <th>Số Điện Thoại</th>
                    <td>{{ Auth::user()->phone }}</td>
                </tr>

                <tr>
                    <th>Địa chỉ</th>
                    <td>
                        Địa Chỉ Nhận Hàng: {{ Auth::user()->address1 }}, <br>
                        {{ Auth::user()->address2 }}, <br>
                        Thành Phố: {{ Auth::user()->city }}, <br>
                        Tỉnh: {{ Auth::user()->state }}, <br>
                        Quốc Gia: {{ Auth::user()->country }},    
                    </td>
                </tr>
            </table>
        </div>
    </div>

        <div class="col-md-8">
            <hr>
                <h3>Thông Tin Đơn Hàng: </h3>
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá Giảm</th>  
                                <th>Số Lượng</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($order_item as $item)
                                <tr>
                                    <td> {{$order }} </td>
                                    <td> {{}} </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>   
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <b>Tổng Thanh Toán: {{}}</b>
        </div>
    </div>
</div>
