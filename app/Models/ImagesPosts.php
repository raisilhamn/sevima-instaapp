<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesPosts extends Model
{
    use HasFactory;
    protected $table = 'post_images';

    protected $fillable = [
        'post_id',
        'path',
    ];
}
