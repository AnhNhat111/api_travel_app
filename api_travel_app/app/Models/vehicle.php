<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'name',
        'status'
    ];
    protected $timestamp = true;
}
