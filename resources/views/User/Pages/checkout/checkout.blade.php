@extends('User.main')
@section('head')
    <style>
        form{
            margin-bottom: 10%;
        }
    </style>
@endsection
@section('content')
    <?php
        $tinh = \Illuminate\Support\Facades\DB::table('devvn_tinhthanhpho')->get();
        $user= \Illuminate\Support\Facades\DB::table('nguoidung')
            ->join('devvn_xaphuongthitran', 'nguoidung.maPhuong', '=', 'devvn_xaphuongthitran.xaid')
            ->join('devvn_quanhuyen', 'devvn_xaphuongthitran.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_tinhthanhpho', 'devvn_quanhuyen.matp', '=', 'devvn_tinhthanhpho.matp')
            ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
            ->select('devvn_xaphuongthitran.xaid', 'devvn_quanhuyen.maqh', 'devvn_tinhthanhpho.matp')
            ->first();
        $qh =\Illuminate\Support\Facades\DB::table('devvn_quanhuyen')
            ->where('matp','=',$user->matp)
            ->get();
        $xa =\Illuminate\Support\Facades\DB::table('devvn_xaphuongthitran')->where('maqh','=',$user->maqh)->get();
    ?>
    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Thanh toán</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout-section">
        <div class="container">
            <div class="row">
                <!-- User Quick Action Form -->
                <div class="col-12">
                    <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="0">
                        <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                            <div class="checkout_info">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If
                                    you are a new customer please proceed to the Billing &amp; Shipping section.</p>
                                <form action="#">
                                    <div class="form_group default-form-box">
                                        <label>Username or email <span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="form_group default-form-box">
                                        <label>Password <span>*</span></label>
                                        <input type="password">
                                    </div>
                                    <div class="form_group group_3 default-form-box">
                                        <button class="btn btn-md btn-black-default-hover" type="submit">Login</button>
                                        <label class="checkbox-default">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <a href="#">Lost your password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="200">
                        <div id="checkout_coupon" class="collapse checkout_coupon" data-parent="#checkout_coupon">
                            <div class="checkout_info">
                                <form action="#">
                                    <input placeholder="Coupon code" type="text">
                                    <button class="btn btn-md btn-black-default-hover" type="submit">Apply
                                        coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Quick Action Form -->
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
                <form action="/checkout" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-lg-6 col-md-6">
                            <h3>Thông tin thanh toán</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Họ<span>*</span></label>
                                        <input type="text" name="ho" value="{{\Illuminate\Support\Facades\Auth::user()->ho}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Tên<span>*</span></label>
                                        <input type="text" name="ten" value="{{\Illuminate\Support\Facades\Auth::user()->ten}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label for="country">Tỉnh/ Thành phố<span>*</span></label>
                                        <select class="country_option nice-select wide" name="tinh" id="id_tinh" onchange="updateSelect(0)">
                                            @foreach($tinh as $t)
                                                <option value="{{$t->matp}}" {{$user->matp==$t->matp?"selected":""}}>{{$t->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box" id="cbbquanhuyen">
                                        <label for="country">Quận/ huyện <span>*</span></label>
                                        <select class="country_option nice-select wide" name="quanhuyen" id="id_huyen" onclick="updateSelect(1)">
                                            @foreach($qh as $t)
                                                <option value="{{$t->maqh}}" {{$user->maqh==$t->maqh?"selected":""}}>{{$t->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label for="country">Xã/ phường<span>*</span></label>
                                        <select class="country_option nice-select wide" name="xaphuong" id="id_xa" id="cbbxaphuong">
                                            @foreach($xa as $t)
                                                <option value="{{$t->xaid}}" {{$user->xaid==$t->xaid?"selected":""}}>{{$t->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Địa chỉ <span>*</span></label>
                                        <input placeholder="Số nhà/ tên đường" required name="sonha" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->diaChi}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Số điện thoại<span>*</span></label>
                                        <input type="text" name="SDT" required value="{{\Illuminate\Support\Facades\Auth::user()->SDT}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Email <span>*</span></label>
                                        <input type="text" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->taiKhoan}}">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="order-notes">
                                        <label for="order_note">Ghi chú</label>
                                        <textarea id="order_note" name="ghichu"
                                                  placeholder="Để lại ghi chú cho đơn hàng của bạn."></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-lg-6 col-md-6">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sanpham as $c1)
                                        @php
                                            $tongDat = $c1->thu!=null?count(explode(';', $c1->thu))*($c1->ngay/7):1;
                                        @endphp
                                        @if($c1->maVatPham==null)
                                            <tr>
                                                <td><strong>{{$c1->tenSan}}</strong><br/>
                                                    @if($c1->ngay==null && $c1->thu==null)
                                                        {{'Từ '.$c1->thoiGianBatDau .' đến '. $c1->thoiGianKetThuc}}
                                                    @else
                                                        <p style="color:red">Thuê liên tục {{$c1->ngay}} ngày mỗi
                                                            @foreach(explode(';', $c1->thu) as $index => $thu)
                                                                {{$thu == 0 ? " chủ nhật" : "thứ " . ($thu + 1)}}
                                                                {{ $index == count(explode(';', $c1->thu)) - 1 ? '.' : ',' }}
                                                            @endforeach
                                                            <br/>
                                                            Bắt đầu từ: {{ \Carbon\Carbon::parse($c1->thoiGianBatDau)->format('d:m:Y') }} trong khung giờ:
                                                            {{ \Carbon\Carbon::parse($c1->thoiGianBatDau)->format('H:i:s') .' đến '.\Carbon\Carbon::parse($c1->thoiGianKetThuc)->format('H:i:s') }}
                                                        </p>
                                                    @endif

                                                </td>
                                                <td>
                                                    <strong>
                                                        @if($c1->thoiGianKetThuc && $c1->thoiGianBatDau)
                                                            @if($c1->hinhThucDat==2)
                                                                {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->giaDichVu*0.4*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                            @elseif($c1->hinhThucDat==3)
                                                                {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->giaDichVu*0.3*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                            @else
                                                                {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->giaDichVu*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                            @endif
                                                        @else
                                                            N/A
                                                        @endif
                                                    </strong>
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="background-color: #f0f0f0;">
                                                <td ><p style="margin-left: 10%" class="disabled">
                                                        {{$c1->tenVatPham}} <strong> x{{$c1->soLuong}}</strong>
                                                    </p> </td>
                                                <td>
                                                    @if($c1->thoiGianKetThuc && $c1->thoiGianBatDau)
                                                        @if($c1->hinhThucDat==2)
                                                            {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->donGiaThue*0.4*$c1->soLuong*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                        @elseif($c1->hinhThucDat==3)
                                                            {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->donGiaThue*0.3*$c1->soLuong*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                        @else
                                                            {{number_format((\Carbon\Carbon::parse($c1->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($c1->thoiGianBatDau)))*$c1->donGiaThue*$c1->soLuong*$tongDat, 0, ',', '.') . ' VNĐ'}}
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach($donmua as $c1)
                                        <tr>
                                            <td><strong>{{$c1->tenVatPham}} ( Đơn mua )</strong><br/>
                                                x{{$c1->soLuong}}
                                            </td>
                                            <td>
                                                <strong>
                                                    {{number_format($c1->donGiaBan*$c1->soLuong, 0, ',', '.') . ' VNĐ'}}
                                                </strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <td>{{number_format($tong, 0, ',', '.') . ' VNĐ'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phí ship</th>
                                        <td><strong>0 VNĐ</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Mã giảm giá</th>
                                        <td><strong><span id="mgg" style="color: black">0 VNĐ</span></strong></td>
                                    </tr>

                                    <tr class="order_total">
                                        <th>Cần thanh toán</th>
                                        <td><strong><span id="tong_cong">{{number_format($tong, 0, ',', '.') . ' VNĐ'}}</span></strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <tr>
                                <td colspan="2">
                                    <div class="coupon_inner" style="width: 100%!important;">
                                        <p>Nhập mã giảm giá mà bạn có.</p>
                                        <input class="mb-2" placeholder="Mã giảm giá" id="magiamgia" name="mgg" type="text" style="width: 70%;">
                                        <button id="btn_applyCoupon" class="btn btn-md btn-golden" onclick="applyCoupon(event)" style="width: 20%">Sử dụng</button>
                                        <p id="inforpgg" style="color: red"></p>
                                    </div>
                                </td>
                            </tr>
                            <div class="payment_method">
{{--                                <div class="panel-default">--}}
{{--                                    <label class="checkbox-default" for="currencyCod" data-bs-toggle="collapse"--}}
{{--                                           data-bs-target="#methodCod">--}}
{{--                                        <input type="checkbox" id="currencyCod">--}}
{{--                                        <span>Cash on Delivery</span>--}}
{{--                                    </label>--}}

{{--                                    <div id="methodCod" class="collapse" data-parent="#methodCod">--}}
{{--                                        <div class="card-body1">--}}
{{--                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State--}}
{{--                                                / County, Store Postcode.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="panel-default">
                                    <label class="checkbox-default" for="currencyPaypal" data-bs-toggle="collapse"
                                           data-bs-target="#methodPaypal">
                                        <input type="checkbox" name = "PTTT" id="currencyPaypal" onchange="kiemTraSD(this)">
                                        <span>Thanh toán Online</span>
                                    </label>
                                    <div id="methodPaypal" class="collapse " data-parent="#methodPaypal">
                                        <div class="card-body1">
                                            <p id="in4PayOnline"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_button pt-3">
                                    <button class="btn btn-md btn-black-default-hover" type="submit">Xác nhận</button>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->
@endsection
@section('footer')
    <script>
        function updateSelect(stt) {
            if(stt!=-1){
                var id_tinh = document.getElementById("id_tinh");
                var id_huyen = document.getElementById("id_huyen");
                var id_xa = document.getElementById("id_xa");
                var data={
                    stt: stt,
                    id_tinh: id_tinh.value,
                    id_huyen: id_huyen.value,
                }
                var url = "{{route('user.get_data_location')}}";
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "html",
                    data: data,
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        jsonData=parsedData.cbbqh;
                        jsonData1=parsedData.cbbxp;
                        if (stt==0){
                            id_huyen.innerHTML = '';
                            id_huyen.innerHTML= jsonData;
                        }else{
                            id_xa.innerHTML = '';
                            id_xa.innerHTML= jsonData1;
                        }
                    },
                    error: function() {
                        alert("Lỗi khi tải dữ liệu.");
                    }
                });
            }
        }
        function applyCoupon(event){
            event.preventDefault();
            var magiamgia =document.getElementById('magiamgia').value;
            var tong_cong =document.getElementById('tong_cong');
            var tong ={{$tong}};
            var mgg =document.getElementById('mgg');
            var in4 = document.getElementById('inforpgg');
            $.ajax({
                url: "addcoupon?magiamgia="+magiamgia,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    if (JSON.parse(data).data!=null){
                        var parsedData = JSON.parse(data).data;
                        var giam=0;
                        if(parsedData.loai==1){
                            giam = Math.min(parsedData.giatri*parseInt(tong),parsedData.giamtoida);
                        }else{
                            giam= parsedData.giatri;
                        }
                        if (parsedData.toithieu<=tong){
                            tong_cong.innerHTML=(tong-giam).toLocaleString('vi-VN');
                            mgg.innerHTML=giam.toLocaleString('vi-VN');
                            in4.innerHTML="Bạn vừa nhập mã: "+ parsedData.magiamgia +":"+parsedData.mota;
                        }else{
                            tong_cong.innerHTML=(tong).toLocaleString('vi-VN');
                            in4.innerHTML="Bạn vừa nhập mã: "+ parsedData.magiamgia +". "+parsedData.mota+". Nhưng bạn không đủ điều kiện sử dụng mã giảm giá này";
                            mgg.innerHTML="0";
                        }
                    }else{
                        tong_cong.innerHTML=(tong).toLocaleString('vi-VN');
                        in4.innerHTML="Mã giảm giá không tồn tại hoặc đã hết lượt sử dụng";
                        mgg.innerHTML="0";
                    }

                },
                error: function() {
                    console.log(url);
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
        function kiemTraSD(element) {
            if (element.checked) {
                var userHasEnoughBalance = {{ (\Illuminate\Support\Facades\Auth::user()->soDuTaiKhoan < $tong) ? 'true' : 'false' }};

                if (element.checked) {
                    var in4PayOnlineElement = document.getElementById('in4PayOnline');
                    if (userHasEnoughBalance) {
                        if (in4PayOnlineElement) {
                            in4PayOnlineElement.innerHTML = "Số tiền không đủ, vui lòng <a href='/giaodich?giatri={{($tong - \Illuminate\Support\Facades\Auth::user()->soDuTaiKhoan)}}' target='_blank'> nạp thêm tiền tại đây</a>";
                        }
                    } else {
                        in4PayOnlineElement.innerHTML = "Bạn đã chọn phương thức thanh toán online";
                    }
                }

            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('select').niceSelect('destroy');
        });
    </script>
@endsection
