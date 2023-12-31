<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_warga',
        'name',
        'house_block',
        'house_number',
        'phone_number',
        'status',
    ];
}
