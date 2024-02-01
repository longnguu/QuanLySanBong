<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhang';
    protected $fillable = [
        'maNguoiDung',
        'hoTen',
        'maXa',
        'diaChi',
        'SDT',
        'Email',
        'ghiChu',
        'daThanhToan',
        'maGiamGia',
        'tongTien',
        'loaiDonHang',
    ];
    use HasFactory;
}
