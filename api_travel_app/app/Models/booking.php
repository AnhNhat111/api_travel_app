<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'hotel',
        'schedule',
        'type_id',
        'promotion_id',
        'date_from',
        'date_to',
        'code',
        'name',
        'image',
        'price',
        'start_location_id',
        'end_location_id',
        'capacity',
        'available_capacity',
        'vehicle_id',
        'status',
    ];
    protected $timestamp = true;
}
