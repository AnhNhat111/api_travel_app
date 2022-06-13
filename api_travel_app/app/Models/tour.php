<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'code',
        'name',
        'date_to',
        'date_from',
        'schedule',
        'hotel',
        'image',
        'price',
        'start_location_id',
        'end_location_id',
        'capacity',
        'available_capacity',
        'type_id',
        'vehicle_id',
        'promotion_id',
        'status'
    ];
}
