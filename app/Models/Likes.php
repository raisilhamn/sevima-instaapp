<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';

    protected $fillable = [
        'posts_id',
        'users_id',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'posts_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

