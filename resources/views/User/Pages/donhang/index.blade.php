@extends('User.main')
@php

$stt=0;
@endphp
@section('head')
    <style type="text/css">
        .content{
            background-color: var(--bg);
        }
        .don_mua{
            width: 100%;
            cursor: default;
        }
        .sp img{
            flex: 1;
        }
        .sp p{
            flex: 5;
        }
        .sp p:last-child{
            text-align: right;
            flex: 1;
        }
        p{
            margin: 0;
        }
        .dieu_huong{
            background-color: #fff;
        }
        .dieu_huong label{
            display: flex;
            justify-content: center;
            align-items: center;
            width: calc(100% / 6);
            height: 50px;
            cursor: pointer;
            transition: 0.1s all ease;
        }
        #dk1:checked ~ .dk1{
            border-bottom: 5px solid var(--main-color);
        }
        #dk2:checked ~ .dk2{
            border-bottom: 5px solid var(--main-color);
        }
        #dk3:checked ~ .dk3{
            border-bottom: 5px solid var(--main-color);
        }
        #dk4:checked ~ .dk4{
            border-bottom: 5px solid var(--main-color);
        }
        #dk5:checked ~ .dk5{
            border-bottom: 5px solid var(--main-color);
        }
        #dk6:checked ~ .dk6{
            border-bottom: 5px solid var(--main-color);
        }
        .don_mua .don_hang{
            padding: 30px;
            margin-top: 30px;
            background-color: #fff;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .don_mua .don_hang .in_don_hang{
            float: left;
        }
        .don_mua .don_hang .trang_thai{
            width: 100%;
            text-align: right;
            padding-bottom: 10px;
            font-weight: bold;
            font-size: 20px;
            color: var(--main-color);
            border-bottom: 1px solid grey;
        }
        .don_mua .don_hang .sp{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid grey;
            margin-top: 20px;
        }
        .don_mua .don_hang .sp>a{
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            text-decoration: none;
            margin-bottom: 15px;
        }
        .don_mua .don_hang .sp>a:hover{
            color: var(--color2);
        }
        .don_mua .don_hang .sp img{
            display: block;
            width: 80px;
            margin-right: 20px;
        }
        .don_mua .don_hang .sp p{
            font-size: 18px;
        }
        .don_mua .tong_tien{
            margin-top: 20px;
            text-align: right;
            font-size: 20px;
        }
        .don_mua .tong_tien span{
            color: var(--main-color);
            font-weight: bold;
        }
        .block{
            display: block;
        }
    </style>
