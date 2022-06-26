<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable = [
        'user_id',
        'tour_id',
        'status',
        'quantity_child',
        'quantity_adult',
        'quantity',
        'unit_price_child',
        'unit_price_adult',
        'total_price',
        'is_confirmed',
        'date_of_booking',
        'is_paid',
        'date_of_payment',
        'booking_details',
    ];
    protected $timestamp = true;

    public function tour(){
        return $this->hasMany(tour::class, 'id', 'tour_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}