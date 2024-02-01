@extends('User.main')
@section('content')
    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Tìm kiếm</h3>
                        <p>Kết quả tìm kiếm cho </p>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">
                                    @if($product->count()==0)
                                        Không tìm thấy sản phẩm
                                    @else
                                        Sản phẩm
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($product->count()!=0)
            <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-slider-default-2rows default-slider-nav-arrow">
                                <!-- Slider main container -->
                                <div class="swiper-container product-default-slider-4grid-2row">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
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
                                                        {{$pr->donGiaBan}}
                                                    </span>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
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
        @endif
    </div>
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">
                                    @if($user->count()==0)
                                        Không tìm thấy người dùng
                                    @else
                                        Người dùng
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($user->count()!=0)
            <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-slider-default-2rows default-slider-nav-arrow">
                                <!-- Slider main container -->
                                <div class="swiper-container product-default-slider-4grid-2row">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        @foreach($user as $pr)
                                            <div class="product-default-single-item product-color--pink swiper-slide">
                                                <div class="image-box">
                                                    <a href="/productDetails?id={{$pr->maNguoiDung}}" class="image-link">
                                                        <img src="{{asset('storage/'.$pr -> hinhAnh)}}" alt="">
                                                        <img src="{{asset('storage/'.$pr -> hinhAnh)}}" alt="">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <div class="content-left">
                                                        <h6 class="title"><a href="/productDetails?id={{$pr->maNguoiDung}}">{{$pr->ho.' '.$pr->ten}}</a></h6>
                                                    </div>
                                                    <div class="content-right">
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
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
        @endif
    </div>
@endsection
@section('footer')
    <script>
        function AjaxCart(clickedElement){
            var maSan = $(clickedElement).data('masan');
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
