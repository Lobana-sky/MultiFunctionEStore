<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbankOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'bank_id',
        'count',
        'price',
        'mobile_no',
        'note',
    ];
}
