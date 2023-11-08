<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_id',
        'transaction_id',
        'cash_type',
        'cash_in_category',
        'cash_in_amount',
        'cash_out_category',
        'cash_out_amount',
        'last_saldo',
        'cash_in_attachment',
        'user_input',
    ];
}
