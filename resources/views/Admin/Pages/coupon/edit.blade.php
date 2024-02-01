@extends('admin.layout', ['title' => 'Add Discount'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa khuyến mãi {{ $discount -> TenKM }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Discount</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route("admin.coupon.edit", $discount -> id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khuyến mãi</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Mã giảm giá </label>
                                <input name="magiamgia" value="{{$discount->magiamgia}}" type="text" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Trạng thái</label>
                                <select name="trangthai" class="form-control custom-select">
                                    <option value="0">Hết hiệu lực</option>
                                    <option value="1" @if($discount->trangthai==1) selected @endif>Còn hiệu lực</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Loại</label>
                                <select name="loai" class="form-control custom-select">
                                    <option value="0">Giảm trực tiếp </option>
                                    <option value="1" @if($discount->loai==1) selected @endif>Giảm theo phần trăm</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Lượt dùng </label>
                                <input name="soluongcon" type="text" value="{{$discount->soluongcon}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giá trị giảm </label>
                                <input name="giatri" type="text" value="{{$discount->giatri}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giá trị đơn hàng yêu cầu </label>
                                <input name="toithieu" type="text" value="{{$discount->toithieu}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giảm tối đa </label>
                                <input name="giamtoida" type="text" value="{{$discount->giamtoida}}" class="form-control" required>
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
                    <input type="submit" value="Sửa" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
