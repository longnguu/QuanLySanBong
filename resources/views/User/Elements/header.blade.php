<!-- Start Header Area -->
@php
    $phongnhantin=null;
    if (\Illuminate\Support\Facades\Auth::check()){
        $phongnhantin =DB::table('phongnhantin')
            ->where(function ($query) {
                $query->where('nd1', '=', Auth::user()->maNguoiDung)
                    ->orWhere('nd2', '=', Auth::user()->maNguoiDung);
            })
            ->distinct()
            ->get();
//        $phongnhantin =  \Illuminate\Support\Facades\DB::table('phongnhantin')
//            ->join('chitietphongnt','phongnhantin.id','=','chitietphongnt.idPhongNT')
//            ->rightJoin('tinnhan','tinnhan.id','=','phongnhantin.id')
//            ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
//            ->select('phongnhantin.*')
//            ->get();
    }
@endphp
@section('header')
    <style>
        .sssnw p {
            white-space: nowrap;
        }
    </style>
@endsection
<header class="header-section d-none d-xl-block">
    <div class="header-wrapper">
        <div class="header-bottom header-bottom-color--green section-fluid sticky-header sticky-color--white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Start Header Logo -->
                        <div class="header-logo">
                            <div class="logo">
                                <a href="/"><img src="{{asset('/pageuser/assets/images/icons/logo-icon.png')}}" style="max-width: 50px" alt=""></a>
                            </div>
                        </div>
                        <!-- End Header Logo -->
                        <!-- Start Header Main Menu -->
                        <div class="main-menu menu-color--black menu-hover-color--green">
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="/">Trang chủ</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="#">Dịch vụ<i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            <li><a href="{{route('details')}}">Thuê sân</a></li>
                                            <li><a href="{{route('details1')}}">Mua dụng cụ</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a
{{--                                            @if(\Illuminate\Support\Facades\Route::is('gioithieu'))--}}
{{--                                                style="color:#ff365d"--}}
{{--                                            @endif--}}
                                            class="main-menu-link" href="/gioithieu">Giới thiệu</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="#">Chính sách<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="/dieukhoan&chinhsach">Điều khoản & dịch vụ</a></li>
                                            <li><a href="{{route('chinhsach')}}">Chính sách đặt/trả sân</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="/lienhe">Liên hệ</a>
                                    </li>
                                    <li class="has-dropdown">

                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                <a href="#">{{\Illuminate\Support\Facades\Auth::check()?\Illuminate\Support\Facades\Auth::user()->ten:"Đăng nhập"}}
                                                <i class="fa fa-angle-down"></i>
                                            @else
                                                <a href="/login">{{\Illuminate\Support\Facades\Auth::check()?\Illuminate\Support\Facades\Auth::user()->ten:"Đăng nhập"}}
                                            @endif

                                        </a>
                                        <!-- Sub Menu -->
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <ul class="sub-menu">
                                                <li><a href="{{route('user.naptien')}}">Số dư: {{\Illuminate\Support\Facades\Auth::user()->soDuTaiKhoan}}</a></li>
                                                @if(@\Illuminate\Support\Facades\Auth::user()->maQuyen==1)
                                                    <li><a href="/admin">Quản trị</a></li>
                                                @endif
                                                @if(@\Illuminate\Support\Facades\Auth::user()->maQuyen==2)
                                                    <li><a href="/admin">Quản trị</a></li>
                                                @endif
                                                <li><a href="/profile">Thông tin cá nhân</a></li>
                                                <li><a href="/donhang">Quản lý dịch vụ</a></li>
                                                <li><a href="/logout">Đăng xuất</a></li>
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Header Main Menu Start -->

                        <!-- Start Header Action Link -->
                        <ul class="header-action-link action-color--black action-hover-color--green">
                            <li>
                                <a href="#offcanvas-message" class="offcanvas-toggle">
                                    <i class="far fa-comment"></i>
{{--                                    <span class="item-count">3</span>--}}
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-notification" class="offcanvas-toggle">
                                    <i class="far fa-bell"></i>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <span class="item-count" id="thongbao_count">
                                            {{ \Illuminate\Support\Facades\DB::table('thongbao')
                                            ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
                                            ->where('daXem','=',0)
                                            ->count()
                                        }}
                                        </span>
                                    @endif
{{--                                    <span class="item-count">3</span>--}}
                                </a>
                            </li>
                            <li>
                                <a href="/cart">
                                    <i class="icon-bag"></i>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <span class="item-count">
                                            {{ \Illuminate\Support\Facades\DB::table('giohang')
                                            ->where(function ($query) {
                                                $query->where('maVatPham', '<>', null)
                                                    ->where('maSan', '=', null)
                                                    ->where('maNguoiDung', '=', \Illuminate\Support\Facades\Auth::user()->maNguoiDung);
                                            })
                                            ->orWhere(function ($query) {
                                                $query->where('maSan', '<>', null)
                                                    ->where('maVatPham', '=', null)
                                                    ->where('maNguoiDung', '=', \Illuminate\Support\Facades\Auth::user()->maNguoiDung);
                                            })
                                            ->count()
                                        }}
                                        </span>
                                    @endif

                                </a>
                            </li>
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Header Action Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Start Header Area -->

