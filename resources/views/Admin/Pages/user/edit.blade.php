@extends('admin.layout', ['title' => 'Add User'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thông tin người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
{{--        {{dd($user)}}--}}
        <form action="{{ route("admin.user.edit", $user->maNguoiDung) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin người dùng</h3>
                        </div>
                        <div class="card-body d-flex">
                            <div style="margin-right: 10%">
                                <div class="form-group">
                                    <label for="inputName">Họ</label>
                                    <input value="{{ $user -> ho }}" name="Ho" type="text" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tên</label>
                                    <input value="{{ $user -> ten }}" name="Ten" type="text" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Giới tính</label>
                                    <input value="{{ $user -> gioiTinh }}" name="GioiTinh" type="text" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">SĐT</label>
                                    <input value="{{ $user -> SDT }}" name="SDT" type="text" id="inputName" class="form-control">
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="inputName">Email</label>--}}
{{--                                    <input value="{{ $user -> taiKhoan }}" name="email" type="text" id="inputName" class="form-control">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="inputName">Địa chỉ</label>
                                    <input value="{{ $user -> diaChi }}" name="DiaChi" type="text" id="inputName" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="inputName">Username</label>
                                    <input value="{{ $user -> taiKhoan }}" name="username" disabled type="text" id="inputName" class="form-control">
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="inputName">Password</label>--}}
{{--                                    <input value="{{ $user -> password }}" name="password" type="text" id="inputName" class="form-control">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="inputName">Quyền</label>
                                    <select class="form-control" name="Quyen_id" id="inputName">
                                        @foreach($role as  $key => $vl)
                                            <option value="{{ $vl->maQuyen }}" {{ $vl->maQuyen == $user->maQuyen ? "selected" : "" }}>
                                                {{ $vl->tenQuyen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Trạng Thái</label>
                                    <input value="{{ $user -> trangThai }}" name="TrangThai" type="text" id="inputName" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('admin.user.index')}}" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Sửa" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
