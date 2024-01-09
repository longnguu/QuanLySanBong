@extends('User.main')
@section('head')
    <style>
        .img-fluid{
            min-height: 320px;
            min-width: 320px;
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
                        <h3 class="breadcrumb-title">Vật phẩm</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Shop Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-3">
                    <!-- Start Sidebar Area -->
                    <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Loại vật phẩm</h6>
                            <div class="sidebar-content">
                                @php
                                    $list_coso = \Illuminate\Support\Facades\DB::table('loaiVP')->get();
                                @endphp
                                    <!-- Start Sort Select Option -->
                                <div class="sort-select-list d-flex align-items-center">
                                    <label class="mr-2">Loại:</label>
                                    <fieldset>
                                        <select name="CoSo" id="CoSo" style="width: 100%;" onchange="filterSanBong()">
                                            <option value="-1">Tất cả</option>
                                            @foreach($list_coso as $cs)
                                                <option value="{{$cs->maLoaiVP}}">{{$cs->tenLoaiVP}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Lọc theo giá</h6>
                            <div class="sidebar-content">
                                <div id="slider-range"></div>
                                <div class="filter-type-price">
                                    <label for="amount">Price range:</label>
                                    <input type="text" style="width: fit-content" id="amount" onchange="filterSanBong()">
                                </div>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->


                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <div class="sidebar-content">
                                <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">
                                    <img class="img-fluid" src="pageuser/assets/images/banner/side-banner.jpg" alt="">
                                </a>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->

                    </div> <!-- End Sidebar Area -->
                </div>
                <div class="col-lg-9" id="callAjax" style="margin-bottom: 10%">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column"
                                     data-aos="fade-up" data-aos-delay="0">
                                    <!-- Start Sort tab Button -->
                                    <div class="sort-tablist d-flex align-items-center">
                                        <ul class="tablist nav sort-tab-btn">
                                            <li><a class="nav-link active" data-bs-toggle="tab"
                                                   href="#layout-3-grid"><img src="pageuser/assets/images/icons/bkg_grid.png"
                                                                              alt=""></a></li>
                                            <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img
                                                        src="pageuser/assets/images/icons/bkg_list.png" alt=""></a></li>
                                        </ul>

                                        <!-- Start Page Amount -->
                                        <div class="page-amount ml-2">
                                            <span id="countactive">{{$product->count()}} Sản phẩm có sẵn</span>
                                        </div> <!-- End Page Amount -->
                                    </div> <!-- End Sort tab Button -->
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sắp xếp theo:</label>
                                        <fieldset>
                                            <select name="speed" id="speed" onchange="filterSanBong()">
                                                <option value="1">Xếp theo đánh giá</option>
                                                <option value="2">Xếp theo phổ biến</option>
                                                <option value="3" selected="selected">Xếp theo tên: A-Z</option>
                                                <option value="4">Xếp theo tên: Z-A</option>
                                                <option value="5">Xếp theo giá: cao đến thấp</option>
                                                <option value="6">Xếp theo giá: thấp đến cao</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column"
                                     data-aos="fade-up" data-aos-delay="0">
                                    <!-- Start Sort tab Button -->
                                    <div class="d-flex align-items-center">
                                        <label class="mr-2" for="NBD">Chọn thời gian thuê:</label>
                                        <input type="datetime-local" id="NBD" name="NBD" oninput="setMinEndDate()" step="86400" min="{{ now()->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="sort-select-list d-flex align-items-center" style="margin-top: 20px">
                                        <label class="mr-2">Loại hình thuê:</label>
                                        <fieldset>
                                            <select name="loaihinh" id="loaihinh" onchange="filterSanBong1()">
                                                <option value="1" selected="selected">Thuê theo giờ</option>
                                                <option value="7">Thuê theo tuần</option>
                                                <option value="30">Thuê theo tháng</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom" id="callAjax1">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                            <div class="row">
                                                <!-- Start Product Default Single Item -->
                                            </div>
                                        </div> <!-- End Grid View Product -->

                                        <!-- Start List View Product -->
                                        <div class="tab-pane sort-layout-single" id="layout-list">
                                            <div class="row">
                                                @foreach($product as $pr)
                                                    <div class="col-12">
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
                                                                        href="product-details-default.html">{{$pr->tenVatPham}}</a></h5>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                                </ul>
                                                                <span class="product-list-price">{{ number_format($pr->donGiaBan, "0", "0", ".") }} VNĐ/h</span>
                                                                <p>{{$pr->moTa}}</p>
                                                                <div class="product-action-icon-link-list">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                       data-bs-target="#modalAddcart"
                                                                       class="btn btn-lg btn-black-default-hover">Add to
                                                                        cart</a>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                       data-bs-target="#modalQuickview"
                                                                       class="btn btn-lg btn-black-default-hover"><i
                                                                            class="icon-magnifier"></i></a>
                                                                    <a href="wishlist.html"
                                                                       class="btn btn-lg btn-black-default-hover"><i
                                                                            class="icon-heart"></i></a>
                                                                    <a href="compare.html"
                                                                       class="btn btn-lg btn-black-default-hover"><i
                                                                            class="icon-shuffle"></i></a>
                                                                </div>
                                                            </div>
                                                        </div> <!-- End Product Defautlt Single -->
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div> <!-- End List View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Wrapper -->
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Shop Section:::... -->
@endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentDateTime = new Date();
            currentDateTime.setHours(currentDateTime.getHours() + 8);
            currentDateTime.setMinutes(0);
            currentDateTime.setSeconds(0);
            var formattedDateTime = currentDateTime.toISOString().slice(0, 16).replace("T", " ");
            document.getElementById("NBD").value = formattedDateTime;
            filterSanBong1();
        });
        function setMinEndDate() {
            var startDateInput = document.getElementById("NBD");
            var selectedDateTime = new Date(startDateInput.value);
            var minutes = selectedDateTime.getMinutes();
            selectedDateTime.setHours(selectedDateTime.getHours() + 8);
            selectedDateTime.setMinutes(0);
            selectedDateTime.setSeconds(0);
            if (minutes > 0){
                startDateInput.value = selectedDateTime = selectedDateTime.toISOString().slice(0, 16).replace("T", " ");
                alert("Vui lòng chọn giờ chẵn")
            }
            var currentDateTime = new Date();
            currentDateTime.setHours(currentDateTime.getHours() + 8);
            currentDateTime.setMinutes(0);
            currentDateTime.setSeconds(0);
            var formattedDateTime = currentDateTime.toISOString().slice(0, 16).replace("T", " ");
            var time=startDateInput.value.replace("T", " ");
            console.log(time+' anbc '+formattedDateTime);
            if (time < formattedDateTime) {
                startDateInput.value = formattedDateTime;
                alert("Vui lòng chọn thời gian lớn hơn hiện tại")
            }
            filterSanBong1();
        }
        function filterSanBong(){
            var speed = document.getElementById("speed").value;
            var coso = document.getElementById("CoSo").value;
            var sliderMinValue = $("#slider-range").slider("values", 0);
            var sliderMaxValue = $("#slider-range").slider("values", 1);
            var count = document.getElementById("countactive");
            $(".product-item").hide();
            var displayProduct = $(".product-item").filter(function() {
                var macoso = $(this).data('ma-coso');
                var giaMin = parseInt($(this).data('gia-min'));
                var giaMax = parseInt($(this).data('gia-max'));
                if (coso !== '-1') {
                    return macoso == coso && giaMin >= sliderMinValue && giaMax <= sliderMaxValue;
                    console.log(1);
                }
                return giaMin >= sliderMinValue && giaMax <= sliderMaxValue;
            }).show();
            count.innerHTML= displayProduct.length/2 + " Sân sẵn sàng sử dụng";
        }
        function AjaxCart(clickedElement){
            var maSan = $(clickedElement).data('masan');
            var loaihinh = document.getElementById("loaihinh").value;
            var startDateInput = document.getElementById("NBD");
            var time=startDateInput.value.replace("T", " ");

            var url = "{{ route('user.addtocartt') }}";
            var data = {
                maSan:maSan,
                time:time,
                loaihinh:loaihinh
            };
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });


        }
        function filterSanBong1(){
            var loaihinh = document.getElementById("loaihinh").value;
            var startDateInput = document.getElementById("NBD");
            var time=startDateInput.value.replace("T", " ");
            var url = "{{ route('filterSP') }}";
            var data = {
                time:time,
                loaihinh:loaihinh
            };
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                    var $noidung = document.getElementById('callAjax1');
                    $noidung.innerHTML=data;
                    filterSanBong();
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
        $(document).ready(function () {
            var maxValue = <?php $pr= \Illuminate\Support\Facades\DB::table('vatpham')->orderBy('donGiaBan','desc')->first();echo $pr->donGiaBan?>;
            var minValue = <?php $pr= \Illuminate\Support\Facades\DB::table('vatpham')->orderBy('donGiaBan')->first();echo $pr->donGiaBan?>;
            // Khởi tạo slider range
            $("#slider-range").slider({
                range: true,
                min: minValue,
                max: maxValue,
                values: [minValue, maxValue],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                },
                stop: function (event, ui) {
                    filterSanBong();
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });
    </script>
@endsection
