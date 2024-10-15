<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    // define table posts
    protected $table = 'posts';

    // define fillable columns
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];
}
