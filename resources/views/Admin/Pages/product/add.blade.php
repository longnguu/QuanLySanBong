@extends('admin.layout', ['title' => 'Add Product'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route("admin.product.save") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Tên sản phẩm</label>
                                <input name="TenSP" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Mô tả</label>
                                <textarea name="MoTa" id="inputDescription" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="">
                                    <label for="inputStatus">Thương hiệu</label>
                                    <select name="maLoaiVP" id="inputStatus" class="form-control custom-select">
                                        @foreach($br as  $key => $vl)
                                            <option value="{{ $vl->maLoaiVP }}">{{ $vl->tenLoaiVP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="inputStatus">Số lượng</label>
                                    <input name="SoLuong" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Số lượng cho thuê</label>
                                    <input name="SoLuongThue" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Đơn giá bán</label>
                                    <input name="DonGiaBan" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Đơn giá thuê</label>
                                    <input name="DonGiaThue" type="number" class="form-control">
                                </div>
                                <div>
                                    <div class="">
                                        <label for="inputStatus">Hình ảnh 1</label>
                                        <input name="HinhAnh1" type="file" id="myFile" accept="image/*">
                                    </div>
                                    <div class="">
                                        <label for="inputStatus">Hình Ảnh 2</label>
                                        <input name="HinhAnh2" type="file" id="myFile" accept="image/*">
                                    </div>
                                    <div class="">
                                        <label for="HinhAnh3">Hình Ảnh 3</label>
                                        <input name="HinhAnh3" type="file" id="myFile" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none">
                                <label for="inputClientCompany">Chương trình khuyến mãi</label>
                                <select name="KM_id" id="inputStatus" class="form-control custom-select">
                                    @foreach($km as  $key => $vl)
                                        <option value="{{ $vl->maKM }}">{{ $vl->tenKM }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tt">Trạng thái</label>
                                <select class="form-control" name="TrangThai" id="tt">
                                    <option selected value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Thêm" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
