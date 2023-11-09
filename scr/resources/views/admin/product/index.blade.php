@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Trang Sản Phẩm</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Danh Mục</th>
                        <th>Name</th>
                        <th>Giá Giảm</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->selling_price }}</td>

                        <td>
                            <img src="{{ asset('assets/uploads/products/'.$item->image,) }}" class="cate-image" alt="Hình ảnh"> 
                        </td>

                        <td>
                           <a href="{{url('edit-prod/'.$item->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                           <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection