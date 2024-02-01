{{--<div class="container mt-5">--}}
{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            {{$thongbao->tieuDe}}--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <h5 class="card-title">Người Gửi: Admin</h5>--}}
{{--            <h6 class="card-subtitle mb-2 text-muted">Người Nhận: {{$thongbao->loaiTB==1?"Tất cả mọi người":\Illuminate\Support\Facades\Auth::user()->ten}}</h6>--}}
{{--            <p class="card-text">{!! $thongbao->noiDung !!}</p>--}}
{{--            <p class="card-text">{{$thongbao->created_at}}</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="dateModalLabel">{{$thongbao->tieuDe}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hiddenTB()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card-body">
            <h5 class="card-title">Người Gửi: Admin</h5>
            <h6 class="card-subtitle mb-2 text-muted">Người Nhận: {{$thongbao->loaiTB==1?"Tất cả mọi người":\Illuminate\Support\Facades\Auth::user()->ten}}</h6>
            <p class="card-text">{!! $thongbao->noiDung !!}</p>
            <p class="card-text">{{$thongbao->created_at}}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="hiddenTB()">Đóng</button>
        </div>
    </div>
</div>

