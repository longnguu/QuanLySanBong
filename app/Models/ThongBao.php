<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $table = 'thongbao';
    protected $fillable = ['maNguoiDung','noiDung','loaiTB','tieuDe'];
    use HasFactory;
}
