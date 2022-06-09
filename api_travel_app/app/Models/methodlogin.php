<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class methodlogin extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'name',
        'status',
        'date'
    ];
    protected $timestamp = true;
}
