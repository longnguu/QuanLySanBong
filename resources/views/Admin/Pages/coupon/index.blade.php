@extends('admin.layout', ['title' => 'Mã giảm giá'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Khuyến mãi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Khuyến mãi</li>
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
                    <a href="{{ route("admin.coupon.add") }}">
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
                            ID
                        </th>
                        <th style="">
                            Mã giảm giá
                        </th>
                        <th style="">
                            Mô tả
                        </th>
                        <th>
                            Trạng thái
                        </th>
                        <th>
                            Giá trị
                        </th>
                        <th>
                            Số lượt
                        </th>
                        <th>
                            Yêu cầu tối thiểu
                        </th>
                        <th>
                            Giảm tối đa
                        </th>
                        <th style="">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_discount as $key => $value)
                        <tr>
                            <td>
                                {{ $value -> id }}
                            </td>
                            <td>
                                {{ $value -> magiamgia }}
                            </td>
                            <td>
                                {{ $value -> mota }}
                            </td>
                            <td>
                                    @if($value->trangthai==1)
                                        Còn hiệu lực
                                    @else
                                        Hết hiệu lực
                                    @endif
                            </td>
                            <td>
                                {{ $value -> giatri }}
                            </td>
                            <td>
                                {{ $value -> soluongcon }}
                            </td>
                            <td>
                                {{ number_format($value->toithieu, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ number_format($value->giamtoida, 0, ',', '.') }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("admin.coupon.edit",  $value -> id ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm"
                                   href="{{ route("admin.coupon.getDestroy",  $value -> id ) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
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
