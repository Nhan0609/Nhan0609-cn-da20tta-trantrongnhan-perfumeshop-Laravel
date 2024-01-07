@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Chi Tiết Thông Tin 
                        <a href="{{url('users')}}" class="btn btn-primary btn-sm float-right"> Trở Về </a>
                        </h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 mt-3">
                                <label for=""> Vai Trò </label>
                                <div class="p-2 border">{{$users-> role_as == '0'? 'Người Dùng':'Admin' }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Họ </label>
                                <div class="p-2 border">{{$users-> name }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Tên </label>
                                <div class="p-2 border">{{$users-> lname }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Email </label>
                                <div class="p-2 border">{{$users-> email }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Số Điện Thoại </label>
                                <div class="p-2 border">{{$users-> phone }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Địa Chỉ 1 </label>
                                <div class="p-2 border">{{$users-> address1 }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Địa Chỉ 2 </label>
                                <div class="p-2 border">{{$users-> address2 }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Thành Phố </label>
                                <div class="p-2 border">{{$users-> city }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Tỉnh </label>
                                <div class="p-2 border">{{$users-> state }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""> Quốc Gia </label>
                                <div class="p-2 border">{{$users-> country }}</div>
                            </div>

                            {{-- <div class="col-md-4 mt-3">
                                <label for=""> Mã Pin </label>
                                <div class="p-2 border">{{$users-> pincode }}</div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection