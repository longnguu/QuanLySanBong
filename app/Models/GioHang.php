<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $table = 'giohang';
    protected $fillable = [
        'maNguoiDung',
        'maSan',
        'maVatPham',
        'soluong',
        'thoiGianBatDau',
        'thoiGianKetThuc',
        'hinhThucDat',
        'trangthai',
        'thu',
        'ngay',
    ];
    use HasFactory;
}
