@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thông Tin Users</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vai Trò</th>
                        <th>Tên</th>
                        <th>Gmail</th>
                        <th>Số Điện Thoại</th>
                        <th>Xử Lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{$item-> role_as == '0'? 'Người Dùng':'Admin' }}</td>
                        <td>{{ $item->name.' '.$item->lname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>

                        <td>
                           <a href="{{url('view-users/'.$item->id) }}" class="btn btn-primary btn-sm">Xem</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection