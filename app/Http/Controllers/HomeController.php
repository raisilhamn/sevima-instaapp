<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Posts::with('user', 'images', 'comments.user', 'likes')->get()->map(function ($post) {
            $post->liked = $post->likes->contains('users_id', auth()->id());
            $post->like_count = $post->likes->count();
            return $post;
        });

        return Inertia::render('Home', [
            'posts' => $posts,
        ]);
    }
}
