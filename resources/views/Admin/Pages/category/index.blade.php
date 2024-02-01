@extends('admin.layout', ['title' => 'Category'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh mục sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Danh mục</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-block">
                <div>
                    <h3 class="card-title">Tất cả</h3>
                </div>
                <div class="u-cursor-pt" style="margin-left: 60px">
                    <a href="{{ route("admin.category.add") }}">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="">
                            ID
                        </th>
                        <th style="">
                            Danh mục
                        </th>
                        <th style="">
                            Mô tả
                        </th>
                        <th style="">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_cate as $key => $value)
                        <tr>
                            <td>
                                {{ $value -> maLoaiVP }}
                            </td>
                            <td>
                                {{ $value -> tenLoaiVP }}
                            </td>
                            <td>
                                {{ $value -> moTa }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("admin.category.edit",  $value -> maLoaiVP ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
{{--                                <a class="btn btn-danger btn-sm"--}}
{{--                                   href="{{ route("admin.category.getDestroy",  $value -> maLoaiVP ) }}">--}}
{{--                                    <i class="fas fa-trash">--}}
{{--                                    </i>--}}
{{--                                    Delete--}}
{{--                                </a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
