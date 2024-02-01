@extends('admin.layout', ['title' => 'User'])
@section('sshead')
    <style>
        .custom-alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 9999000;
            display: none;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-inline-block d-flex">
            <div>
                <form class="form-inline" id="form_input">
                    <input class="form-control" name="user" type="text" placeholder="Nhập tên người dùng">
                    <button class="btn-outline-dark btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-block">
                <div>
                    <h3 class="card-title">Tất cả</h3>
                </div>
                <div class="u-cursor-pt" style="margin-left: 60px">
                    <a href="{{ route("admin.user.add") }}">
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
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $key => $value)
                        <tr>
                            <td>{{ $value -> maNguoiDung }}</td>
                            <td>{{ $value->ho .' '. $value -> ten}}</td>
                            <td>{{ $value -> gioiTinh == 1 ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $value -> ngaySinh }}</td>
                            <td>{{ $value -> taiKhoan }}</td>
                            <td>{{ $value -> diaChi . ', ' . $value->xaphuong_name . ' - ' . $value->quanhuyen_name . ' - ' . $value->tinhthanh_name}}</td>
                            <td>{{ $value -> maQuyen == 1 ? "Admin" : "User" }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("admin.user.edit",  $value -> maNguoiDung ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-warning btn-sm"
                                   href="#" data-maND="{{$value->maNguoiDung}}" onclick="showDiv('{{$value->maNguoiDung}}')">
                                    <i class="fas fa-bell"></i>
                                    Thông báo
                                </a>
                                @if(session('Quyen_id')==2)
                                    <a class="btn btn-danger btn-sm"
                                       href="{{ route("admin.user.getDestroy",  $value -> maNguoiDung ) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $list->links('pagicustom') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <div id="AjaxNC" class="custom-alert">
        <form enctype="multipart/form-data" action="{{ route("admin.thongbao.send") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="loaiTB" value="0"/>
                            <div class="form-group">
                                <label for="inputName">Gửi thông báo đến:</label>
                                <input type="text" name="maNguoiDung" id="inputNameMaND" value="" class="form-control"required/>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Tiêu đề:</label>
                                <input type="text" name="tieuDe" id="inputName" class="form-control"required/>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Nội dung</label>
                                <textarea name="noiDung" id="mota" required id="inputDescription" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary" onclick="huyKK()">Hủy</a>
                    <input type="submit" value="Gửi" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </div>
    <script>

        function showDiv(maNguoiDung){
            var thongbao = document.getElementById("AjaxNC");
            document.getElementById("inputNameMaND").value=maNguoiDung;
            thongbao.style.display='block';
        }
        function huyKK(){
            var thongbao = document.getElementById("AjaxNC");
            thongbao.style.display="none";
        }
    </script>
@endsection
