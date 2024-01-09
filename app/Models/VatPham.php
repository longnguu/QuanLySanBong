<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VatPham extends Model
{
    protected $table = 'VatPham';
    protected $primaryKey = 'maVatPham';
    public $incrementing = false;
}
