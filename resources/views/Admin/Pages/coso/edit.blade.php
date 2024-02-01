@extends('admin.layout', ['title' => 'Edit Category'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thông tin cơ sở</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route("admin.coso.edit", $cate -> maCoSo) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cơ sở</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputName">Tên cơ sở</label>
                                <input value="{{ $cate -> tenCoSo }}" name="TenDM" type="text" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Mô tả</label>
                                <textarea name="moTa" id="mota" type="text"  id="inputName" class="form-control" required>{{$cate -> moTa}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Tên cơ sở</label>
                                <input value="{{ $cate -> diaChi }}" name="diaChi" type="text" id="inputName" class="form-control" required>
                            </div>

                            <div class="form-group d-flex">
                                <div>
                                    <label for="inputName">Giờ mở cửa</label>
                                    <input name="gmc" type="number" min="0"  id="inputName" class="form-control" required value="{{$cate -> thoiGianMoCua}}">
                                </div>
                                <div class="ml-5">
                                    <label for="inputName">Giờ đóng cửa</label>
                                    <input name="gdc" type="number" max="24" id="inputName" class="form-control" required value="{{$cate -> thoiGianDongCua}}">
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
                    <a href="{{route('admin.coso.index')}}" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Chỉnh sửa" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