<!-- Start Mobile Header -->
<div class="mobile-header  mobile-header-bg-color--pink section-fluid d-lg-block d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <!-- Start Mobile Left Side -->
                <div class="mobile-header-left">
                    <ul class="mobile-menu-logo">
                        <li>
                            <a href="/">
                                <div class="logo">
                                    <img src="{{asset('/pageuser/assets/images/icons/logo-icon.png')}}" style="max-width: 60px" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Left Side -->

                <!-- Start Mobile Right Side -->
                <div class="mobile-right-side">
                    <ul class="header-action-link action-color--black action-hover-color--green">
                        <li>
                            <a href="#search">
                                <i class="icon-magnifier"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-message" class="offcanvas-toggle">
                                <i class="far fa-comment"></i>
{{--                                <span class="item-count">3</span>--}}
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-notification" class="offcanvas-toggle">
                                <i class="far fa-bell"></i>
{{--                                <span class="item-count">3</span>--}}
                            </a>
                        </li>
                        <li>
                            <a href="/cart">
                                <i class="icon-bag"></i>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <span class="item-count">
                                        {{ \Illuminate\Support\Facades\DB::table('giohang')

                                            ->where(function ($query) {
                                                $query->where('maVatPham', '<>', null)
                                                    ->where('maSan', '=', null)
                                                    ->where('maNguoiDung', '=', \Illuminate\Support\Facades\Auth::user()->maNguoiDung);
                                            })
                                            ->orWhere(function ($query) {
                                                $query->where('maSan', '<>', null)
                                                    ->where('maVatPham', '=', null)
                                                    ->where('maNguoiDung', '=', \Illuminate\Support\Facades\Auth::user()->maNguoiDung);
                                            })
                                            ->count()
                                        }}

                                    </span>
                                @else
{{--                                    <span class="item-count"></span>--}}
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="#mobile-menu-offcanvas"
                               class="offcanvas-toggle offside-menu offside-menu-color--black">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Right Side -->
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Header -->

