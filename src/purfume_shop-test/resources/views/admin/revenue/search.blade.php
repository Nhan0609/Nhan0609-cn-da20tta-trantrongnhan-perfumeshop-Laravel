@extends('layouts.admin')

@section('content')
<form action="{{ route('revenue-search') }}" method="POST">  
    @csrf
    <div class="container">
        <h4>Tra Cứu Doanh Thu</h4>
        <br>
        <div class="row">
            
            <div class="col-md-4">
                <input type="date" value="{{ date('Y-m-d')}}" name="dateA" class="form-control">
            </div>  
            <div class="col-md-4">
                <input type="date" value="{{ date('Y-m-d')}}" name="dateB" class="form-control">
            </div>     
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-sm"> Lọc </button>
            </div>     
        </div>
    </div>
    
</form>  
<br>
<hr>
<h3>Kết Quả Tra Cứu Doanh Thu</h3>

<p>Ngày Bắt Đầu: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Không xác định' }}</p>
<p>Ngày Kết Thúc: {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Không xác định' }}</p>

<p>Doanh Thu: {{ number_format($revenueResults) }} VNĐ</p>

@endsection
