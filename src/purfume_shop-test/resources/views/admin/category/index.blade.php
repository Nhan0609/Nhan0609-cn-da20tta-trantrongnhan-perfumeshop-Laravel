@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Trang Danh Mục</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Hình Ảnh</th>
                        <th>Xử Lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>

                        <td>
                            <img src="{{ asset('assets/uploads/category/'.$item->image,) }}" class="cate-image" alt="Hình ảnh"> 
                        </td>

                        <td>
                           <a href="{{url('edit-category/'.$item->id) }}" class="btn btn-primary">Sửa</a>
                           <a href="{{url('delete-category/'.$item->id) }}" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection