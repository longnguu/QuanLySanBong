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
<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
        <h2>
            Xin chào {{$customer->ten}}
        </h2>
        <p>Bạn vừa đặt hàng ở website Đại Dương</p>
        <p>Tổng giá trị đơn hàng: {{ number_format($order->tongTien,0,',','.') }}
            <small>VNĐ</small></p>
        <p>{{$order->daThanhToan==0?"Vui lòng thanh thanh toán trước khi kết thúc trận đấu sớm nhất để không bị ảnh hưởng":""}}</p>
    </div>
</div>
