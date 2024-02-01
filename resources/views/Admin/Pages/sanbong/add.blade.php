@extends('admin.layout', ['title' => 'Add Category'])
@section('content')
    @php
        $cate = \Illuminate\Support\Facades\DB::table('coso')->get();
    @endphp
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm sân</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route("admin.sanbong.save") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin sân</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Tên sân</label>
                                <input name="tenSan" type="text" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Mô tả</label>
                                <textarea name="moTa" id="mota" type="text" id="inputName" class="form-control"></textarea>
                            </div>
                            <label for="inputStatus">Cơ sở</label>
                            <select name="maCoSo" id="inputStatus" class="form-control custom-select">
                                @foreach($cate as  $key => $vl)
                                    <option value="{{ $vl->maCoSo }}">{{ $vl->tenCoSo }}</option>
                                @endforeach
                            </select>
                            <label for="inputLoaiSan">Loại sân</label>
                            <select name="loaiSan" id="inputLoaiSan" class="form-control custom-select">
                                <option value="5">Sân 5 người</option>
                                <option value="5">Sân 7 người</option>
                                <option value="5">Sân 11 người</option>
                            </select>
                            <div class="form-group">
                                <label for="inputName">Giá dịch vụ</label>
                                <input name="giaDichVu" type="number" id="inputName" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('admin.sanbong.index')}}" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Thêm" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
