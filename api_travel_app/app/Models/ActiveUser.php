<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveUser extends Model
{
    use HasFactory;
    protected $table = 'active_users';
    protected $primary = 'id';
    protected $timestamp = true;

    protected $casts = [
        'code' => 'int'
    ];
}