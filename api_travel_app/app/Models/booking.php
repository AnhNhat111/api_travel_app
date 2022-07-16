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

    protected $casts = [
        'user_id' => 'int',
        'tour_id' => 'int',
        'status' => 'int',
        'quantity_child' => 'int',
        'quantity_adult' => 'int',
        'quantity' => 'int',
        'unit_price_child' => 'int',
        'unit_price_adult' => 'int',
        'total_price' => 'int',
        'is_confirmed' => 'int',
        'is_paid' => 'int',
        'date_of_payment' => 'datetime',
        'date_of_booking' => 'datetime',
    ];

    public function tour()
    {
        return $this->hasMany(tour::class, 'id', 'tour_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function start_location()
    {
        return $this->hasOne(location::class, "id", "start_location_id");
    }

    public function end_location()
    {
        return $this->hasOne(location::class, "id", "end_location_id");
    }

    public function code()
    {
        return $this->hasOne(tour::class, 'id', 'tour_id')->select('id', 'code');
    }
}