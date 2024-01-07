@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Trang Chủ</h4>
        <hr>
    </div>

    
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                </div>
            </thead>
            <tbody>
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ">
                                            Doanh thu
                                        </div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                        {{ number_format($totalPrice) }} VNĐ
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1 ">
                                            Tổng số đơn hàng
                                        </div>
                                        
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                            {{ $totalOrder }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Số Đơn Đã Thanh Toán
                                        </div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                            {{ $done }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Số Đơn Đã Giao
                                        </div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                            {{ $delivered }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Số Đơn Đang Giao
                                        </div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                            {{ $delivering }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Số đơn chờ xác nhận</div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                        {{ $handing }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4 ">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Số đơn hủy</div>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-5 " style="font-size: 25px">
                                        {{ $cancelorder }} Đơn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </tbody>
        </table>
    </div>
</div>
@endsection