<!--  Start Offcanvas Mobile Menu Section -->
<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-mobile-menu-wrapper">
        <!-- Start Mobile Menu  -->
        <div class="mobile-menu-bottom">
            <!-- Start Mobile Menu Nav -->
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="/"><span>Trang chủ</span></a>
                    </li>
                    <li>
                        <a href="#"><span>Dịch vụ</span></a>
                        <ul class="mobile-sub-menu">
                            <li><a href="{{route('details')}}">Thuê sân</a></li>
                            <li><a href="{{route('details1')}}">Mua dụng cụ</a></li>
                        </ul>
                    </li>
                    <li><a href="/gioithieu">Giới thiệu</a></li>
                    <li>
                        <a href="#"><span>Chính sách</span></a>
                        <ul class="mobile-sub-menu">
                            <li><a href="/dieukhoan&chinhsach">Điều khoản & dịch vụ</a></li>
                            <li><a href="{{route('chinhsach')}}">Chính sách đặt/trả sân</a></li>
                        </ul>
                    </li>
                    <li><a href="/lienhe">Liên hệ</a></li>
                    <li class="has-dropdown">
                        <!-- Sub Menu -->
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="#">{{\Illuminate\Support\Facades\Auth::check()?\Illuminate\Support\Facades\Auth::user()->ten:"Đăng nhập"}}
                            </a>
                            <ul class="mobile-sub-menu">
                                <li><a href="{{route('user.naptien')}}">Số dư: {{\Illuminate\Support\Facades\Auth::user()->soDuTaiKhoan}}</a></li>
                                @if(@\Illuminate\Support\Facades\Auth::user()->maQuyen==1)
                                    <li><a href="/admin">Quản trị</a></li>
                                @endif
                                @if(@\Illuminate\Support\Facades\Auth::user()->maQuyen==2)
                                    <li><a href="/admin">Quản trị</a></li>
                                @endif
                                <li><a href="/profile">Thông tin cá nhân</a></li>
                                <li><a href="/donhang">Quản lý dịch vụ</a></li>
                                <li><a href="/logout">Đăng xuất</a></li>
                            </ul>
                        @else
                            <a href="/login">Đăng nhập</a>
                        @endif
                    </li>
                </ul>
            </div> <!-- End Mobile Menu Nav -->
        </div> <!-- End Mobile Menu -->

        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
            </div>

            <address class="address">
                <span>Address: Your address goes here.</span>
                <span>Call Us: 0123456789, 0123456789</span>
                <span>Email: demo@example.com</span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="wishlist.html">Wishlist</a></li>
                <li><a href="cart.html">Cart</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->

    </div> <!-- End Offcanvas Mobile Menu Wrapper -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <div class="logo">
        </div>

        <address class="address">
            <span>Address: Your address goes here.</span>
            <span>Call Us: 0123456789, 0123456789</span>
            <span>Email: demo@example.com</span>
        </address>

        <ul class="social-link">
            <li><a href="#"><i class="far fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>

        <ul class="user-link">
            <li><a href="wishlist.html">Wishlist</a></li>
            <li><a href="cart.html">Cart</a></li>
        </ul>
    </div>
    <!-- End Mobile contact Info -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Addcart Section -->
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Giỏ hàng</h4>
        <ul class="offcanvas-cart">
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="#" class="offcanvas-cart-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-3/default-1.jpg')}}" alt=""
                             class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="#" class="offcanvas-cart-item-link">Car Wheel</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">1 x </span>
                            <span class="offcanvas-cart-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="#" class="offcanvas-cart-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-2/default-1.jpg')}}" alt=""
                             class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="#" class="offcanvas-cart-item-link">Car Vails</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">3 x </span>
                            <span class="offcanvas-cart-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="#" class="offcanvas-cart-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-3/default-1.jpg')}}" alt=""
                             class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="#" class="offcanvas-cart-item-link">Shock Absorber</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">1 x </span>
                            <span class="offcanvas-cart-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <div class="offcanvas-cart-total-price">
            <span class="offcanvas-cart-total-price-text">Subtotal:</span>
            <span class="offcanvas-cart-total-price-value">$170.00</span>
        </div>
        <ul class="offcanvas-cart-action-button">
            <li><a href="{{route('cart')}}" class="btn btn-block btn-pink">View Cart</a></li>
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas Addcart Section -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- ENd Offcanvas Header -->

    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-3/default-1.jpg')}}" alt=""
                             class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-2/default-1.jpg')}}" alt=""
                             class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="{{asset('pageuser/assets/images/product/default/home-3/default-1.jpg')}}" alt=""
                             class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            <li><a href="#" class="btn btn-block btn-pink">View wishlist</a></li>
        </ul>
    </div> <!-- End Offcanvas Mobile Menu Wrapper -->

</div> <!-- End Offcanvas Mobile Menu Section -->

