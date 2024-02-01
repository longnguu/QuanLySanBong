<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietThueSan extends Model
{
    protected $table = 'chitietthuesan';
    protected $fillable = [
        'maDonHang',
        'maSan',
        'maVatPham',
        'soLuong',
        'maHinhThuc',
        'thoiGianBatDau',
        'thoiGianKetThuc',
        'ghiChu',
    ];
    use HasFactory;
}
