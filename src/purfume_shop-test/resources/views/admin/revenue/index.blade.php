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
{{-- @include('admin.revenue.search') --}}


@endsection