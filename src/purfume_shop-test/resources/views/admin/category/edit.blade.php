@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Sửa Danh Mục</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Tên</label>
                        <input type="text" value="{{$category->name}}" class="form-control" name="name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Từ Khóa</label>
                        <input type="text" value="{{$category->slug}}" class="form-control" name="slug">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Mô Tả</label>
                        <textarea name="description" id="content" rows="3" class="form-control"> {{$category->description}} </textarea>
                        {{-- <textarea class="form-control" id="description" name="description" rows="10" cols="80">{{$category->description}}</textarea> --}}
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Ẩn</label>
                        <input type="checkbox" {{$category->status == "1" ? 'checked':''}} name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Thịnh Hành</label>
                        <input type="checkbox" {{$category->popular == "1" ? 'checked':''}} name="popular">
                    </div>

                    {{-- <div class="col-md-12 mb-3">
                        <label>Meta Title</label>
                        <input type="text" value="{{$category->meta_title}}" rows="3" class="form-control" name="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control">{{$category->meta_keywords}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control">{{$category->meta_descrip}}</textarea>
                    </div> --}}
                @if($category->image)    
                    <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Hình Ảnh">
                @endif    
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"> Lưu </button>
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