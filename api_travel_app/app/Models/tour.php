<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vehicle;
use App\Models\images;

class tour extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable = [
        'code',
        'name',
        'date_to',
        'date_from',
        'schedule',
        'hotel',
        'image',
        'price_child',
        'price_adult',
        'start_location_id',
        'end_location_id',
        'capacity',
        'available_capacity',
        'type_id',
        'vehicle_id',
        'promotion_id',
        'status',
        'description'
    ];
    protected $casts = [
        'code' => 'int',
        'price_child' => 'int',
        'price_adult' => 'int',
        'start_location_id' => 'int',
        'end_location_id' => 'int',
        'capacity' => 'int',
        'available_capacity' => 'int',
        'type_id' => 'int',
        'vehicle_id' => 'int',
        'promotion_id' => 'int',
        'status' => 'int',
        'date_form' => 'datetime',
        'date_to' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->hasOne(vehicle::class, "id", "vehicle_id");
    }

    public function images()
    {
        return $this->hasMany(images::class, "tour_id");
    }

    public function start_location()
    {
        return $this->hasOne(location::class, "id", "start_location_id");
    }

    public function end_location()
    {
        return $this->hasOne(location::class, "id", "end_location_id");
    }
}