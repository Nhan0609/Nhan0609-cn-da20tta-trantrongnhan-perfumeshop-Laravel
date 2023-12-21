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
                        <th>Tên</th>
                        <th>Giá Giảm</th>
                        <th>Hình Ảnh</th>
                        <th>Xử Lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category ? $item->category->name : 'N/A' }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->selling_price }}</td>

                        <td>
                            <img src="{{ asset('assets/uploads/products/'.$item->image,) }}" class="cate-image" alt="Hình ảnh"> 
                        </td>

                        <td>
                           <a href="{{url('edit-product/'.$item->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                           <a href="{{url('delete-product/'.$item->id) }}" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection