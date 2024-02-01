@foreach($donhang1 as $value)
    <div class="don_hang">
        <div class="trang_thai">
            @switch($value->trangThai)
                @case(0)
                    CHỜ XÁC NHẬN
                    @break
                @case(1)
                    CHỜ LẤY HÀNG
                    @break
                @case(2)
                    ĐANG GIAO
                    @break
                @case(3)
                    ĐÃ GIAO
                    @break
                @case(4)
                    ĐÃ HỦY
                    @break
            @endswitch
        </div>
        <div class="ds_sp">
                <?php
                $sp = DB::table('donhang')
                    ->select('chitietthuesan.maVatPham', 'tenVatPham', 'hinhAnh1', 'vatPham.donGiaBan', 'chitietthuesan.soLuong')
                    ->join('chitietthuesan', 'donhang.id', 'chitietthuesan.maDonHang')
                    ->join('vatpham', 'vatpham.maVatPham', 'chitietthuesan.maVatPham')
                    ->where('maDonHang', $value->id)
                    ->get();
                ?>
            @foreach($sp as $value1)
                <div class="sp">
                    {{--                                                            <a href="{{ route('product.view', [$value1->maVatPham]) }}">--}}
                    <img src="{{asset('storage/'.$value1->hinhAnh1)}}">
                    <p>{{ $value1->tenVatPham }}<br>số lượng : {{ $value1->soLuong }}</p>
                    </a>
                    <p>{{ number_format($value1->donGiaBan, "0", "0", ".").' VNĐ' }}</p>
                </div>
            @endforeach
            <div class="tong_tien">
                Tổng số tiền : <span>{{ number_format($value->tongTien, "0", "0", ".").' VNĐ' }}</span>
            </div>
        </div>
    </div>
@endforeach
