@extends('User.main')
@section('content')
    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- Start Hero Slider Section-->
    <div class="hero-slider-section">
        <!-- Slider main container -->
        <div class="hero-slider-active swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Start Hero Single Slider Item -->
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                        <img src="pageuser/assets/images/hero-slider/home-3/hero-slider-2.jpg" alt="">
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content" style="right:10%;text-align: right">
                                        <h4 class="subtitle" style="color: white">Đặt sân</h4>
                                        <h1 class="title" style="color: white">Để nhận ngay<br> vô vàn ưu đãi</h1>
                                        <a href="{{route('details')}}" class="btn btn-lg btn-pink">Đặt sân ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
                <!-- Start Hero Single Slider Item -->
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                        <img src="pageuser/assets/images/hero-slider/home-3/hero-slider-1.jpg" alt="">
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <h4 class="subtitle" style="color: white">Bạn thiếu dụng cụ?</h4>
                                        <h1 class="title" style="color: white">Đừng lo! <br>Chúng tôi có hết </h1>
                                        <a href="{{route('details1')}}" class="btn btn-lg btn-pink">Dạo ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination active-color-pink"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
        </div>
    </div>
    <!-- End Hero Slider Section-->

    <!-- Start Service Section -->
    <div class="service-promo-section section-top-gap-100">
        <div class="service-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                            <div class="image">
                                <img src="pageuser/assets/images/icons/service-promo-5.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">MIỄN PHÍ VẬN CHUYỂN</h6>
                                <p>Miễn phí vận chuyển trong phạm vi toàn tỉnh, miễn phí hoàn trả nếu không hài lòng</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="image">
                                <img src="pageuser/assets/images/icons/service-promo-6.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">HOÀN TIỀN 100%</h6>
                                <p>Hoàn tiền 100% hoặc đổi mới vật phẩm nếu quý khách không hài lòng</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="image">
                                <img src="pageuser/assets/images/icons/service-promo-7.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">THANH TOÁN AN TOÀN</h6>
                                <p>Thông tin giao dịch được bảo mật.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="image">
                                <img src="pageuser/assets/images/icons/service-promo-8.png" alt="">
                            </div>
                            <div class="content">
                                <h6 class="title">SẢN PHẨM CHẤT LƯỢNG</h6>
                                <p>Các sản phẩm chất lượng cao.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Section -->

    <div class="banner-section section-top-gap-100">
        <div class="banner-wrapper clearfix">
            <!-- Start Banner Single Item -->
            <a href="/thuesan">
                <div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="0">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-8-1.jpg" alt="">
                    </div>
                    <div class="row">
                        <div class="col-auto ml-5">
                            <div class="hero-slider-content">
                                <h4 class="" style="color: white">Đặt sân</h4>
                                <h1 class="" style="color: white">Xem thông tin các sân<br>và đặt lịch sử dụng. </h1>
                                <p class="btn btn-lg btn-pink">Thuê ngay</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <a href="/muaSP">
                <div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-8-2.jpg" alt="">
                    </div>
                    <div class="row">
                        <div class="col-auto ml-5">
                            <div class="hero-slider-content">
                                <h4 class="" style="color: white">Thuê dụng cụ</h4>
                                <h1 class="" style="color: white">Xem thông tin các dịch vụ<br>và đặt lịch sử dụng.</h1>
                                <p class="btn btn-lg btn-pink">Khám phá ngay</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
        </div>
    </div>
    <!-- Start Banner Section -->

    <!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">Sản phẩm mới</h3>
                                <p>Preorder now to receive exclusive deals & gifts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-2rows default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-2row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Product Default Single Item -->
                                    @foreach($product as $pr)
                                        <div class="product-default-single-item product-color--pink swiper-slide">
                                            <div class="image-box">
                                                <a href="/productDetails?id={{$pr->maVatPham}}" class="image-link">
                                                    <img src="{{asset('storage/'.$pr -> hinhAnh1)}}" alt="" style="min-width: 270px;min-height: 270px">
                                                    <img src="{{asset('storage/'.$pr -> hinhAnh2)}}" alt="">
                                                </a>
                                                <div class="action-link">
                                                    <div class="action-link-left">
                                                        <a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#" data-masan="{{$pr->maVatPham}}" onclick="AjaxCart(this)">Thêm vào giỏ hàng</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="content-left">
                                                    <h6 class="title"><a href="/productDetails?id={{$pr->maVatPham}}">{{$pr->tenVatPham}}</a></h6>
                                                </div>
                                                <div class="content-right">
                                                    <span class="price">
{{--                                                        @if($pr->maKhuyenMai>1)<del>$89.00</del>@endif--}}
                                                        {{$pr->donGiaBan}}
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach</div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Default Slider Section -->

    <!-- Start Banner Section -->
@endsection
@section('footer')
    <script>
        function AjaxCart(clickedElement){
            var maSan = $(clickedElement).data('masan');
            var thongbao = document.getElementById("thongbaothem");
            var url = "{{ route('user.addtocart') }}";
            var data = {
                maSan:maSan,
            };
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                    @if(\Illuminate\Support\Facades\Auth::check())
                        toastr.info(JSON.parse(data).thongbao);
                    @else
                        toastr.error("Bạn phải đăng nhập trước");
                    @endif
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
    </script>
@endsection
