<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'user_id',
        'tour_id',
        'status',
        'unit_price',
        'total_price',
        'is_confirmed',
        'date_of_booking',
        'is_paid',
        'quantity',
        'date_of_payment',
        'booking_details'
    ];
}
