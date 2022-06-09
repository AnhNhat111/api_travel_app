<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable =[
        'tout_id',
        'image_path',
        'name'
    ];
    protected $timestamp = true;
}
