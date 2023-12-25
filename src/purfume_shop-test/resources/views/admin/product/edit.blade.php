@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm Sản Phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('upload-product/'.$products->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')   
            @csrf
            <div class="col-md-12 mb-3">
                <select class="form-select" >
                    <option value="">{{ $products->category->name}}</option>       

                </select>
            </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" value="{{ $products->name}}" name="name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Từ Khóa</label>
                        <input type="text" class="form-control" value="{{ $products->slug}}" name="slug">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for=""> Mô Tả</label>
                        <textarea name="small_description"  rows="3" class="form-control">{{ $products->small_description}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for=""> Mô Tả Chi Tiết</label>
                        <textarea name="description" id="content" rows="3" class="form-control">{{ $products->description}}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Giá gốc</label>
                        <input type="number" value="{{ $products->original_price}}" class="form-control" name="original_price" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Giá giảm</label>
                        <input type="number" value="{{ $products->selling_price}}" class="form-control" name="selling_price">
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label for=""> &emsp;</label>
                        <input type="number" value="{{ $products->tax}}" class="form-control" name="tax">
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label for="">Số lượng</label>
                        <input type="number" value="{{ $products->qty}}" class="form-control" name="qty">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Ẩn</label>
                        <input type="checkbox" {{ $products->status == "1" ? 'checked' : '' }} name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" {{ $products->trending == "1" ? 'checked' : '' }} name="trending">
                    </div>
                    
                    {{-- <div class="col-md-12 mb-3">
                        <label>Meta Title</label>
                        <input type="text" value="{{ $products->meta_title }}" rows="3" class="form-control" name="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control">{{ $products->meta_keywords }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control">{{ $products->meta_description }}</textarea>
                    </div> --}}

                    @if($products->image) 
                        <img src="{{ asset('assets/uploads/products/'.$products->image) }}" alt="Image product" >
                    @endif

                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>

                    @if($products->multiple_images->count() > 0)
   
        @foreach ($products->multiple_images as $img_detail)
            <img src="{{ asset('assets/multiple_image/products/'.$img_detail->image_path) }}" alt="Ảnh chi tiết sản phẩm">
        @endforeach
   
@endif


                    <div class="col-md-12">
                        <label for="">Ảnh Chi Tiết</label>
                        <input type="file" name="image2[]" class="form-control" multiple>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"> Cập Nhật </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- @section('custom-js')
<script src="http://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
     <script>
         CKEDITOR.replace('description');
      </script>
@endsection --}}