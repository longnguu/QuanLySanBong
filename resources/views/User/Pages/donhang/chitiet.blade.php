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

        a{
            color: #b19361;
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
                        <h3 class="breadcrumb-title">Chi tiết đơn hàng {{$maDon}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
    <div class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @php
                        $sanpham=\Illuminate\Support\Facades\DB::table('chitietthuesan')
                        ->leftJoin('sanbong','sanbong.maSan','=','chitietthuesan.maSan')
                        ->leftJoin('vatpham','chitietthuesan.maVatPham','=','vatpham.maVatPham')
                        ->where('maDonHang','=',$maDon)
                        ->where('chitietthuesan.maSan','!=',null)
                        ->orderBy('chitietthuesan.maSan','asc')
                        ->orderBy('chitietthuesan.thoiGianBatDau','asc')
                        ->orderBy('chitietthuesan.thoiGianKetThuc','asc')
                        ->orderBy('chitietthuesan.maCTT','asc')
                        ->select('chitietthuesan.*','sanbong.*','vatpham.*')
                        ->get();
                        $donmua = DB::table('chitietthuesan')
                        ->join('vatpham', 'vatpham.maVatPham', '=', 'chitietthuesan.maVatPham')
                        ->where('maSan','=',null)
                        ->where('maDonHang', '=', $maDon)
                        ->select('chitietthuesan.*','vatpham.*')
                        ->get();
                    @endphp
{{--                    <h3>{{$sanpham->count()>0?"Các sân bóng":"Đơn hàng của bạn"}}</h3>--}}
                    <div class="order_table table-responsive">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab11">Tất cả dịch vụ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab4-tab" data-bs-toggle="tab" href="#tab4">Dịch vụ sắp tới</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab22">Đã sử dụng</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab11">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sân</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sanpham as $c1)
                                        @if(1)
                                            @if($c1->maVatPham==null)
                                                <tr>
                                                    <td><strong>{{$c1->tenSan}}</strong><br/>
                                                        {{'Từ '.$c1->thoiGianBatDau .' đến '. $c1->thoiGianKetThuc}}
                                                    </td>
                                                    <td>
                                                        @if($c1->thoiGianBatDau > \Carbon\Carbon::now()->addHour(8))
                                                            <a href="/huydon?maCT={{$c1->maCTT}}" class="btn btn-light btn-sm" style="background-color: #c44646" onclick="confirmAction(event,'hủy đơn')">hủy đơn này</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @else
                                                <tr style="background-color: #f0f0f0;">
                                                    <td ><p style="margin-left: 10%" class="disabled">
                                                            {{$c1->tenVatPham}} <strong> x{{$c1->soLuong}}</strong>
                                                        </p>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab22">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sân</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sanpham as $c1)
                                        @if($c1->thoiGianBatDau<now())
                                            @if($c1->maVatPham==null)
                                                <tr>
                                                    <td><strong>{{$c1->tenSan}}</strong><br/>
                                                        {{'Từ '.$c1->thoiGianBatDau .' đến '. $c1->thoiGianKetThuc}}
                                                    </td>
                                                    <td>
{{--                                                        <a href="#" class="btn btn-success">Báo lỗi</a>--}}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr style="background-color: #f0f0f0;">
                                                    <td ><p style="margin-left: 10%" class="disabled">
                                                            {{$c1->tenVatPham}} <strong> x{{$c1->soLuong}}</strong>
                                                        </p>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab3">
                                <h2>Tab 3 Content</h2>
                                <p>This is the content of tab 3.</p>
                            </div>
                            <div class="tab-pane fade" id="tab4">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sân</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sanpham as $c1)
                                        @if($c1->thoiGianBatDau>now())
                                            @if($c1->maVatPham==null)
                                                <tr>
                                                    <td><strong>{{$c1->tenSan}}</strong><br/>
                                                        {{'Từ '.$c1->thoiGianBatDau .' đến '. $c1->thoiGianKetThuc}}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-success">Hủy</a>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr style="background-color: #f0f0f0;">
                                                    <td ><p style="margin-left: 10%" class="disabled">
                                                            {{$c1->tenVatPham}} <strong> x{{$c1->soLuong}}</strong>
                                                        </p>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
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
    <script>
        function confirmAction(event, action) {
            // Sử dụng hộp thoại xác nhận
            var result = confirm("Bạn có chắc chắn muốn '" + action + "' theo chính sách của chủ sân không?" +
                "Nếu đơn hàng đã được thanh toán. Số tiền sau khi tính toán sẽ được hoàn tiền về tài khoản của bạn" +
                "Nếu đơn hàng chưa được thanh toán. Số tiền vi phạm sẽ trừ trực tiếp vào tài khoản của bạn");

            // Ngăn chặn hành động mặc định của sự kiện nếu người dùng chọn Cancel hoặc No
            if (!result && event.preventDefault) {
                event.preventDefault();
            }

            // Trả về kết quả để sử dụng trong ngữ cảnh khác nếu cần
            return result;
        }
    </script>
@endsection
