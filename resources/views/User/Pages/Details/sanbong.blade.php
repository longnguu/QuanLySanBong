@extends('User.main')
@section('head')
    <style>

        .btn-checkbox {
            display: block;
            margin-bottom: 10px;
        }
        .btn-secondary{
            background-color: #b3d7ff!important;
        }
        .btn-primary{
            background-color: #0a58ca!important;
        }
        .btn-danger{
            background-color: red!important;
        }

        .btn-checkbox label {
            width: 100%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-checkbox input {
            position: absolute;
            clip: rect(0, 0, 0, 0);
        }

        .btn-group-toggle {
            display: flex;
            flex-wrap: wrap;
        }

        .modal-body {
            padding: 15px;
        }

        .modal-footer {
            justify-content: flex-start;
            padding: 15px;
        }

        .btn-checkbox input:checked + label {
            background-color: #007bff;
            color: #fff;
        }
        .lds-roller {
            display: inline-block;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
        }
        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
        }
        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: black;
            margin: -4px 0 0 -4px;
        }
        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
            top: 63px;
            left: 63px;
        }
        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
            top: 68px;
            left: 56px;
        }
        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
            top: 71px;
            left: 48px;
        }
        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }
        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
            top: 71px;
            left: 32px;
        }
        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
            top: 68px;
            left: 24px;
        }
        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
            top: 63px;
            left: 17px;
        }
        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12px;
        }
        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .overlayXN {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .confirmation-boxXN {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .confirmation-boxXN h2 {
            color: #333;
        }

        button {
            padding: 10px;
            /*background: #3498db;*/
            /*color: #fff;*/
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <!-- Offcanvas Overlay -->
    <div id="overlayXN" class="overlayXN">
        <div class="confirmation-boxXN">
            <h2>Xác nhận Thuê Dịch Vụ</h2>
            <p id="serviceName"></p>
            <p id="rentalTime"></p>
            <p id="endTime"></p>
            <p id="servicePrice"></p>
            <button onclick="closeOverlay()">Đóng</button>
        </div>
    </div>
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Đặt thuê sân</h3>
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
                            <h6 class="sidebar-title">Cơ sở</h6>
                            <div class="sidebar-content">
                                @php
                                    $list_coso = \Illuminate\Support\Facades\DB::table('coso')->get();
                                @endphp
                                <!-- Start Sort Select Option -->
                                <div class="sort-select-list d-flex align-items-center">
                                    <label class="mr-2">Cơ sở:</label>
                                    <fieldset>
                                        <select name="CoSo" id="CoSo" style="width: 100%;" onchange="filterSanBong()">
                                            <option value="-1">Tất cả</option>
                                            @foreach($list_coso as $cs)
                                                <option value="{{$cs->maCoSo}}">{{$cs->tenCoSo}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->

                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Lọc theo giá thuê</h6>
                            <div class="sidebar-content">
                                <div id="slider-range"></div>
                                <div class="filter-type-price">
                                    <label for="amount">Price range:</label>
                                    <input type="text" id="amount" onchange="filterSanBong()">
                                </div>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->


                        <!-- Start Single Sidebar Widget -->
{{--                        <div class="sidebar-single-widget">--}}
{{--                            <div class="sidebar-content">--}}
{{--                                <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">--}}
{{--                                    <img class="img-fluid" src="pageuser/assets/images/banner/side-banner.jpg" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div> <!-- End Single Sidebar Widget -->--}}

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
                                            <span id="countactive">{{$product->count()}} Sân sẵn sàng sử dụng</span>
                                        </div> <!-- End Page Amount -->
                                    </div> <!-- End Sort tab Button -->
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sắp xếp theo:</label>
                                        <fieldset>
                                            <select name="speed" id="speed" onchange="filterSanBong1()">
                                                <option value="1" selected="selected">Xếp theo tên: A-Z</option>
                                                <option value="2">Xếp theo tên: Z-A</option>
                                                <option value="3">Xếp theo giá: thấp đến cao</option>
                                                <option value="4">Xếp theo giá: cao đến thấp</option>
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
                                        <label class="mr-2">Thời gian thuê:</label>
                                        <div style="display: flex; align-items: center;">
{{--                                            <button onclick="decreaseValue()" >-</button>--}}
                                            <input type="number" name="slthue" id="slthue" value="1" style="max-width: 70px; border: black; text-align: center;" oninput="filterSanBong1()" onkeydown="return false" />
{{--                                            <button onclick="increaseValue()" style="top:50%">+</button>--}}
                                            Giờ
                                        </div>
                                        <fieldset>
                                            <input type="hidden" name="loaihinh" id="loaihinh" value="1">
{{--                                            <select name="loaihinh" id="loaihinh" onchange="filterSanBong1()">--}}
{{--                                                <option value="1" selected="selected">Giờ</option>--}}
{{--                                                <option value="7">Tuần</option>--}}
{{--                                                <option value="30">Tháng</option>--}}
{{--                                            </select>--}}
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
                                                                        href="product-details-default.html">{{$pr->tenSan}}</a></h5>
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
                                                                       data-bs-target="#"
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
            if (time < formattedDateTime) {
                startDateInput.value = formattedDateTime;
                alert("Vui lòng chọn thời gian lớn hơn hiện tại")
            }
            filterSanBong1();
        }
        function filterSanBong(){
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
            var slthue = document.getElementById("slthue").value;
            var time=startDateInput.value.replace("T", " ");
            var thongbao = document.getElementById("thongbaothem");

            var url = "{{ route('user.addtocartt') }}";
            var data = {
                maSan:maSan,
                time:time,
                slthue:slthue,
                loaihinh:loaihinh
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
        function AjaxCartNangCao(clickedElement,ngay,thu){
            var maSan = $(clickedElement).data('masan');
            // console.log(maSan);
            var loaihinh = document.getElementById("loaihinh").value;
            var startDateInput = document.getElementById("NBD");
            var slthue = document.getElementById("slthue").value;
            var time=startDateInput.value.replace("T", " ");
            var thongbao = document.getElementById("AjaxNC");
            if ($(clickedElement).is("select")) {
                var ngay = $(clickedElement).val();
            }


            var url = "{{ route('user.addtocarttNC') }}";
            var data = {
                maSan:maSan,
                time:time,
                slthue:slthue,
                loaihinh:loaihinh,
                ngay:ngay,
                thu:thu,
            };
            console.log(data)
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                    if(thu!=null && ngay != null){
                        // console.log(dat);
                        thongbao.style.display='none';
                        toastr.info(JSON.parse(data).thongbao);
                    }else{
                        thongbao.innerHTML="";
                        thongbao.innerHTML=data;
                        thongbao.style.display='block';
                    }

                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });


        }
        function filterSanBong1(){
            var speed = document.getElementById("speed").value;
            var loaihinh = document.getElementById("loaihinh").value;
            var slthue = document.getElementById("slthue").value;
            var startDateInput = document.getElementById("NBD");
            var time=startDateInput.value.replace("T", " ");
            var url = "{{ route('filterSB') }}";
            var data = {
                time:time,
                loaihinh:loaihinh,
                slthue:slthue,
                sort:speed,
            };
            document.getElementById("loading-overlay").style.display = "block";
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                    var $noidung = document.getElementById('callAjax1');
                    $noidung.innerHTML=data;
                    document.getElementById("loading-overlay").style.display = "none";
                    filterSanBong();
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                    document.getElementById("loading-overlay").style.display = "none";
                }
            });
        }
        $(document).ready(function () {
            var maxValue = <?php $pr= \Illuminate\Support\Facades\DB::table('sanbong')->orderBy('giaDichVu','desc')->first();echo $pr->giaDichVu?>;
            var minValue = <?php $pr= \Illuminate\Support\Facades\DB::table('sanbong')->orderBy('giaDichVu')->first();echo $pr->giaDichVu?>;
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
        function showConfirmationOverlay() {
            // Lấy thông tin từ form hoặc từ dữ liệu bạn có
            var serviceName = "Dịch Vụ XYZ"; // Thay đổi thành tên dịch vụ thực tế
            var rentalTime = "01/01/2023 08:00 AM"; // Thời gian thuê
            var endTime = "01/01/2023 05:00 PM"; // Thời gian kết thúc
            var servicePrice = "$50"; // Giá dịch vụ

            // Hiển thị thông tin trong overlay
            // document.getElementById("serviceName").innerText = "Dịch Vụ: " + serviceName;
            // document.getElementById("rentalTime").innerText = "Thời Gian Thuê: " + rentalTime;
            // document.getElementById("endTime").innerText = "Thời Gian Kết Thúc: " + endTime;
            // document.getElementById("servicePrice").innerText = "Giá Dịch Vụ: " + servicePrice;

            document.getElementById("overlayXN").style.display = "flex";
        }

        function closeOverlay() {
            // Ẩn overlay khi đóng
            document.getElementById("overlayXN").style.display = "none";
        }
        function increaseValue() {
            var inputElement = document.getElementById("slthue");
            inputElement.stepUp();
            filterSanBong1();
        }

        function decreaseValue() {
            var inputElement = document.getElementById("slthue");
            inputElement.stepDown();
            filterSanBong1();
        }
    </script>
    <div id="AjaxNC" class="custom-alert">

    </div>

    <script>

        function getSelectedDays(btn) {
            var selectedDays = [];
            var selectedDays1 = [];
            $(".btn-checkbox input:checked").each(function() {
                selectedDays.push($(this).parent().text().trim());
                selectedDays1.push($(this).val());
            });
            var ngay = document.getElementById('ngayyy').value;

            console.log(ngay,selectedDays1,selectedDays);
            if(selectedDays1.length==0){
                toastr.error("Vui lòng chọn ít nhất 1 ngày");
            }else{
                AjaxCartNangCao(btn,ngay,selectedDays1);
            }
        }
        function updateButtonColor(checkbox) {
            var label = $(checkbox).parent();
            if (checkbox.checked) {
                label.addClass("btn-primary");
                label.removeClass("btn-secondary");
            } else {
                label.removeClass("btn-primary");
                label.addClass("btn-secondary");
            }
        }
        function hiddenKK(){
            var thongbao = document.getElementById("AjaxNC");
            thongbao.style.display="none";
        }
    </script>
@endsection
