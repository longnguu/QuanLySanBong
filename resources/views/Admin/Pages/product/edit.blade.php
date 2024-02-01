@extends('admin.layout', ['title' => 'Edit Product'])

@section('content')
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa sản phẩm {{ $product -> tenVatPham }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route("admin.product.edit", $product-> maVatPham ) }}" method="POST">
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
                                <input value="{{ $product -> tenVatPham }}" name="TenSP" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mota">Mô tả</label>
                                <textarea name="MoTa" id="mota" class="form-control" rows="4">{{ $product -> moTa }}</textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="">
                                    <label for="inputStatus">Thương hiệu</label>
                                    <select name="TH_id" id="inputStatus" class="form-control custom-select">
                                        @foreach($br as  $key => $vl)
                                            <option value="{{ $vl->maLoaiVP }}" {{ $vl->maLoaiVP == $product->maLoaiVP ? "selected" : "" }}>
                                                {{ $vl->tenLoaiVP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="inputStatus">Số lượng</label>
                                    <input value="{{ $product -> soLuongCon }}" name="SoLuong" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Số lượng cho thuê</label>
                                    <input value="{{ $product -> soLuongChoThue }}" name="SoLuongThue" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Đơn giá bán</label>
                                    <input value="{{ $product -> donGiaBan }}" name="DonGiaBan" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Đơn giá thuê</label>
                                    <input value="{{ $product -> donGiaThue }}" name="DonGiaThue" type="number" class="form-control">
                                </div>
                                <div>
                                    <div class="">
                                        <label for="inputStatus">Hình ảnh 1</label>
                                        <input value="{{ $product -> hinhAnh1 }}" name="HinhAnh1" type="file" id="myFile" accept="image/*">
                                    </div>
                                    <div class="">
                                        <label for="inputStatus">Hình Ảnh 2</label>
                                        <input value="{{ $product -> hinhAnh2 }}" name="HinhAnh2" type="file" id="myFile" accept="image/*">
                                    </div>
                                    <div class="">
                                        <label for="HinhAnh3">Hình Ảnh 3</label>
                                        <input value="{{ $product -> hinhAnh3 }}" name="HinhAnh3" type="file" id="myFile" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none">
                                <label for="inputClientCompany">Mã Khuyến Mãi</label>
                                <select name="KM_id" id="inputStatus" class="form-control custom-select">
                                    @foreach($km as  $key => $vl)
                                        <option value="{{ $vl->maKM }}" {{ $vl->maKM == $product->maKhuyenMai ? "selected" : "" }}>
                                            {{ $vl->tenKM }}</option>
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
                <div class="d-block d-flex">
                    <a href="{{route('admin.product.index')}}" class="btn btn-secondary">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        <i class="far fa-save"></i>
                    </button>
                </div>
        </form>
    </section>
    <!-- /.content -->
<script>
    CKEDITOR.replace('mota');</script>


@endsection

