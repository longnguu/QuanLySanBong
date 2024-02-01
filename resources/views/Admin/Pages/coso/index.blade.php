@extends('admin.layout', ['title' => 'Category'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Các cơ sở</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cơ sở</li>
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
                    <a href="{{ route("admin.coso.add") }}">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
{{--            <div>--}}
{{--                @if(session('del'))--}}
{{--                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">--}}
{{--                        {{session('del')}}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if(session('updated'))--}}
{{--                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">--}}
{{--                        {{session('updated')}}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if(session('add'))--}}
{{--                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">--}}
{{--                        {{session('add')}}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="">
                            Mã cơ sở
                        </th>
                        <th style="">
                            Tên cơ sở
                        </th>
                        <th style="">
                            Mô tả
                        </th>
                        <th style="">
                            Địa chỉ
                        </th>
                        <th style="">
                            Giờ mở cửa
                        </th>
                        <th style="">
                            Giờ đóng cửa
                        </th>
                        <th style="">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_cate as $key => $value)
                        <tr>
                            <td>
                                {{ $value -> maCoSo }}
                            </td>
                            <td>
                                {{ $value -> tenCoSo }}
                            </td>
                            <td>
                                {!! $value -> moTa  !!}
                            </td>
                            <td>
                                {{ $value -> diaChi }}
                            </td>
                            <td>
                                {{ $value -> thoiGianMoCua }}
                            </td>
                            <td>
                                {{ $value -> thoiGianDongCua }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("admin.coso.edit",  $value -> maCoSo ) }}">
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
