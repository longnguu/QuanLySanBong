@extends('admin.layout', ['title' => 'Add Coupon'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm khuyến mãi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Coupon</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('User.alert');

    <section class="content">
        <form action="{{ route("admin.coupon.save") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin mã giảm giá</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Mã giảm giá </label>
                                <input name="magiamgia" type="text" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Trạng thái</label>
                                <select name="trangthai" class="form-control custom-select">
                                    <option value="0">Hết hiệu lực</option>
                                    <option value="1">Còn hiệu lực</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Loại</label>
                                <select name="loai" class="form-control custom-select">
                                    <option value="0">Giảm trực tiếp </option>
                                    <option value="1">Giảm theo phần trăm</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Lượt dùng </label>
                                <input name="soluongcon" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giá trị giảm </label>
                                <input name="giatri" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giá trị đơn hàng yêu cầu </label>
                                <input name="toithieu" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giảm tối đa </label>
                                <input name="giamtoida" type="text" class="form-control" value="0" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('admin.coupon.index')}}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success float-right">Thêm</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
