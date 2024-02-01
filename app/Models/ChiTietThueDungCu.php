<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietThueDungCu extends Model
{
    protected $table = 'chitietthuedungcu';
    protected $fillable = [
        'maCTT',
        'maVP',
        'soLuong',
        'thoiGianBatDau',
        'thoiGianKetThuc',
    ];
    use HasFactory;
}