<!-- Start Offcanvas message Section -->
<div id="offcanvas-message" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Tin nhắn</h4>
        <ul class="offcanvas-cart">
            @if($phongnhantin!=null)
                @foreach($phongnhantin as $pnt)
                    @php
                        if($pnt->nd1 != \Illuminate\Support\Facades\Auth::user()->maNguoiDung){
                            $nd=\Illuminate\Support\Facades\DB::table('nguoidung')->where('maNguoiDung','=',$pnt->nd1)->select('maNguoiDung','ho','ten','hinhAnh')->first();
                            $tinnhan = \Illuminate\Support\Facades\DB::table('tinnhan')
                            ->join('phongnhantin','phongnhantin.id','=','tinnhan.idPhongNT')
                            ->where('nd1','=',$nd->maNguoiDung)
                            ->where('nd2','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
                            ->orderBy('tinnhan.id','desc')
                            ->first();
                        }else{
                            $nd=\Illuminate\Support\Facades\DB::table('nguoidung')->where('maNguoiDung','=',$pnt->nd2)->select('maNguoiDung','ho','ten','hinhAnh')->first();
                            $tinnhan = \Illuminate\Support\Facades\DB::table('tinnhan')
                            ->join('phongnhantin','phongnhantin.id','=','tinnhan.idPhongNT')
                            ->where('nd2','=',$nd->maNguoiDung)
                            ->where('nd1','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
                            ->orderBy('tinnhan.id','desc')
                            ->first();
                        }
                    @endphp
                    @if($tinnhan!=null)
                        <li class="offcanvas-cart-item-single">
                            <div class="offcanvas-cart-item-block">
                                <a href="#" class="offcanvas-cart-item-image-link">
                                    <img style="border-radius: 50%" src="{{ $nd->hinhAnh != null ? asset('storage/' . $nd->hinhAnh) : 'https://static-00.iconduck.com/assets.00/avatar-default-icon-2048x2048-h6w375ur.png' }}" alt=""
                                         class="offcanvas-cart-image">
                                </a>
                                <div class="offcanvas-cart-item-content">
                                    <a href="/chat/{{$pnt->id}}" class="offcanvas-cart-item-link">
                                        {{$nd->ho .' '.$nd->ten}}
                                    </a>
                                    <div class="offcanvas-cart-item-details" >
                                    <span id="xemTN_{{$nd->maNguoiDung}}">
                                        {!! $tinnhan !=null? ($tinnhan->maNguoiGui!=\Illuminate\Support\Facades\Auth::user()->maNguoiDung? '':'Bạn: ') . $tinnhan->noiDung:"<span style='color:red'>Chưa có tin nhắn<span>" !!}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                @endif
                @endforeach
            @endif
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas message Section -->
<!-- Start Offcanvas notification Section -->
<div id="offcanvas-notification" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Thông báo</h4>
        @php
        $thongbao=null;
            if(\Illuminate\Support\Facades\Auth::check()){
                $thongbao = \Illuminate\Support\Facades\DB::table('thongbao')
                ->where('loaiTB','=',1)
                ->OrWhere('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
                ->orderBy('id','desc')
                ->get();
            }
        @endphp
        <ul class="offcanvas-cart">
            @if($thongbao!=null)
                @foreach($thongbao as $tb)
                    <li class="offcanvas-cart-item-single" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-idtb="{{$tb->id}}" onclick="OpenMenuThongBao(this)">
                        <div class="offcanvas-cart-item-block">
                            <div class="offcanvas-cart-item-content">
                                @if($tb->daXem==0)
                                    <h4><span href="" class="offcanvas-cart-item-link" style="color: #ff964e">{!! $tb->tieuDe !!}</span></h4>
                                @else
                                    <h4><span href="" class="offcanvas-cart-item-link" style="color: #807878">{!! $tb->tieuDe !!}</span></h4>
                                @endif

                                <div class="offcanvas-cart-item-details">
                                    {!! substr($tb->noiDung, 0, 50) !!}
                                    <span class="offcanvas-cart-item-details-quantity">{{$tb->created_at}} </span>
                                </div>
                            </div>
                        </div>
{{--                        <div class="offcanvas-cart-item-delete text-right">--}}
{{--                            <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>--}}
{{--                        </div>--}}
                    </li>
                @endforeach
            @endif
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas notification Section -->

<!-- Start Offcanvas Search Bar Section -->
<div id="search" class="search-modal">
    <button type="button" class="close">×</button>
    <form action="/timkiem">
        <input type="search" name="key" placeholder="Tìm kiếm bất cứ thứ gì ở đây" />
        <button type="submit" class="btn btn-lg btn-pink">Search</button>
    </form>
</div>
<style>
    .custom-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        /*width: 60%;*/
        background-color: transparent;
        /*height: 80%;*/
        transform: translate(-50%, -50%);
        padding: 15px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999000;
        display: none;
    }
</style>
<div id="thongtinthongbao" class="custom-alert">

</div>
<!-- End Offcanvas Search Bar Section -->
