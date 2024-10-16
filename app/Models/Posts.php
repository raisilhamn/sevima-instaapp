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
        'content',
    ];

    // define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // define relationship with Comments model
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    // define relationship with Likes model
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    // define relationship with images model
    public function images()
    {
        return $this->hasMany(ImagesPosts::class, 'post_id');
    }
}