@endsection
@section('content')
        <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Đơn hàng</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="account-dashboard" style="margin-bottom: 50px;margin-top:50px">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="#thuesan" data-bs-toggle="tab"
                                       class="nav-link btn btn-block btn-md btn-black-default-hover active">Đơn thuê sân</a>
                                </li>
                                <li><a href="#muavp" data-bs-toggle="tab"
                                       class="nav-link btn btn-block btn-md btn-black-default-hover">Đơn mua vật phẩm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                            <div class="tab-pane fade show active" id="thuesan">
                                <h4>Đơn thuê sân</h4>
                                <div class="table_page table-responsive">
                                    <table id="yourTableId">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày tạo đơn</th>
                                            <th>
                                                <select id="selectDonHang2" onchange="ChangeThanhToan()">
                                                    <option value="9">Thanh toán</option>
                                                    <option value="1">Đã thanh toán</option>
                                                    <option value="0">Chưa thanh toán</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select id="selectDonHang" onchange="ChangeTrangThai()">
                                                    <option value="9">Trạng thái đơn</option>
                                                    <option value="0">Chờ nhận sân</option>
                                                    <option value="1">Đã sử dụng</option>
                                                    <option value="4">Đã yêu cầu hủy</option>
                                                    <option value="5">Đã hủy</option>
                                                </select>
                                            </th>
                                            <th>Tổng tiền</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($donhang as $dh)
                                            @if($dh->loaiDonHang==1)
                                                <tr class="product-item" data-thanhtoan="{{$dh->daThanhToan}}" data-trangThai="{{ $dh->trangThai }}">
                                                    <td>{{$dh->id}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($dh->created_at)->addHours(7) }}</td>
                                                    <td><span class="success">{{$dh->daThanhToan==1?"Đã thanh toán":"Chưa thanh toán"}}</span></td>
                                                    <td>
                                                        @if($dh->trangThai==0)
                                                            Chờ nhận sân ({{\Illuminate\Support\Facades\DB::table('chitietthuesan')->where('maVatPham','=',null)->where('thoiGianBatDau','>',now())->where('maDonHang','=',$dh->id)->groupBy('maDonHang')->count().'/'.\Illuminate\Support\Facades\DB::table('chitietthuesan')->where('maVatPham','=',null)->where('maDonHang','=',$dh->id)->groupBy('maDonHang')->count()}})
                                                        @elseif($dh->trangThai==1)
                                                            Đã sử dụng
                                                        @elseif($dh->trangThai==2)
                                                            Đã yêu cầu hủy
                                                        @elseif($dh->trangThai==3)
                                                            Đã hủy
                                                        @endif
                                                    </td>
                                                    <td>{{number_format($dh->tongTien, 0, ',', '.') . ' VNĐ'}}</td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm"
                                                           href="/chitietdonhang?maDon={{$dh->id}}">
                                                            <i class="fas fa-eye"></i>
                                                            Xem chi tiết
                                                        </a>
                                                        <br/>
                                                        @if(\Illuminate\Support\Facades\DB::table('chitietthuesan')->where('maVatPham','=',null)->where('thoiGianBatDau','>',\Carbon\Carbon::now()->addHour(8))->where('maDonHang','=',$dh->id)->groupBy('maDonHang')->count()==\Illuminate\Support\Facades\DB::table('chitietthuesan')->where('maVatPham','=',null)->where('maDonHang','=',$dh->id)->groupBy('maDonHang')->count())
                                                            <a class="btn btn-light btn-sm" style="background-color: #c44646"
                                                               href="/huydon?maDon={{$dh->id}}" onclick="confirmAction(event,'hủy đơn')">
                                                                <i class="fas fa-ban"></i>
                                                                Hủy đơn
                                                            </a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination">
                                    {{ $donhang->links('pagicustom') }}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="muavp">
                                <ul class="nav nav-tabs" id="myTabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab11">Tất cả</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab1-tab" data-bs-toggle="tab" href="#tab22">Chờ xác nhân</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab3">Đang chuẩn bị hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab4">Đã giao cho vận chuyển</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab4-tab" data-bs-toggle="tab" href="#tab5">Đã hoàn thành</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab5-tab" data-bs-toggle="tab" href="#tab6">Yêu cầu hủy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab6-tab" data-bs-toggle="tab" href="#tab7">Đã hủy</a>
                                    </li>
                                </ul>

                                <!-- Tab content -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab11">
{{--                                        <h4>Đơn hàng</h4>--}}
                                        <div class="don_mua">
{{--                                            <select id="trangthaidon" style="width: 100%">--}}
{{--                                                <option value="9">Trạng thái đơn</option>--}}
{{--                                                <option value="0">Chờ xác nhận</option>--}}
{{--                                                <option value="1">Đang giao</option>--}}
{{--                                                <option value="2">Hoàn thành</option>--}}
{{--                                                <option value="3">Đã nhận</option>--}}
{{--                                                <option value="4">Đã yêu cầu hủy</option>--}}
{{--                                                <option value="5">Đã hủy</option>--}}
{{--                                            </select>--}}
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    <div class="don_hang">
                                                        <div class="trang_thai">
                                                            @switch($value->trangThai)
                                                                @case(0)
                                                                    CHỜ XÁC NHẬN
                                                                    @break
                                                                @case(1)
                                                                    CHỜ LẤY HÀNG
                                                                    @break
                                                                @case(2)
                                                                    ĐANG GIAO
                                                                    @break
                                                                @case(3)
                                                                    ĐÃ GIAO
                                                                    @break
                                                                @case(4)
                                                                    ĐÃ HỦY
                                                                    @break
                                                            @endswitch
                                                        </div>
                                                        <div class="ds_sp">
                                                                <?php
                                                                $sp = DB::table('donhang')
                                                                    ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                    ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                    ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                    ->where('maDonHang', $value->id)
                                                                    ->get();
                                                                ?>
                                                            @foreach($sp as $value1)
                                                                <div class="sp">
                                                                    {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                    <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                    <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                    </a>
                                                                    <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                </div>
                                                            @endforeach
                                                            <div class="tong_tien">
                                                                Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="don_mua">
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    @if($value->trangThai==0)
                                                        <div class="don_hang">
                                                            <div class="trang_thai">
                                                                @switch($value->trangThai)
                                                                    @case(0)
                                                                        CHỜ XÁC NHẬN
                                                                        @break
                                                                    @case(1)
                                                                        ĐANG CHUẨN BỊ HÀNG
                                                                        @break
                                                                    @case(2)
                                                                        ĐÃ GỬI CHO VẬN CHUYỂN
                                                                        @break
                                                                    @case(3)
                                                                        ĐÃ HOÀN THÀNH
                                                                        @break
                                                                    @case(4)
                                                                        ĐÃ YÊU CẦU HỦY
                                                                        @break
                                                                    @case(5)
                                                                        ĐÃ HỦY
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div class="ds_sp">
                                                                    <?php
                                                                    $sp = DB::table('donhang')
                                                                        ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                        ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                        ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                        ->where('maDonHang', $value->id)
                                                                        ->get();
                                                                    ?>
                                                                @foreach($sp as $value1)
                                                                    <div class="sp">
                                                                        {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                        <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                        <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                        </a>
                                                                        <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                    </div>
                                                                @endforeach
                                                                <div class="tong_tien">
                                                                    Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab3">
                                        <div class="don_mua">
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    @if($value->trangThai==1)
                                                        <div class="don_hang">
                                                            <div class="trang_thai">
                                                                @switch($value->trangThai)
                                                                    @case(0)
                                                                        CHỜ XÁC NHẬN
                                                                        @break
                                                                    @case(1)
                                                                        ĐANG CHUẨN BỊ HÀNG
                                                                        @break
                                                                    @case(2)
                                                                        ĐÃ GỬI CHO VẬN CHUYỂN
                                                                        @break
                                                                    @case(3)
                                                                        ĐÃ HOÀN THÀNH
                                                                        @break
                                                                    @case(4)
                                                                        ĐÃ YÊU CẦU HỦY
                                                                        @break
                                                                    @case(5)
                                                                        ĐÃ HỦY
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div class="ds_sp">
                                                                    <?php
                                                                    $sp = DB::table('donhang')
                                                                        ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                        ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                        ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                        ->where('maDonHang', $value->id)
                                                                        ->get();
                                                                    ?>
                                                                @foreach($sp as $value1)
                                                                    <div class="sp">
                                                                        {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                        <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                        <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                        </a>
                                                                        <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                    </div>
                                                                @endforeach
                                                                <div class="tong_tien">
                                                                    Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab4">
                                        <div class="don_mua">
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    @if($value->trangThai==2)
                                                        <div class="don_hang">
                                                            <div class="trang_thai">
                                                                @switch($value->trangThai)
                                                                    @case(0)
                                                                        CHỜ XÁC NHẬN
                                                                        @break
                                                                    @case(1)
                                                                        ĐANG CHUẨN BỊ HÀNG
                                                                        @break
                                                                    @case(2)
                                                                        ĐÃ GỬI CHO VẬN CHUYỂN
                                                                        @break
                                                                    @case(3)
                                                                        ĐÃ HOÀN THÀNH
                                                                        @break
                                                                    @case(4)
                                                                        ĐÃ YÊU CẦU HỦY
                                                                        @break
                                                                    @case(5)
                                                                        ĐÃ HỦY
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div class="ds_sp">
                                                                    <?php
                                                                    $sp = DB::table('donhang')
                                                                        ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                        ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                        ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                        ->where('maDonHang', $value->id)
                                                                        ->get();
                                                                    ?>
                                                                @foreach($sp as $value1)
                                                                    <div class="sp">
                                                                        {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                        <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                        <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                        </a>
                                                                        <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                    </div>
                                                                @endforeach
                                                                <div class="tong_tien">
                                                                    Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab5">
                                        <div class="don_mua">
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    @if($value->trangThai==3)
                                                        <div class="don_hang">
                                                            <div class="trang_thai">
                                                                @switch($value->trangThai)
                                                                    @case(0)
                                                                        CHỜ XÁC NHẬN
                                                                        @break
                                                                    @case(1)
                                                                        ĐANG CHUẨN BỊ HÀNG
                                                                        @break
                                                                    @case(2)
                                                                        ĐÃ GỬI CHO VẬN CHUYỂN
                                                                        @break
                                                                    @case(3)
                                                                        ĐÃ HOÀN THÀNH
                                                                        @break
                                                                    @case(4)
                                                                        ĐÃ YÊU CẦU HỦY
                                                                        @break
                                                                    @case(5)
                                                                        ĐÃ HỦY
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div class="ds_sp">
                                                                    <?php
                                                                    $sp = DB::table('donhang')
                                                                        ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                        ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                        ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                        ->where('maDonHang', $value->id)
                                                                        ->get();
                                                                    ?>
                                                                @foreach($sp as $value1)
                                                                    <div class="sp">
                                                                        {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                        <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                        <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                        </a>
                                                                        <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                    </div>
                                                                @endforeach
                                                                <div class="tong_tien">
                                                                    Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab6">
                                        <div class="don_mua">
                                            <div class="noi_dung" id="noi_dung">
                                                @foreach($donhang1 as $value)
                                                    @if($value->trangThai==4)
                                                        <div class="don_hang">
                                                            <div class="trang_thai">
                                                                @switch($value->trangThai)
                                                                    @case(0)
                                                                        CHỜ XÁC NHẬN
                                                                        @break
                                                                    @case(1)
                                                                        ĐANG CHUẨN BỊ HÀNG
                                                                        @break
                                                                    @case(2)
                                                                        ĐÃ GỬI CHO VẬN CHUYỂN
                                                                        @break
                                                                    @case(3)
                                                                        ĐÃ HOÀN THÀNH
                                                                        @break
                                                                    @case(4)
                                                                        ĐÃ YÊU CẦU HỦY
                                                                        @break
                                                                    @case(5)
                                                                        ĐÃ HỦY
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div class="ds_sp">
                                                                    <?php
                                                                    $sp = DB::table('donhang')
                                                                        ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                                                                        ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                                                                        ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                                                                        ->where('maDonHang', $value->id)
                                                                        ->get();
                                                                    ?>
                                                                @foreach($sp as $value1)
                                                                    <div class="sp">
                                                                        {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                                                                        <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                                                                        <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                                                                        </a>
                                                                        <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                                                                    </div>
                                                                @endforeach
                                                                <div class="tong_tien">
                                                                    Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Account Dashboard Section:::... -->
@endsection
@section('footer')
 <script>
     $(document).ready(function() {
         $('select').niceSelect('destroy');
     });
     function ChangeTrangThai() {
         var selectDonHang = document.getElementById("selectDonHang").value;

         $(".product-item").hide().filter(function() {
             var trangThai = $(this).data('trangthai'); // Sử dụng phương thức .data() để lấy giá trị
             console.log(trangThai);
             if (selectDonHang !== '9') {
                 return selectDonHang == trangThai;
             } else {
                 return true; // Show all when "Tất cả" is selected
             }
         }).show();
     }
     function ChangeTrangThai1() {
         var selectDonHang = document.getElementById("selectDonHang1").value;
         $(".product-item").hide().filter(function() {
             var trangThai = $(this).data('trangthai'); // Sử dụng phương thức .data() để lấy giá trị
             if (selectDonHang !== '9') {
                 return selectDonHang == trangThai;
             } else {
                 return true; // Show all when "Tất cả" is selected
             }
         }).show();
     }
     function ChangeThanhToan() {
         var selectDonHang = document.getElementById("selectDonHang2").value;
         $(".product-item").hide().filter(function() {
             var trangThai = $(this).data('thanhtoan'); // Sử dụng phương thức .data() để lấy giá trị
             if (selectDonHang !== '9') {
                 return selectDonHang == trangThai;
             } else {
                 return true; // Show all when "Tất cả" is selected
             }
         }).show();
     }
 </script>
 <script>
     function confirmAction(event, action) {
         // Sử dụng hộp thoại xác nhận
         var result = confirm("Bạn có chắc chắn muốn '" + action + "' theo chính sách của chủ sân không?" +
             "Nếu đơn hàng đã được thanh toán. Số tiền sau khi tính toán sẽ được hoàn tiền về tài khoản của bạn" +
             "Nếu đơn hàng chưa được thanh toán. Số tiền vi phạm sẽ trừ trực tiếp vào tài khoản của bạn");

         // Ngăn chặn hành động mặc định của sự kiện nếu người dùng chọn Cancel hoặc No
         if (!result && event.preventDefault) {
             event.preventDefault();
         }

         // Trả về kết quả để sử dụng trong ngữ cảnh khác nếu cần
         return result;
     }
 </script>
{{-- <script>--}}
{{--     window.addEventListener('load', function() {--}}
{{--         var $select = document.getElementById('trangthaidon');--}}
{{--         $select.addEventListener('change',function (event){--}}
{{--             var pttt=$select.selectedIndex;--}}
{{--             console.log(pttt);--}}
{{--             $.ajax({--}}
{{--                 url: "locdonmua?trangthai="+pttt,--}}
{{--                 type: "GET",--}}
{{--                 dataType: "html",--}}
{{--                 success: function(data) {--}}
{{--                     var $noidung = document.getElementById('noi_dung');--}}
{{--                     $noidung.innerHTML=data;--}}
{{--                 },--}}
{{--                 error: function() {--}}
{{--                     alert("Lỗi khi tải dữ liệu.");--}}
{{--                 }--}}
{{--             });--}}

{{--         });--}}
{{--     });--}}
{{-- </script>--}}
@endsection
