<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'tinnhan';
    protected $fillable = [
        'idPhongNT',
        'maNguoiNhan',
        'maNguoiGui',
        'noiDung',
    ];
    use HasFactory;
}
