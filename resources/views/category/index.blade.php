@extends('layouts.admin')

@section('title')
    <title>Trang danh mục</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Danh mục', 'key' => 'Danh sách'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2">Thêm mới</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->parent_id }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', ['id' => $item->id]) }}" class="btn btn-default">Sửa danh mục</a>
                                            <a href="{{ route('categories.delete', ['id' => $item->id]) }}" class="btn btn-danger">Xóa danh mục</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $items->links() }}
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

