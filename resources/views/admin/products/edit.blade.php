@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Chỉnh sửa'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" value="{{ $product->title ?? '' }}" name="title" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text" class="form-control" value="{{ $product->price }}" name="price" placeholder="Nhập giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control" value="{{ $product->image ?? '' }}" name="image">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh chi tiết</label>
                                <input type="file" class="form-control" multiple="multiple" value="{{ $product->images ?? '' }}" name="images[]">
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">Chọn danh mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id ?? '' }}" @if($product->category_id == $category->id) selected="selected" @endif>{{ $category->title ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tags sản phẩm</label>
                                <select class="form-control tags-select-choose" name="tags[]" multiple="multiple">

                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
