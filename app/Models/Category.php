<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'loaiVP';
    protected $primaryKey = 'maLoaiVP';
    public $incrementing = false;
    public function product()
    {
        return $this->hasMany('App\Models\VatPham');
    }
}
