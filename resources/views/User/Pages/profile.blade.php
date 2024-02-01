@extends('User.main')
@php
    $donhang=\Illuminate\Support\Facades\DB::table('donhang')
    ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
    ->get();
$stt=0;
@endphp
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
    <div class="breadcrumb-section breadcrumb-bg-color--golden" style="background-image: url('{{ \Illuminate\Support\Facades\Auth::user()->anhBia != null ? asset('storage/' . \Illuminate\Support\Facades\Auth::user()->anhBia) : '' }}');">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->hinhAnh != null ? asset('storage/' . \Illuminate\Support\Facades\Auth::user()->hinhAnh) : 'https://static-00.iconduck.com/assets.00/avatar-default-icon-2048x2048-h6w375ur.png' }}" style="max-width: 100px; max-height: 100px; border-radius: 50%;" />
                    <h3 class="breadcrumb-title">{{\Illuminate\Support\Facades\Auth::user()->ho . ' ' . \Illuminate\Support\Facades\Auth::user()->ten}}</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
{{--                            <ul>--}}
{{--                                <li><a href="index.html">Home</a></li>--}}
{{--                                <li><a href="shop-grid-sidebar-left.html">Shop</a></li>--}}
{{--                                <li class="active" aria-current="page">My Account</li>--}}
{{--                            </ul>--}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard" style="margin-bottom: 50px;margin-top:50px">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
{{--                        <li><a href="#dashboard" data-bs-toggle="tab"--}}
{{--                               class="nav-link btn btn-block btn-md btn-black-default-hover active">Trang chủ</a>--}}
{{--                        </li>--}}
                        <li><a href="#account-details" data-bs-toggle="tab"
                               class="nav-link btn btn-block btn-md btn-black-default-hover active">Thông tin cá nhân</a>
                        </li>
                        <li> <a href="#orders" data-bs-toggle="tab"
                                class="nav-link btn btn-block btn-md btn-black-default-hover">Đổi mật khẩu</a></li>
                        <li><a href="/logout"
                               class="nav-link btn btn-block btn-md btn-black-default-hover">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
{{--                    <div class="tab-pane fade show active" id="dashboard">--}}
{{--                        <h4>Dashboard </h4>--}}
{{--                        <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent--}}
{{--                                orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a--}}
{{--                                href="#">Edit your password and account details.</a></p>--}}
{{--                    </div>--}}
                    <div class="tab-pane fade" id="orders">
                        <h4>Đổi mật khẩu</h4>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{route('user.doimk')}}"  enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="default-form-box mb-20">
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" required name="mkcu">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" required name="mkmoi">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Xác nhận mật mới</label>
                                            <input type="password" required name="xnmkmoi">
                                        </div>
                                        <div class="default-form-box mb-20">
{{--                                            <label for="showPasswordsCheckbox"></label>--}}
                                            <input type="checkbox" id="showPasswordsCheckbox" style="width: 10%"/>Hiển thị mật khẩu
                                        </div>

                                        <br>
                                        <div class="save_button mt-3">
                                            <button class="btn btn-md btn-black-default-hover"
                                                    type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
{{--                        <div class="table_page table-responsive">--}}
{{--                            <table>--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>STT</th>--}}
{{--                                    <th>Ngày tạo đơn</th>--}}
{{--                                    <th>Trạng thái đơn</th>--}}
{{--                                    <th>Tổng tiền</th>--}}
{{--                                    <th>Actions</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($donhang as $dh)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{++$stt}}</td>--}}
{{--                                        <td>{{ \Carbon\Carbon::parse($dh->created_at)->addHours(7) }}</td>--}}
{{--                                        <td><span class="success">{{$dh->daThanhToan==1?"Đã thanh toán":"Chưa thanh toán"}}</span></td>--}}
{{--                                        <td>{{number_format($dh->tongTien, 0, ',', '.') . ' VNĐ'}}</td>--}}
{{--                                        <td><a href="cart.html" class="view">Xem chi tiết</a></td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                    </div>
                    <div class="tab-pane" id="address">
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <h5 class="billing-address">Billing address</h5>
                        <a href="#" class="view">Edit</a>
                        <p><strong>Bobby Jackson</strong></p>
                        <address>
                            Address: Your address goes here.
                        </address>
                    </div>
                    <div class="tab-pane fade show active" id="account-details">
                        <h3>Thông tin cá nhân</h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{route('user.update_inf')}}"  enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="input-radio">
                                            <span class="custom-radio"><input type="radio" value="1" {{\Illuminate\Support\Facades\Auth::user()->gioiTinh==1?"checked":""}}
                                                                                  name="id_gender"> Nam</span>
                                            <span class="custom-radio"><input type="radio" value="0" {{\Illuminate\Support\Facades\Auth::user()->gioiTinh==0?"checked":""}}
                                                                              name="id_gender"> Nữ</span>
                                        </div> <br>
                                        <div class="default-form-box mb-20">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="hinhAnh" accept="image/*">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Ảnh bìa</label>
                                            <input type="file" name="anhBia" accept="image/*">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Họ</label>
                                            <input type="text" name="ho" value="{{\Illuminate\Support\Facades\Auth::user()->ho}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Tên</label>
                                            <input type="text" name="ten" value="{{\Illuminate\Support\Facades\Auth::user()->ten}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Tỉnh/ Thành phố</label>
                                            <select class="country_option nice-select wide" name="tinh" id="country" onchange="updateSelect(0)">
                                                @foreach($tinh as $t)
                                                    <option value="{{$t->matp}}" {{$user->matp==$t->matp?"selected":""}}>{{$t->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Quận/ Huyện</label>
                                            <select class="country_option nice-select wide" name="quanhuyen" id="quanhuyen" onchange="updateSelect(1)">
                                                @foreach($qh as $t)
                                                    <option value="{{$t->maqh}}" {{$user->maqh==$t->maqh?"selected":""}}>{{$t->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Xã/ Phường</label>
                                            <select class="country_option nice-select wide" name="xaphuong" id="xaphuong">
                                                @foreach($xa as $t)
                                                    <option value="{{$t->xaid}}" {{$user->xaid==$t->xaid?"selected":""}}>{{$t->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Địa chỉ cụ thể</label>
                                            <input type="text" name="diachi" value="{{\Illuminate\Support\Facades\Auth::user()->diaChi}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>CCCD</label>
                                            <input type="text" name="cccd" value="{{\Illuminate\Support\Facades\Auth::user()->cccd}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>SĐT</label>
                                            <input type="text" name="sdt" value="{{\Illuminate\Support\Facades\Auth::user()->SDT}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Email</label>
                                            <input type="text" name="email" disabled value="{{\Illuminate\Support\Facades\Auth::user()->taiKhoan}}">
                                        </div>

                                        <div class="default-form-box mb-20">
                                            <label>Sinh nhật</label>
                                            <?php
                                            $ngaySinh = \Illuminate\Support\Facades\Auth::user()->ngaySinh;
                                            $formattedNgaySinh = date('Y-m-d', strtotime($ngaySinh));
                                            ?>
                                            <input type="date" name="birthday" value="{{ $formattedNgaySinh }}">
                                        </div>
                                        <span class="example">
                                                (E.g.: 05/31/1970)
                                            </span>
                                        <br>
                                        <div class="save_button mt-3">
                                            <button class="btn btn-md btn-black-default-hover"
                                                    type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Account Dashboard Section:::... -->
<script>
    function togglePasswords() {
        console.log('sss');
        var showPasswordsCheckbox = document.getElementById("showPasswordsCheckbox");
        var passwordInputs = document.querySelectorAll("input[type='password']");
        passwordInputs.forEach(function(passwordInput) {
            passwordInput.type = showPasswordsCheckbox.checked ? "text" : "password";
        });
    }
    document.getElementById("showPasswordsCheckbox").addEventListener("change", togglePasswords);
    function updateSelect(stt) {
        if(stt!=-1){
            var id_tinh = document.getElementById("country");
            var id_huyen = document.getElementById("quanhuyen");
            var id_xa = document.getElementById("xaphuong");
            console.log(1);
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
</script>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('select').niceSelect('destroy');
        });
    </script>
@endsection
