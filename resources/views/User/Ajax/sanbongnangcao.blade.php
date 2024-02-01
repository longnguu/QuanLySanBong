<div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Chọn Ngày</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hiddenKK()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="btn-group-toggle" data-toggle="buttons" style="flex-wrap: wrap;align-self: auto;justify-content: space-between;padding-left: 10%;padding-right: 10%">
                @for($i=0;$i<7;$i++)
                    <label class="btn btn-checkbox {{ in_array($i, $foundDay) ? 'btn-danger' : 'btn-secondary' }}">
                        <input type="checkbox"  unchecked {{ in_array($i, $foundDay) ? 'disabled' : '' }} value="{{$i}}" onchange="updateButtonColor(this)">
                        {{$i==0?"Chủ nhật":"Thứ ".$i+1}}
                    </label>
                @endfor
            </div>
            <div>
                <label class="btn btn-checkbox" for="ngay">Chọn chu kỳ
                </label>
                <select name="ngay" id="ngayyy" style="width: 80%;margin-left: 10%" data-masan="{{$maSan}}" onchange="AjaxCartNangCao(this,null,null)">
                    <option value="7" {{$songay==7?"selected":""}}>7 ngày</option>
                    <option value="14" {{$songay==14?"selected":""}}>14 ngày</option>
                    <option value="21" {{$songay==21?"selected":""}}>21 ngày</option>
                    <option value=28 {{$songay==28?"selected":""}}>28 ngày</option>
                </select>
            </div>
            <div class="modal-footer">
                @foreach($foundDates as $index => $fd)
                    <p style="color: red; width: 100%">Không thể chọn {{\Carbon\Carbon::parse($fd)->dayOfWeek!=0?"Thứ ".\Carbon\Carbon::parse($fd)->dayOfWeek+1:"Chủ nhật"}} vì sân {{$maSan}} bận vào ngày {{$fd.' đến '.$foundDates1[$index]}}</p>
                @endforeach
                <br/>
                <button type="button" class="btn btn-secondary" onclick="hiddenKK()">Đóng</button>
                <button type="button" class="btn btn-primary" data-masan="{{$maSan}}" onclick="getSelectedDays(this)">Lưu</button>
            </div>
        </div>
    </div>
