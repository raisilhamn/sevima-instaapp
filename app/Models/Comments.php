<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'posts_id',
        'users_id',
        'content',
    ];
    // relation to post
    public function post()
    {
        return $this->belongsTo(Posts::class, 'posts_id', 'id');
    }

    // relation to user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
