<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'cash_out_category',
        'amount',
        'transaction_date',
        'cash_out_attachment',
        'cash_out_note',
        'user_input',
    ];
}
