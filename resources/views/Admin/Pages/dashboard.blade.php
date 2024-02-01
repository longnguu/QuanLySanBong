@extends('admin.layout', ['title' => 'Admin'])
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trang chủ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Doanh thu</span>
                            <span class="info-box-number">
                               {{number_format(DB::table('donhang')->sum('tongTien'),0,',','.')}}
                              <small>VNĐ</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
{{--                <div class="col-12 col-sm-6 col-md-3">--}}
{{--                    <div class="info-box mb-3">--}}
{{--                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-pie"></i></span>--}}
{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">Tỷ lệ đơn hàng thành công</span>--}}
{{--                            <span class="info-box-number">--}}
{{--                                    {{(DB::table('donhang')->where('TrangThai', '3')->count()) / (DB::table('hoadon')->count())*100 }}--}}
{{--                            <small>%</small>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        <!-- /.info-box-content -->--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box -->--}}
{{--                </div>--}}
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Đơn hàng</span>
                            <span class="info-box-number">
                                    {{DB::table('donhang')->count()}}
                                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Khách hàng</span>
                            <span class="info-box-number">
                                    {{DB::table('nguoidung')->where('maQuyen', '3')->count()}}
                                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thống kê</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>Thống kê bán hàng</strong>
                                    </p>

                                    <div class="progress-group">
                                        Số lượng đã bán
                                        <span class="float-right">
                                            <b>
                                                {{DB::table('chitietthuesan')->where('maSan','=',null)->sum('soluong')}}
                                            </b>
                                            /{{DB::table('vatPham')->sum('soLuongCon')}}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary"
                                                 style="width:{{(DB::table('chitietthuesan')->where('maSan','=',null)->sum('soLuong')) / (DB::table('vatpham')->sum('soLuongCon'))*100}}%"></div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        Số lượng sản phẩm cho thuê
                                        <span class="float-right">
                                            <b>
                                                {{DB::table('chitietthuesan')->sum('soluong')}}
                                            </b>
                                            /{{DB::table('vatPham')->sum('soLuongChoThue')}}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary"
                                                 style="width:{{(DB::table('chitietthuesan')->sum('soLuong')) / (DB::table('vatpham')->sum('soLuongChoThue'))*100}}%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Đơn hàng đã giao</span>
                                        <span class="float-right">
                                            <b>
                                                {{(DB::table('donhang')->where('loaiDonHang','=',2)->where('TrangThai', '3')->count()) .'/'. (DB::table('donhang')->where('loaiDonHang','=',2)->count()) }}
                                            </b>

                                        </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" style="width:
                                            {{(DB::table('donhang')->where('loaiDonHang','=',2)->where('TrangThai', '3')->count()) / (DB::table('donhang')->where('loaiDonHang','=',2)->count())*100 }}%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->

{{--                                    <div class="progress-group">--}}
{{--                                        Đơn hàng đã hủy--}}
{{--                                        <span class="float-right">--}}
{{--                                        <b>--}}
{{--                                                {{ number_format((DB::table('hoadon')->where('TrangThai', '4')->count()) / (DB::table('hoadon')->count())*100, 2)  }}--}}
{{--                                        </b>%</span>--}}
{{--                                        <div class="progress progress-sm">--}}
{{--                                            --}}{{--                                                <div class="progress-bar bg-danger" style="width:--}}
{{--                                            --}}{{--                                            {{(DB::table('hoadon')->where('TrangThai', '4')->count()) / (DB::table('hoadon')->count())*100 }}%"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>
                                            Sân bóng thuê nhiều
                                        </strong>
                                    </p>
                                    @php
                                        $thuenhieu = \Illuminate\Support\Facades\DB::table('chitietthuesan')
                                            ->join('sanbong', 'sanbong.maSan', '=', 'chitietthuesan.maSan')
                                            ->where('maVatPham', '=', null)
                                            ->groupBy('sanbong.maSan')
                                            ->select(\Illuminate\Support\Facades\DB::raw('count(*) as count, sanbong.maSan'))
                                            ->orderBy('count', 'desc')
                                            ->get();
                                        $tongThue = \Illuminate\Support\Facades\DB::table('chitietthuesan')
                                            ->where('maVatPham', '=', null)
                                            ->count();
                                    @endphp
                                    @foreach($thuenhieu as $vl)
                                        <div class="progress-group">
                                            {{ $vl -> maSan }}
                                            <span class="float-right">
                                                    <b>
                                                        {{$vl->count}}
                                                        </b>
                                                        /{{$tongThue}}
                                                </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary"
                                                     style="width:{{($vl->count / $tongThue)*100}}%"></div>
                                            </div>
                                        </div>
                                        {{--                                            <div class="progress-group">--}}
                                        {{--                                                Số lượng sản phẩm cho thuê--}}
                                        {{--                                                <span class="float-right">--}}
                                        {{--                                                    <b>--}}
                                        {{--                                                        {{DB::table('chitietthuesan')->sum('soluong')}}--}}
                                        {{--                                                    </b>--}}
                                        {{--                                                    /{{DB::table('vatPham')->sum('soLuongChoThue')}}--}}
                                        {{--                                                </span>--}}
                                        {{--                                                <div class="progress progress-sm">--}}
                                        {{--                                                    <div class="progress-bar bg-primary"--}}
                                        {{--                                                         style="width:{{(DB::table('chitietthuesan')->sum('soLuong')) / (DB::table('vatpham')->sum('soLuongChoThue'))*100}}%"></div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
