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
