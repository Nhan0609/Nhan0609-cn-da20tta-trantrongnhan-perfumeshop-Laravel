@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm Sản Phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-md-12 mb-3">
                <select class="form-select" name="cate_id">
                    <option value="">Chọn Danh Mục</option>
                        @foreach($category as $item)                       
                            <option value="{{$item ->id}}">{{$item -> name}}</option>
                        @endforeach

                </select>
            </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Từ Khóa</label>
                        <input type="text" class="form-control" name="slug">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for=""> Mô Tả</label>
                        <textarea name="small_description" rows="3" class="form-control"></textarea>
                        {{-- <textarea class="form-control" id="small_description" name="small_description" rows="10" cols="80"></textarea> --}}
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for=""> Mô Tả Chi Tiết</label>
                        <textarea name="description" id="content" rows="3" class="form-control"></textarea>
                        {{-- <textarea class="form-control" id="description" name="small_description" rows="10" cols="80"></textarea> --}}
                        
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Giá gốc</label>
                        <input type="number" class="form-control" name="original_price" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Giá giảm</label>
                        <input type="number" class="form-control" name="selling_price">
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label for=""> &emsp;</label>
                        <input type="number" class="form-control" name="tax">
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label for="">Số lượng</label>
                        <input type="number" class="form-control" name="qty">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Ẩn</label>
                        <input type="checkbox" name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" name="trending">
                    </div>
                    
                    {{-- <div class="col-md-12 mb-3">
                        <label>Meta Title</label>
                        <input type="text" rows="3" class="form-control" name="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control"></textarea>
                    </div> --}}
                    <div class="col-md-12">
                        <label for="">Ảnh Đại Diện</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label for="">Ảnh Chi Tiết</label>
                        <input type="file" name="image2[]" class="form-control" multiple>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"> Thêm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- @section('custom-js')
<script src="http://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
     <script>
        //  CKEDITOR.replace('small_description');
         CKEDITOR.replace('description');
      </script>
@endsection --}}