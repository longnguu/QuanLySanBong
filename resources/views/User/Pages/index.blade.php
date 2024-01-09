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
                                        <a href="{{route('details')}}" class="btn btn-lg btn-pink">Dạo ngay</a>
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
                                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
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
                                <h6 class="title">SAFE PAYMENT</h6>
                                <p>Pay with the world’s most popular and secure payment methods.</p>
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
                                <h6 class="title">LOYALTY CUSTOMER</h6>
                                <p>Card for the other 30% of their purchases at a rate of 1% cash back.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Section -->

    <!-- Start Banner Section -->
    <div class="banner-section section-top-gap-100">
        <div class="banner-wrapper clearfix">
            <!-- Start Banner Single Item -->
            <a href="product-details-default.html">
                <div class="banner-single-item banner-style-7 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="0">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-7-1.jpg" style="object-fit: cover" alt="">
                    </div>
                    <div class="row">
                        <div class="col-auto ml-5">
                            <div class="hero-slider-content">
                                <h4 class="" style="color: white">Đặt sân</h4>
                                <h1 class="" style="color: white">Xem thông tin các sân<br>và đặt lịch sử dụng. </h1>
                                <p class="btn btn-lg btn-pink">shop now </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <a href="product-details-default.html">
                <div class="banner-single-item banner-style-7 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-7-2.jpg" alt="">
                    </div>
                    <div class="row">
                        <div class="col-auto ml-5">
                            <div class="hero-slider-content">
                                <h4 class="" style="color: white">Thuê dụng cụ</h4>
                                <h1 class="" style="color: white">Xem thông tin các dịch vụ<br>và đặt lịch sử dụng.</h1>
                                <p class="btn btn-lg btn-pink">shop now </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <a href="product-details-default.html">
                <div class="banner-single-item banner-style-7 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="400">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-style-7-img-3.jpg" alt="">
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
        </div>
    </div>
    <!-- End Banner Section -->

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
                                                    <img src="{{asset('storage/'.$pr -> hinhAnh1)}}" alt="">
                                                    <img src="{{asset('storage/'.$pr -> hinhAnh2)}}" alt="">
                                                </a>
                                                <div class="action-link">
                                                    <div class="action-link-left">
                                                        <a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#modalAddcart">Add to Cart</a>
                                                    </div>
                                                    <div class="action-link-right">
                                                        <a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#modalQuickview"><i
                                                                class="icon-eye"></i></a>
                                                        <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                        <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="content-left">
                                                    <h6 class="title"><a href="/productDetails?id={{$pr->maVatPham}}">{{$pr->tenVatPham}}</a></h6>
                                                    <ul class="review-star">
                                                        <li class="fill"><i class="ion-android-star"></i></li>
                                                        <li class="fill"><i class="ion-android-star"></i></li>
                                                        <li class="fill"><i class="ion-android-star"></i></li>
                                                        <li class="fill"><i class="ion-android-star-half"></i></li>
                                                        <li class="empty"><i class="ion-android-star-half"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="content-right">
                                                    <span class="price">
{{--                                                        @if($pr->maKhuyenMai>1)<del>$89.00</del>@endif--}}
                                                        {{$pr->donGiaBan}}
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
{{--                                    @foreach($product as $pr)--}}
{{--                                        <div class="product-default-single-item product-color--pink swiper-slide">--}}
{{--                                            <div class="image-box">--}}
{{--                                                <a href="/productDetails?id={{$pr->maVatPham}}" class="image-link">--}}
{{--                                                    @if($pr->hinhAnh1!=null)--}}
{{--                                                        <img src="{{$pr->hinhAnh1}}" alt="">--}}
{{--                                                    @else--}}
{{--                                                        <img src="pageuser/assets/images/product/default/home-3/default-1.jpg" alt="">--}}
{{--                                                    @endif--}}
{{--                                                    @if($pr->hinhAnh2!=null)--}}
{{--                                                        <img src="{{$pr->hinhAnh2}}" alt="">--}}
{{--                                                    @else--}}
{{--                                                        <img src="pageuser/assets/images/product/default/home-3/default-1.jpg" alt="">--}}
{{--                                                    @endif--}}
{{--                                                    @if($pr->hinhAnh3!=null)--}}
{{--                                                        <img src="{{$pr->hinhAnh3}}" alt="">--}}
{{--                                                    @else--}}
{{--                                                        <img src="pageuser/assets/images/product/default/home-3/default-1.jpg" alt="">--}}
{{--                                                    @endif--}}
{{--                                                </a>--}}
{{--                                                @if($pr->maKhuyenMai>1)--}}
{{--                                                    <div class="tag">--}}
{{--                                                        <span>Sale</span>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                                <div class="action-link">--}}
{{--                                                    <div class="action-link-left">--}}
{{--                                                        <a href="#" data-bs-toggle="modal"--}}
{{--                                                           data-bs-target="#modalAddcart">Add to Cart</a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="action-link-right">--}}
{{--                                                        <a href="#" data-bs-toggle="modal"--}}
{{--                                                           data-bs-target="#modalQuickview"><i--}}
{{--                                                                class="icon-eye"></i></a>--}}
{{--                                                        <a href="wishlist.html"><i class="icon-heart"></i></a>--}}
{{--                                                        <a href="compare.html"><i class="icon-shuffle"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="content">--}}
{{--                                                <div class="content-left">--}}
{{--                                                    <h6 class="title"><a href="/productDetails?id={{$pr->maVatPham}}">{{$pr->tenVatPham}}</a></h6>--}}
{{--                                                    <ul class="review-star">--}}
{{--                                                        <li class="fill"><i class="ion-android-star"></i></li>--}}
{{--                                                        <li class="fill"><i class="ion-android-star"></i></li>--}}
{{--                                                        <li class="fill"><i class="ion-android-star"></i></li>--}}
{{--                                                        <li class="fill"><i class="ion-android-star-half"></i></li>--}}
{{--                                                        <li class="empty"><i class="ion-android-star-half"></i></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="content-right">--}}
{{--                                                    <span class="price">$75.00 - $85.00</span>--}}
{{--                                                    <span class="price">--}}
{{--                                                        @if($pr->maKhuyenMai>1)<del>$89.00</del>@endif--}}
{{--                                                        {{$pr->donGiaBan}}--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
                                </div>
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
    <div class="banner-section section-top-gap-100">
        <div class="banner-wrapper clearfix">
            <!-- Start Banner Single Item -->
            <a href="product-details-default.html">
                <div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="0">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-style-8-img-1.jpg" alt="">
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <a href="product-details-default.html">
                <div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="image">
                        <img class="img-fluid" src="pageuser/assets/images/banner/banner-style-8-img-2.jpg" alt="">
                    </div>
                </div>
            </a>
            <!-- End Banner Single Item -->
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-fluid section-inner-bg">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">BEST SELLERS</h3>
                                <p>Add our best sellers to your weekly lineup.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-1row default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-1row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-9.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-10.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Epicuri per
                                                        lobortis</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$68</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-11.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-3.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Kaoreet
                                                        lobortis sagit</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$95.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-5.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-7.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Condimentum
                                                        posuere</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$115.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-6.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-9.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Convallis quam
                                                        sit</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$75.00 - $85.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-1.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-2.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Aliquam
                                                        lobortis</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$75.00 - $85.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-3.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-4.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Condimentum
                                                        posuere</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><del>$89.00</del> $80.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-5.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-6.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Cras neque
                                                        metus</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><del>$70.00</del> $60.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="pageuser/assets/images/product/default/home-3/default-7.jpg" alt="">
                                                <img src="pageuser/assets/images/product/default/home-3/default-8.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i
                                                            class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Donec eu libero
                                                        ac</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$74</span>
                                            </div>

                                        </div>
                                    </div> <!-- End Product Default Single Item -->
                                </div>
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

    <!-- Start Blog Slider Section -->
    <div class="blog-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">Bài viết</h3>
{{--                                <p>Present posts in a best way to highlight interesting moments of your blog.</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="blog-wrapper" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-default-slider default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container blog-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-1.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post One</a>
                                            </h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="blog-single-sidebar-left.html"
                                                   class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post Two</a>
                                            </h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="#" class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="blog-single-sidebar-left.html" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-3.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post
                                                    Three</a></h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="blog-single-sidebar-left.html"
                                                   class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-4.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post Four</a>
                                            </h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="blog-single-sidebar-left.html"
                                                   class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post Five</a>
                                            </h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="blog-single-sidebar-left.html"
                                                   class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="blog-default-single-item blog-color--pink swiper-slide">
                                        <div class="image-box">
                                            <a href="blog-single-sidebar-left.html" class="image-link">
                                                <img class="img-fluid"
                                                     src="pageuser/assets/images/blog/blog-grid-home-1-img-6.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="blog-single-sidebar-left.html">Blog Post Six</a>
                                            </h6>
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex.
                                                Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                            <div class="inner">
                                                <a href="blog-single-sidebar-left.html"
                                                   class="read-more-btn icon-space-left">Read More <span><i
                                                            class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">24 Apr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                </div>
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
    <!-- End Blog Slider Section -->

    <!-- Start Company Logo Section -->
{{--    <div class="company-logo-section section-top-gap-100 section-fluid">--}}
{{--        <div class="company-logo-wrapper" data-aos="fade-up" data-aos-delay="0">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="company-logo-slider default-slider-nav-arrow">--}}
{{--                            <!-- Slider main container -->--}}
{{--                            <div class="swiper-container company-logo-slider">--}}
{{--                                <!-- Additional required wrapper -->--}}
{{--                                <div class="swiper-wrapper">--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-1.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-2.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-3.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-4.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-5.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-6.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-7.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                    <!-- Start Company Logo Single Item -->--}}
{{--                                    <div class="company-logo-single-item swiper-slide">--}}
{{--                                        <div class="image"><img class="img-fluid"--}}
{{--                                                                src="pageuser/assets/images/company-logo/company-logo-8.png" alt=""></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Company Logo Single Item -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- If we need navigation buttons -->--}}
{{--                            <div class="swiper-button-prev d-none d-md-block"></div>--}}
{{--                            <div class="swiper-button-next d-none d-md-block"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Company Logo Section -->
@endsection