<!-- Start Grid View Product -->
<div class="tab-pane active show sort-layout-single" id="layout-3-grid">
    <div class="row">
        <!-- Start Product Default Single Item -->
        @foreach($product as $pr)
{{--            {{dd($product)}}--}}
            <div class="col-xl-4 col-sm-6 col-12 product-item"
                 data-ma-coso="{{ $pr->maCoSo }}"
                 data-gia-min="{{ $pr->giaDichVu }}"
                 data-gia-max="{{ $pr->giaDichVu }}"
                 data-abc="1">
                <div class="product-default-single-item product-color--pink swiper-slide">
                    <div class="image-box">
                        <a class="image-link">
                            <img src="pageuser/assets/images/sanbong/sanbong1.jpg" alt="">
                            <img src="pageuser/assets/images/sanbong/sanbong2.jpg" alt="">
                        </a>
                        <div class="tag" >
                            @if($pr->trangThai==2)
                                <span>
                                    Bảo trì
                                </span>
                            @elseif($pr->stt==1)
                                <span>
                                    Bận
                                </span>
                            @else
                                <span style="background-color: springgreen">
                                    Hoạt động
                                </span>
                            @endif
                        </div>
                        <div class="action-link">
                            <div class="action-link-left">
                                <a href="#" data-bs-toggle="modal"
                                   data-bs-target="#modalAddcart" data-masan="{{$pr->maSan}}" onclick="AjaxCart(this)">Đặt thuê ngay</a>
                            </div>
{{--                            <div class="action-link-left">--}}
{{--                                <a href="#" data-bs-toggle="modal"--}}
{{--                                   data-bs-target="#modalAddcart" data-masan="{{$pr->maSan}}" onclick="AjaxCart(this)">Thuê ngay</a>--}}
{{--                            </div>--}}
{{--                            <div class="action-link-right">--}}
{{--                                <a href="#" data-bs-toggle="modal"--}}
{{--                                   data-bs-target="#modalQuickview"><i--}}
{{--                                        class="icon-eye"></i></a>--}}
{{--                                <a href="wishlist.html"><i class="icon-heart"></i></a>--}}
{{--                                <a href="compare.html"><i class="icon-shuffle"></i></a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="content">
                        <div class="content-left">
                            <h6 class="title"><a href="#">{{$pr->tenSan}}</a></h6>
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
                                {{ number_format($pr->giaDichVu, "0", "0", ".") }} VNĐ/h
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- End Product Default Single Item -->
    </div>
</div> <!-- End Grid View Product -->

<!-- Start List View Product -->
<div class="tab-pane sort-layout-single" id="layout-list">
    <div class="row">
        @foreach($product as $pr)
            <div class="col-12 product-item"
                 data-ma-coso="{{ $pr->maCoSo }}"
                 data-gia-min="{{ $pr->giaDichVu }}"
                 data-gia-max="{{ $pr->giaDichVu }}">
                <!-- Start Product Defautlt Single -->
                <div class="product-list-single product-color--golden">
                    <a href="product-details-default.html"
                       class="product-list-img-link" style="max-width: 320px;max-height: 208px">
                        <img class="img-fluid"
                             src="pageuser/assets/images/sanbong/sanbong1.jpg"
                             alt="">
                        <img class="img-fluid"
                             src="pageuser/assets/images/sanbong/sanbong2.jpg"
                             alt="">
                    </a>
                    <div class="product-list-content">
                        <h5 class="product-list-link"><a
                                href="product-details-default.html">{{$pr->tenSan}}</a>
                                @if($pr->trangThai==2)
                                    <span style="background-color: red">
                                    Bảo trì
                                </span>
                                @elseif($pr->stt==1)
                                    <span style="background-color: red">
                                    Bận
                                </span>
                                @else
                                    <span style="background-color: springgreen">
                                    Hoạt động
                                </span>
                                @endif
                        </h5>
                        <ul class="review-star">
                            <li class="fill"><i class="ion-android-star"></i></li>
                            <li class="fill"><i class="ion-android-star"></i></li>
                            <li class="fill"><i class="ion-android-star"></i></li>
                            <li class="fill"><i class="ion-android-star"></i></li>
                            <li class="empty"><i class="ion-android-star"></i></li>
                        </ul>
                        <span class="product-list-price">{{ number_format($pr->giaDichVu, "0", "0", ".") }} VNĐ/h</span>
                        <p>{{$pr->moTa}}</p>
                        <div class="product-action-icon-link-list">
                            <a href="#" data-bs-toggle="modal"
                               data-bs-target="#modalAddcart"
                               class="btn btn-lg btn-black-default-hover">Đặt thuê ngay</a>
{{--                            <a href="#" data-bs-toggle="modal"--}}
{{--                               data-bs-target="#modalQuickview"--}}
{{--                               class="btn btn-lg btn-black-default-hover"><i--}}
{{--                                    class="icon-magnifier"></i></a>--}}
{{--                            <a href="wishlist.html"--}}
{{--                               class="btn btn-lg btn-black-default-hover"><i--}}
{{--                                    class="icon-heart"></i></a>--}}
{{--                            <a href="compare.html"--}}
{{--                               class="btn btn-lg btn-black-default-hover"><i--}}
{{--                                    class="icon-shuffle"></i></a>--}}
                        </div>
                    </div>
                </div> <!-- End Product Defautlt Single -->
            </div>
        @endforeach
    </div>
</div> <!-- End List View Product -->
