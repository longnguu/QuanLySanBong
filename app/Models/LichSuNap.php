<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuNap extends Model
{
    protected $table = 'lichsunap';
    protected $fillable = [
        'id',
        'maNguoiDung',
        'ndck',
        'soTien',
        'thoiGian',
        'trangThai',
        'loaiGD',
        'transID'
    ];
    use HasFactory;
}
