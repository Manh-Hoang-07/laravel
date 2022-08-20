@extends('layouts.admin')

@section('title')
    <title>Thêm mới sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Thêm mới'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.products.create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" name="title" placeholder="Nhập tên menu">
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="0">Chọn danh mục cha</option>
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
