<?php $i = 1; $sum =0;
?>
<style>
    .sub-row {
        /*display: none;*/
        background-color: #f0f0f0!important;
    }
    tr{
        background-color: #ffffff!important;
    }
</style>

@foreach($order_detail as $vl)
    @if ($vl->maSan==null)
        <tr>
        <td><?php echo $i++ ?></td>
        <td>{{ $vl -> maVatPham }}</td>
        <td>{{ $vl -> tenVatPham }}</td>
        <td>
            {{$vl->soLuong}}
        </td>
        <td>
            {{ number_format(($vl -> donGiaBan),0,',','.') }}
            <small>VNĐ</small>
        </td>
        <td></td>
        <td>
            {{ number_format(($vl -> soLuong * $vl -> donGiaBan),0,',','.') }}
            <small>VNĐ</small>
        </td>
{{--        <td class="text-right">--}}
{{--            <button class="btn btn-danger" onclick="delete_product({{$vl -> maVatPham}}, {{ $vl -> maDonHang }})">--}}
{{--                <i class="fas fa-trash"></i>--}}
{{--            </button>--}}
{{--        </td>--}}
    </tr>
        <div style="visibility: hidden; height: 0px;">{{ $sum = $sum + ($vl -> soLuong * $vl -> donGiaBan) }}</div>
    @else
        @if($vl->maVatPham==null)
            <tr>
                <td>{{$i++}}</td>
                <td>{{ $vl -> tenSan }}</td>
                <td>
                    {{$vl->thoiGianBatDau}}
                </td>
                <td>
                    {{$vl->thoiGianKetThuc}}
                </td>
                <td>
                    {{ number_format(($vl -> giaDichVu),0,',','.') }}
                    <small>VNĐ</small>
                </td>
{{--                <td>--}}
{{--                    <button class="btn btn-danger" onclick="delete_product({{$vl -> maVatPham}}, {{ $vl -> maDonHang }})">--}}
{{--                        <i class="fas fa-trash"></i>--}}
{{--                    </button>--}}
{{--                </td>--}}
            </tr>
        @else
            <tr class="sub-row">
            <td>Dịch vụ thêm</td>
            <td>{{ $vl -> tenVatPham.' x'. $vl->soLuong }}</td>
            <td>
                {{$vl->thoiGianBatDau}}
            </td>
            <td>
                {{$vl->thoiGianKetThuc}}
            </td>
            <td>
                {{ number_format(($vl -> soLuong * $vl -> donGiaThue),0,',','.') }}
                <small>VNĐ</small>
            </td>
{{--            <td class="text-right">--}}
{{--                <button class="btn btn-danger" onclick="delete_product({{$vl -> maVatPham}}, {{ $vl -> maDonHang }})">--}}
{{--                    <i class="fas fa-trash"></i>--}}
{{--                </button>--}}
{{--            </td>--}}
            </tr>
        @endif
    @endif
@endforeach
<tr>
    <td colspan="4"></td>
    <td class="text-primary font-weight-bold">
        {{ number_format($order->tongTien,0,',','.') }}
        <small>VNĐ</small>
    </td>
    <td></td>
</tr>
