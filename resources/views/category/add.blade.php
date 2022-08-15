@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Danh mục', 'key' => 'Thêm mới'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form>
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select name="" id="" class="form-control">
                                    <option value="0">Chọn danh mục cha</option>
                                    <option value="1">Danh mục 2</option>
                                    <option value="2">Danh mục 1</option>
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
