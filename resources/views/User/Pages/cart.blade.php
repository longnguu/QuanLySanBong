@extends('User.main')
@section('head')
    <style>
        .sub-row {
            /*display: none;*/
            background-color: #f0f0f0;
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
                                    <h3 class="m-5">Thuê vật phẩm</h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_remove"><input type="checkbox" /></th>
                                            <th class="product_thumb">Hình Ảnh</th>
                                            <th class="product_name">Sản phẩm</th>
                                            <th class="product-price">Thời gian nhận</th>
                                            <th class="product_quantity">Thời gian trả</th>
                                            <th class="product_total">Tổng</th>
                                            <th class="product_remove">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart1 as $c1)
                                            @if ($c1->maVatPham==null and $c1->maSan!=null)
                                                <tr>
                                                    <td class="product_remove"><input type="checkbox" /></td>
                                                    <td class="product_thumb"><a href="/productDetails?id={{$c1->maVatPham}}"><img src="pageuser/assets/images/sanbong/sanbong2.jpg" alt="" /></a></td>
                                                    <td class="product_name"><a href="/productDetails?id={{$c1->maVatPham}}">{{$c1->tenSan}}</a></td>
                                                    <td class="product-price">{{$c1->thoiGianBatDau}}</td>
                                                    <td class="product-price"><label>{{$c1->thoiGianKetThuc}}</label></td>
                                                    <td class="product_total">$130.00</td>
                                                    <td class="product_remove">
                                                        <a href="#" onclick="toggleSubRow(this)"><i class="fa fa-plus"></i></a>
                                                        <a href="#"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
{{--                                                <td colspan="7" class="sub-row">Chi tiết dịch vụ thuê thêm...</td>--}}
{{--                                                <tr class="sub-row" style="text-align: center">--}}
{{--                                                    <th class="product_remove"></th>--}}
{{--                                                    <th class="product_thumb">Hình Ảnh</th>--}}
{{--                                                    <th class="product_name">Sản phẩm</th>--}}
{{--                                                    <th class="product-price">Đơn giá</th>--}}
{{--                                                    <th class="product_quantity">Số lượng</th>--}}
{{--                                                    <th class="product_total">Tổng</th>--}}
{{--                                                    <th class="product_remove">#</th>--}}
{{--                                                </tr>--}}

                                            @elseif($c1->maVatPham!=null and $c1->maSan!=null)
                                                <tr class="sub-row">
                                                    <td style="color: pink"></td>
                                                    <td class="product_thumb">
                                                        <select><option value="-1">Tất cả</option>
                                                            @foreach($danhmuc as $dm)
                                                                <option value="{{$dm->maLoaiVP}}">{{$dm->tenLoaiVP}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="product_name product_thumb">
                                                        <select>
                                                            <script>
                                                                console.log('{{$c1->maVatPham}}');
                                                            </script>
                                                            @foreach($vatpham as $dm)
                                                                <option value="{{$dm->maVatPham}}" {{$c1->maVatPham==$dm->maVatPham?"selected":""}}>{{$dm->tenVatPham}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="product-price">{{$c1->donGiaThue}}</td>
                                                    <td class="product-price"><label>{{$c1->soLuong}}</label></td>
                                                    <td class="product_total">$130.00</td>
                                                    <td class="product_remove">
                                                        <a href="#"><i class="fa fa-trash-o"></i></a>
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
                                        <tr>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a href="product-details-default.html"><img
                                                        src="pageuser/assets/images/product/default/home-1/default-1.jpg"
                                                        alt=""></a></td>
                                            <td class="product_name"><a href="product-details-default.html">Handbag
                                                    fringilla</a></td>
                                            <td class="product-price">$65.00</td>
                                            <td class="product_quantity"><label>Quantity</label> <input min="1"
                                                                                                        max="100" value="1" type="number"></td>
                                            <td class="product_total">$130.00</td>
                                        </tr> <!-- End Cart Single Item-->
                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a href="product-details-default.html"><img
                                                        src="pageuser/assets/images/product/default/home-1/default-2.jpg"
                                                        alt=""></a></td>
                                            <td class="product_name"><a href="product-details-default.html">Handbags
                                                    justo</a></td>
                                            <td class="product-price">$90.00</td>
                                            <td class="product_quantity"><label>Quantity</label> <input min="1"
                                                                                                        max="100" value="1" type="number"></td>
                                            <td class="product_total">$180.00</td>
                                        </tr> <!-- End Cart Single Item-->
                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a href="product-details-default.html"><img
                                                        src="pageuser/assets/images/product/default/home-1/default-3.jpg"
                                                        alt=""></a></td>
                                            <td class="product_name"><a href="product-details-default.html">Handbag
                                                    elit</a></td>
                                            <td class="product-price">$80.00</td>
                                            <td class="product_quantity"><label>Quantity</label> <input min="1"
                                                                                                        max="100" value="1" type="number"></td>
                                            <td class="product_total">$160.00</td>
                                        </tr> <!-- End Cart Single Item-->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <button class="btn btn-md btn-golden" type="submit">update cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Cart Table -->

            <!-- Start Coupon Start -->
            <div class="coupon_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                                <h3>Coupon</h3>
                                <div class="coupon_inner">
                                    <p>Enter your coupon code if you have one.</p>
                                    <input class="mb-2" placeholder="Coupon code" type="text">
                                    <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Subtotal</p>
                                        <p class="cart_amount">$215.00</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>Shipping</p>
                                        <p class="cart_amount"><span>Flat Rate:</span> $255.00</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>Total</p>
                                        <p class="cart_amount">$215.00</p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="#" class="btn btn-md btn-golden">Proceed to Checkout</a>
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
        function toggleSubRow(element) {
            // Tạo một sub row mới
            var subRow = document.createElement('tr');

            // Thêm các ô cột vào sub row (ở đây có thể là các thông tin chi tiết của sản phẩm)
            subRow.innerHTML = '<td colspan="7">Chi tiết sản phẩm...</td>';

            // Lấy parent của thẻ <a> (thẻ <td> chứa nó)
            var parentTd = element.parentNode.parentNode;
            console.log(parentTd);

            // Chèn sub row vào dưới thẻ <td> chứa nó
            parentTd.parentNode.insertBefore(subRow, parentTd.nextSibling);
        }
        $(document).ready(function () {
            $('select').niceSelect('destroy'); // Gỡ bỏ Nice Select
        });
    </script>
@endsection
