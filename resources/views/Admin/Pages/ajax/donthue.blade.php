<table class="table table-striped projects">
    <thead>
    <tr>
        <th>Mã ĐH</th>
        <th>Mã KH</th>
        <th>Ngày tạo</th>
        <th>Người nhận</th>
        {{--                        <th>SĐT</th>--}}
        {{--                        <th>Địa chỉ</th>--}}
        <th>Trạng thái thanh toán</th>
        <th>Tổng tiền</th>
{{--        <th>--}}
{{--            <select class="bg-dark form-control-sm font-weight-bold border-0" name="" id="sortStatus"--}}
{{--                    onchange="sortStatus_Order()">--}}
{{--                <option value="" selected>Trạng thái</option>--}}
{{--                <option class="" value="Xác nhận">Chờ xác nhận</option>--}}
{{--                <option class="" value="Chờ lấy hàng">Đã giao cho vận chuyển</option>--}}
{{--                <option class="" value="Đã hủy">Đã hủy</option>--}}
{{--                <option class="" value="Trả hàng">Trả hàng</option>--}}
{{--            </select>--}}
{{--        </th>--}}
{{--        <th>Chi tiết</th>--}}
        <th style="">
        </th>
    </tr>
    </thead>
    <tbody id="tbOrder">
    @foreach($list_order as $key => $value)
        <tr>
            <td>{{ $value -> id }}</td>
            <td>{{ $value -> maNguoiDung }}</td>
            <td>{{ $value -> updated_at }}</td>
            <td>{{ $value -> hoTen }}</td>
            {{--                            <td>{{ $value -> SDT }}</td>--}}
            {{--                            <td>{{ $value -> diaChi }}</td>--}}
            <td>
                @if($value -> daThanhToan == 0)
                    Thanh toán khi sử dụng
                @else
                    Đã thanh toán
                @endif
            </td>
            <td>{{ $value -> tongTien }}</td>
            {{--                            <td>--}}
            {{--                                @if($value -> TrangThai== 0)--}}
            {{--                                    <small class="text-danger">Chờ xác nhận</small>--}}
            {{--                                @elseif($value -> TrangThai== 1)--}}
            {{--                                    <small class="text-warning">Chờ lấy hàng</small>--}}
            {{--                                @elseif($value -> TrangThai== 2)--}}
            {{--                                    <small class="text-primary">Đang giao</small>--}}
            {{--                                @elseif($value -> TrangThai== 3)--}}
            {{--                                    <small class="text-success">Đã giao</small>--}}
            {{--                                @elseif($value -> TrangThai== 4)--}}
            {{--                                    <small class="text-secondary">Đã hủy</small>--}}
            {{--                                @else--}}
            {{--                                    <small class="text-light">Trả hàng</small>--}}
            {{--                                @endif--}}
            {{--                            </td>--}}
            {{--                            <td>--}}
            {{--                                @if($value -> TrangThai== 0)--}}
            {{--                                    <a href="{{ route('admin.order.action', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-info">Xác nhận</span></a>--}}
            {{--                                    <a href="{{ route('admin.order.cancel', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-danger">Hủy</span></a>--}}
            {{--                                @elseif($value -> TrangThai== 1)--}}
            {{--                                    <a href="{{ route('admin.order.action', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-warning">Vận chuyển</span></a>--}}
            {{--                                    <a href="{{ route('admin.order.cancel', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-danger">Hủy</span></a>--}}
            {{--                                @elseif($value -> TrangThai== 2)--}}

            {{--                                    <a href="{{ route('admin.order.action', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-primary">Hoàn thành</span></a>--}}
            {{--                                    <a href="{{ route('admin.order.returns', $value -> id) }}">--}}
            {{--                                        <span class="badge badge-danger">GHKTC</span></a>--}}
            {{--                                @elseif($value -> TrangThai== 3)--}}
            {{--                                    <span class="badge badge-success">Đã giao</span>--}}
            {{--                                @elseif($value -> TrangThai== 4)--}}
            {{--                                    <span class="badge badge-secondary">Đơn hủy</span>--}}
            {{--                                @else--}}
            {{--                                    <span class="badge badge-light">GHKTC</span>--}}
            {{--                                @endif--}}
            {{--                            </td>--}}
            <td class="project-actions text-right">
                <a href="{{ route("admin.order.detail",  $value -> id ) }}"
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-eye"></i>
                    Xem
                </a>
                {{--                                <a class="btn btn-info btn-sm"--}}
                {{--                                   href="{{ route("admin.order.edit",  $value -> id ) }}">--}}
                {{--                                    <i class="fas fa-pencil-alt">--}}
                {{--                                    </i>--}}
                {{--                                    Edit--}}
                {{--                                </a>--}}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $list_order->links('pagicustom') }}
</div>
