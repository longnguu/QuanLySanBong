@extends('User.main')
@section('head')
    <style>
        .img_mmm{
            min-height: 111.25px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Chi tiết sản phẩm {{$product->tenVatPham}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start Product Details Section -->
    <div class="product-details-section" style="margin-bottom: 50px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                            <div class="swiper-wrapper">
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    @if($product->hinhAnh1==null)
                                        <img class="img-fluid" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid" src="{{asset('storage/'.$product->hinhAnh1)}}"
                                             alt="">
                                    @endif
                                </div>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    @if($product->hinhAnh2==null)
                                        <img class="img-fluid" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid" src="{{asset('storage/'.$product->hinhAnh2)}}"
                                             alt="">
                                    @endif
                                </div>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    @if($product->hinhAnh3==null)
                                        <img class="img-fluid" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid" src="{{asset('storage/'.$product->hinhAnh3)}}"
                                             alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div
                            class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                            <div class="swiper-wrapper">
                                <div class="product-image-thumb-single swiper-slide">
                                    @if($product->hinhAnh1==null)
                                        <img class="img-fluid img_mmm" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid img_mmm" src="{{asset('storage/'.$product->hinhAnh1)}}"
                                             alt="">
                                    @endif

                                </div>
                                <div class="product-image-thumb-single swiper-slide">
                                    @if($product->hinhAnh2==null)
                                        <img class="img-fluid img_mmm" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid img_mmm" src="{{asset('storage/'.$product->hinhAnh2)}}"
                                             alt="">
                                    @endif
                                </div>
                                <div class="product-image-thumb-single swiper-slide">
                                    @if($product->hinhAnh3==null)
                                        <img class="img-fluid img_mmm" src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                             alt="">
                                    @else
                                        <img class="img-fluid img_mmm" src="{{asset('storage/'.$product->hinhAnh3)}}"
                                             alt="">
                                    @endif
                                </div>
                            </div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                         data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title">{{$product->tenVatPham}}</h4>
                            <div class="price">{{$product->donGiaBan}} VNĐ  ({{$product->donGiaThue}}/h)</div>
                            <p>{!! $product->moTa !!}</p>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <div class="d-flex align-items-center ">
                                <div class="variable-single-item ">
                                    <span>Số lượng</span>
                                    <div class="product-variable-quantity">
                                        <input min="1" id="soluongthem" max="{{$product->soLuongCon}}" value="1" name ="sl" type="number">
                                    </div>
                                </div>

                                <div class="product-add-to-cart-btn">
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#modalAddcart" data-masan="{{$product->maVatPham}}" onclick="AjaxCart(this)">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div> <!-- End Product Variable Area -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->
@endsection
@section('footer')
    <script>
        function AjaxCart(clickedElement){
            var maSan = $(clickedElement).data('masan');
            var thongbao = document.getElementById("thongbaothem");
            var sl= document.getElementById('soluongthem').value;
            console.log(sl);

            var url = "{{ route('user.addtocart') }}";
            var data = {
                maSan:maSan,
                soluong:sl,
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
