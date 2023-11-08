<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'complaint_type',
        'description',
        'attachment',
        'status',
        'followup_date',
        'followup_note',
        'reject_date',
        'reject_note',
        'execution_date',
        'execution_note',
        'execution_attachment',
        'finish_date',
        'finish_note',
        'user_input',
        'user_update',
    ];
}
