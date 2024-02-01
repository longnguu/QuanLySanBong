<option value="-1">Chọn vật phẩm</option>
@foreach($vatpham as $dm)
    <option value="{{$dm->maVatPham}}">{{$dm->tenVatPham}}</option>
@endforeach
