<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'subtransaction_id',
        'donatur',
        'cash_in_category',
        'cash_in_methode',
        'amount',
        'total_amount',
        'cash_in_date',
        'cash_in_month',
        'cash_in_year',
        'cash_in_attachment',
        'cash_in_note',
        'user_input',
    ];
}
