<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'user_id',
        'name',
        'status'
    ];
    protected $timestamp = true;
}
