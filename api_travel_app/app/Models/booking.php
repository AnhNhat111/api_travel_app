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
        'unit_price',
        'total_price',
        'is_confirmed',
        'date_of_booking',
        'is_paid',
        'quantity',
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