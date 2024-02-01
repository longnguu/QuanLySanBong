@extends('admin.layout', ['title' => 'Gửi thông báo'])
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
                    <h1>Thông báo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Thông báo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route("admin.thongbao.send") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Gửi thông báo đến:</label>
                                <select name="loaiTB" type="text" id="inputName" class="form-control">
{{--                                    <option value="-1">Tất cả</option>--}}
                                    <option value="1">Người dùng</option>
                                    <option value="2">Admin</option>
                                </select>
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
                    <a href="{{route('admin.thongbao.index')}}" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Gửi" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>

    <!-- /.content -->
@endsection
