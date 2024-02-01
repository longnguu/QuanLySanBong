<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
    protected $table = 'phongnhantin';
    protected $fillable = [
        'nd2',
        'nd1',
    ];
    use HasFactory;
}
