@extends('layouts.admin')

@section('title')
    <title>Trang danh sách sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Danh sách'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.products.add') }}" class="btn btn-success float-right m-2">Thêm mới</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá sản phẩm</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id ?? '' }}</td>
                                    <td>{{ $product->title ?? '' }}</td>
                                    <td>{{ $product->price ?? '' }}</td>
                                    <td>
                                        <img src="{{ asset($product->image) ?? '' }}" height="50">
                                    </td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-default">Sửa sản phẩm</a>
                                        <a href="{{ route('admin.products.delete', ['id' => $product->id]) }}" class="btn btn-danger">Xóa sản phẩm</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $products->links() }}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if(Session::has('success'))
    <script type="text/javascript">
        toastr.success("{!!Session::get('success')!!}");
    </script>
@endif
@if(Session::has('error'))
    <script type="text/javascript">
        toastr.error("{!!Session::get('error')!!}");
    </script>
@endif

