<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $fillable = [
        'user_id',
        'tour_id',
        'comment',
        'count_like',
        'status'
    ];
    protected $timestamp = true;
    protected $casts = [
        'user_id' => 'int',
        'tour_id' => 'int',
        'count_like',
        'status' => 'int'
    ];

    public function username()
    {
        return $this->hasMany(User::class, 'id', 'user_id')->select('id', 'name', 'avatar');
    }
}