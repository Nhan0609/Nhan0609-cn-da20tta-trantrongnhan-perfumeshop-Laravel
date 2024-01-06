@extends('layouts.admin')

@section('content')
<form action="{{ route('revenue-search') }}" method="POST">  
    @csrf
    <div class="container">
        <h4>Tra Cứu Doanh Thu</h4>
        <br>
        <div class="row">
            
            <div class="col-md-4">
                <input type="date" value="{{ $startDate }}" name="dateA" class="form-control">
            </div>  
            <div class="col-md-4">
                <input type="date" value="{{ $endDate }}" name="dateB" class="form-control">
            </div>     
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-sm"> Lọc </button>
            </div>     
        </div>
    </div>
    
</form>  
<br>
<hr>

<div class="container">
    <h3>Kết Quả Tra Cứu Doanh Thu</h3>
    <p>Ngày Bắt Đầu: <b>{{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Không xác định' }}</b></p>
    <p>Ngày Kết Thúc: <b>{{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Không xác định' }}</b></p>

    <p>Doanh Thu: <b>{{ number_format($revenueResults) }}</b> VNĐ</p>

</div>
@endsection
