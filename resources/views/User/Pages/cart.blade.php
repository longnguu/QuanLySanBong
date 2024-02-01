@extends('User.main')
@section('head')
    <style>
        .sub-row {
            /*display: none;*/
            background-color: #f0f0f0;
        }
        select{
            width: 100%;
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
                        <h3 class="breadcrumb-title">Giỏ hàng</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
{{--    {{dd($cart,$vatpham)}}--}}
    @if($cart->count()==0 && $cart1->count()==0)
        <div class="empty-cart-section section-fluid" style="margin-bottom: 100px">
            <div class="emptycart-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                            <div class="emptycart-content text-center">
                                <div class="image">
                                    <img class="img-fluid" src="pageuser/assets/images/emprt-cart/empty-cart.png" alt="">
                                </div>
                                <h4 class="title">Your Cart is Empty</h4>
                                <h6 class="sub-title">Sorry Mate... No item Found inside your cart!</h6>
                                <a href="{{route('HomePage')}}" class="btn btn-lg btn-golden">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cart-section">
            <!-- Start Cart Table -->
            <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <div class="table_page table-responsive">
                                    <h3 class="m-5">Thuê sân</h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_remove">Trạng thái</th>
                                            <th class="product_thumb">Hình Ảnh</th>
                                            <th class="product_name">Sản phẩm</th>
                                            <th class="product-price">Thời gian nhận</th>
                                            <th class="product_quantity">Thời gian trả</th>
                                            <th class="product_total">Tổng</th>
                                            <th class="product_remove">#</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cartUpdate">
                                        @foreach($cart1 as $c1)
                                            @if ($c1->maVatPham==null and $c1->maSan!=null)
                                                <tr>
                                                    <td class="product_remove"><input type="checkbox" class="checkboxselect" data-id="{{$c1->id}}" {{$c1->tt==1?"checked":""}}/></td>
                                                    <td class="product_thumb"><a href="/productDetails?id={{$c1->maVatPham}}"><img src="pageuser/assets/images/sanbong/sanbong2.jpg" alt="" /></a></td>
                                                    <td class="product_name">
                                                        <a href="/productDetails?id={{$c1->maVatPham}}">{{$c1->tenSan}}</a>
                                                        @if($c1->ngay!=null && $c1->thu!=null)
                                                            <p style="color:red">Thuê liên tục {{$c1->ngay}} ngày mỗi
                                                            @foreach(explode(';', $c1->thu) as $index => $thu)
                                                                {{$thu == 0 ? " chủ nhật" : "thứ " . ($thu + 1)}}
                                                                {{ $index == count(explode(';', $c1->thu)) - 1 ? '.' : ',' }}
                                                            @endforeach
                                                                <br/>
                                                                Bắt đầu từ: {{ \Carbon\Carbon::parse($c1->thoiGianBatDau)->format('d:m:Y') }}
                                                            </p>
                                                        @endif
                                                    </td>
                                                    @if($c1->ngay==null && $c1->thu==null)
                                                        <td class="product-price">{{$c1->thoiGianBatDau}}</td>
                                                        <td class="product-price"><label>{{$c1->thoiGianKetThuc}}</label></td>
                                                    @else
                                                        <td class="product-price">{{ \Carbon\Carbon::parse($c1->thoiGianBatDau)->format('H:i:s') }}</td>
                                                        <td class="product-price"><label>{{ \Carbon\Carbon::parse($c1->thoiGianKetThuc)->format('H:i:s') }}</label></td>
                                                    @endif

                                                    <td class="product_total">
                                                        @php
                                                            $tongDat = $c1->thu!=null?count(explode(';', $c1->thu))*($c1->ngay/7):1;
                                                        @endphp
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
                                                    </td>
                                                    <td class="product_remove">
                                                        <a href="" class="a-disable" onclick="toggleSubRow(this, '{{$c1->maVatPham}}', '{{$c1->maSan}}', '{{$c1->thoiGianBatDau}}', '{{$c1->thoiGianKetThuc}}','{{$c1->created_at}}')">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                        <a href="" class="a-disable delCart" onclick="updateCart(this,'delAll')" data-id="{{$c1->id}}"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @elseif($c1->maVatPham!=null and $c1->maSan!=null and $c1->trangThai==1)
                                                <tr class="sub-row" class="id_vp_{{$c1->id}}">
                                                    <td class="product_quantity">
                                                        <label>Số lượng (Tối đa {{$c1->soLuongChoThue}})</label>
                                                        <input class="updateSoLuong" min="1" max="{{$c1->soLuongChoThue}}" value="{{$c1->soLuong}}" type="number" data-id="{{$c1->id}}"></td>
                                                    <td class="product_thumb">
                                                        <img src="{{asset('storage/'.$c1->hinhAnh1)}}"/>
                                                    </td>
                                                    <td class="product_name product_thumb">
                                                        <select class="filterDropdown" id="categoryDropdown">
                                                            @foreach($danhmuc as $dm)
                                                                <option value="{{$dm->maLoaiVP}}" {{$c1->maLoaiVP==$dm->maLoaiVP?"selected":""}}>{{$dm->tenLoaiVP}}</option>
                                                            @endforeach
                                                        </select>
                                                        <select id="itemDropdown" class="itemDropDown" data-id="{{$c1->id}}">
                                                            @foreach($vatpham as $dm)
                                                                <option value="{{$dm->maVatPham}}" {{$c1->maVatPham==$dm->maVatPham?"selected":""}}>{{$dm->tenVatPham}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    @if($c1->ngay==null && $c1->thu==null)
                                                        <td class="product-price">{{$c1->thoiGianBatDau}}</td>
                                                        <td class="product-price"><label>{{$c1->thoiGianKetThuc}}</label></td>
                                                    @else
                                                        <td class="product-price">{{ \Carbon\Carbon::parse($c1->thoiGianBatDau)->format('H:i:s') }}</td>
                                                        <td class="product-price"><label>{{ \Carbon\Carbon::parse($c1->thoiGianKetThuc)->format('H:i:s') }}</label></td>
                                                    @endif
                                                    <td class="product_total">
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
                                                        @endif</td>
                                                    <td class="product_remove">
                                                        <a href="#" onclick="updateCart(this,'del')" class="a-disable delcartP" data-id="{{$c1->id}}"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <h3 class="m-5">Mua vật phẩm</h3>
                                    <table>
                                        <!-- Start Cart Table Head -->
                                        <thead>
                                        <tr>
                                            <th class="product_remove"><input type="checkbox"/></th>
                                            <th class="product_thumb">Hình ảnh</th>
                                            <th class="product_name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product_quantity">Số lượng</th>
                                            <th class="product_total">Tổng</th>
                                            <th class="product_remove">#</th>
                                        </tr>
                                        </thead> <!-- End Cart Table Head -->
                                        <tbody>
                                        <!-- Start Cart Single Item-->
                                        @foreach($cart as $c )
                                            <tr>
                                                <td class="product_remove"><input type="checkbox" class="selectVP" data-id="{{$c->id}}" {{$c->tt==1?"checked":""}}/></td>
                                                <td class="product_thumb">
                                                    <a href="/productDetails?id={{$c->maVatPham}}"><img
                                                            src="{{asset('storage/'.$c->hinhAnh1)}}"
                                                            alt=""/></a></td>
                                                <td class="product_name"><a href="/productDetails?id={{$c->maVatPham}}">{{$c->tenVatPham}}</a></td>
                                                <td class="product-price">{{$c->donGiaBan}}</td>
                                                <td class="product_quantity"><input min="1"max="100" value="{{$c->soLuong}}" type="number"></td>
                                                <td class="product_total">{{$c->donGiaBan*$c->soLuong}}</td>
                                                <td>
                                                    <a href="#" onclick="updateCartVP(this,'delvp')" class="a-disable delcartvp" data-id="{{$c->id}}"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr> <!-- End Cart Single Item-->
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
{{--                                <div class="cart_submit">--}}
{{--                                    <button class="btn btn-md btn-golden" type="submit">update cart</button>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Cart Table -->

            <!-- Start Coupon Start -->
            <div class="coupon_area">
                <div class="container">
                    <div class="row">
{{--                        <div class="col-lg-6 col-md-6">--}}
{{--                            <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">--}}
{{--                                <h3>Coupon</h3>--}}
{{--                                <div class="coupon_inner">--}}
{{--                                    <p>Enter your coupon code if you have one.</p>--}}
{{--                                    <input class="mb-2" placeholder="Coupon code" type="text">--}}
{{--                                    <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                                <h3>Giá trị đơn hàng</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal" >
                                        <p>Tổng cộng</p>
                                        <p class="cart_amount" id="cartSubTotal">{{number_format($tong, 0, ',', '.') . ' VNĐ'}}</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>Phí ship (Chỉ áp dụng cho đơn hàng mua dụng cụ)</p>
                                        <p class="cart_amount" id="cartSubShip">0</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>Tổng tiền</p>
                                        <p class="cart_amount" id="cartSub">{{number_format($tong, 0, ',', '.') . ' VNĐ'}}</p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="/checkout" class="btn btn-md btn-golden">Tiến hành thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Coupon Start -->
        </div> <!-- ...:::: End Cart Section:::... -->
    @endif
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('select').niceSelect('destroy');
            $(document).ready(function() {
                UpdateSelect();
            });
        });
        function toggleSubRow(element, maVatPham, maSan, thoiGianBatDau, thoiGianKetThuc,created_at) {
            document.getElementById("loading-overlay").style.display = "block";
            var subRow = document.createElement('tr');
            console.log(maVatPham,maSan,thoiGianBatDau,thoiGianKetThuc,created_at);
            var parentTd = element.parentNode.parentNode;
            var item=document.getElementById('cartUpdate');
            $.ajax({
                url: 'updatecart',
                method: 'GET',
                data: {
                    maVatPham: maVatPham,
                    maSan: maSan,
                    thoiGianBatDau: thoiGianBatDau,
                    thoiGianKetThuc: thoiGianKetThuc,
                    created_at:created_at,
                },
                success: function(data) {
                    $(item).html(data.html);
                    var formattedTong = number_format(data.tong, 0, ',', '.') + ' VNĐ';
                    cartSubTotal.innerText = formattedTong;
                    document.getElementById('cartSub').innerText = formattedTong;
                    UpdateSelect();
                    document.getElementById("loading-overlay").style.display = "none";
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById("loading-overlay").style.display = "none";
                }
            });
        }
        function updateCart(item,type){
            console.log(item.value);
            console.log(type);
            var id = item.getAttribute('data-id');
            var itemm=document.getElementById('cartUpdate');
            var cartSubTotal = document.getElementById('cartSubTotal');
            if (type=='tt'){
                var item= item.checked?1:0;
            }else{
                item=item.value;
            }
            $.ajax({
                url: 'updatecart1',
                method: 'GET',
                data: { type: type, item: item ,id:id},
                success: function(data) {
                    $(itemm).html(data.html);
                    var formattedTong = number_format(data.tong, 0, ',', '.') + ' VNĐ';
                    cartSubTotal.innerText = formattedTong;
                    document.getElementById('cartSub').innerText = formattedTong;
                    UpdateSelect();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        function updateCartVP(item,type){
            var id = item.getAttribute('data-id');
            var itemm=document.getElementById('cartUpdate');
            var row = item.closest('td').closest('tr');
            var cartSubTotal = document.getElementById('cartSubTotal');
            if (type=='ttVP'){
                var item= item.checked?1:0;
            }else{
                item=item.value;
            }
            $.ajax({
                url: 'updatecart1',
                method: 'GET',
                data: { type: type, item: item ,id:id},
                success: function(data) {
                    if (type=='delvp'){
                            row.remove();
                    }
                    var formattedTong = number_format(data.tong, 0, ',', '.') + ' VNĐ';
                    cartSubTotal.innerText = formattedTong;
                    document.getElementById('cartSub').innerText = formattedTong;
                    UpdateSelect();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        function UpdateSelect(){
            var disableLinks = document.querySelectorAll('.a-disable');
            disableLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                });
            });
            $('.filterDropdown').change(function() {
                updateProductList(this);
            });
            $('.checkboxselect').change(function() {
                updateCart(this,'tt');
            });
            $('.itemDropDown').change(function() {
                updateCart(this,'change');
            });
            $('.updateSoLuong').change(function() {
                updateCart(this,'SL');
            });
            $('.delcartP').change(function() {
                updateCart(this,'del');
            });
            $('.delcart').change(function() {
                updateCart(this,'delAll');
            });
            $('.selectVP').change(function() {
                updateCartVP(this,'ttVP');
            });
            $('.delcartvp').change(function() {
                updateCartVP(this,'delvp');
            });
            function updateProductList(dropdown) {
                document.getElementById("loading-overlay").style.display = "block";
                var category = $(dropdown).val();
                var item = $(dropdown).closest('tr').find('#itemDropdown')
                $.ajax({
                    url: 'filSPbyDM',
                    method: 'GET',
                    data: { category: category, item: item.val() },
                    success: function(data) {
                        $(item).html(data);
                        document.getElementById("loading-overlay").style.display = "none";
                    },
                    error: function(error) {
                        console.log(error);
                        document.getElementById("loading-overlay").style.display = "none";
                    }
                });
            }
            function updateCheckbox(dropdown) {
                document.getElementById("loading-overlay").style.display = "block";
                var category = $(dropdown).val();
                var item = $(dropdown).closest('tr').find('.product_name select')
                $.ajax({
                    url: 'filSPbyDM',
                    method: 'GET',
                    data: { category: category, item: item.val() },
                    success: function(data) {
                        document.getElementById("loading-overlay").style.display = "none";
                        $(item).html(data);
                    },
                    error: function(error) {
                        console.log(error);
                        document.getElementById("loading-overlay").style.display = "none";
                    }
                });
            }
        }
    </script>
@endsection
