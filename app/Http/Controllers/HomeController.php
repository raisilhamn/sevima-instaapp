<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // get all post
        $posts = Posts::with('user', 'images', 'comments.user', 'likes')->get();
        // @dd($posts);
        return Inertia::render('Home', [
            'posts' => $posts,
        ]);
    }
}
