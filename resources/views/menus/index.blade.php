@extends('layouts.admin')

@section('title')
    <title>Trang danh sách menus</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Menus', 'key' => 'Danh sách'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('menus.add') }}" class="btn btn-success float-right m-2">Thêm mới</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->title }}</td>
                                        <td>{{ $menu->parent_id }}</td>
                                        <td>
                                            <a href="{{ route('menus.edit', ['id' => $menu->id]) }}" class="btn btn-default">Sửa menu</a>
                                            <a href="{{ route('menus.delete', ['id' => $menu->id]) }}" class="btn btn-danger">Xóa menu</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $menus->links() }}
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

