<?php

namespace App\Http\Controllers;

use App\Models\ImagesPosts;
use App\Models\Likes;
use App\Models\Posts;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:2200',
        ]);

        $post = Posts::create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        $folderNames = array_map(function ($json) {
            return json_decode($json, true)['folder'];
        }, $request->foto);

        $temporaryFiles = TemporaryFile::whereIn('folder', $folderNames)->get();
        foreach ($temporaryFiles as $temporaryFile) {
            $originalFilename = $temporaryFile->foto;
            $folder = $temporaryFile->folder;
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $newFilename = $post->id . '_' . Str::uuid() . '.' . $fileExtension;
            $from = storage_path('app/public/images/tmp/' . $folder . '/' . $originalFilename);
            $to = storage_path('app/public/images/posts/' . $newFilename);

            if (File::exists($from)) {
                File::move($from, $to);
                if (File::exists($to)) {
                    // \Log::info('success move files', ['from' => $from, "to" => $to]);
                } else {
                    // \Log::danger('failed move files', ['from' => $from, "to" => $to]);
                }
            } else {
                // \Log::danger('file not found');
            }
            ImagesPosts::create([
                'post_id' => $post->id,
                'image' => $newFilename,
                'path' => $temporaryFile->folder . '/' . $newFilename,
            ]);
            Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);
            $temporaryFile->delete();
            // $statusFoto++;
        };

        return redirect()->route('home')->with('success', 'Berhasil Membuat Post');
    }

    public function show($id)
    {
        $post = Posts::with('user', 'images', 'comments.user', 'likes')->findOrFail($id);
        $post->liked = $post->likes->contains('users_id', auth()->id());
        $post->like_count = $post->likes->count();

        return Inertia::render('DetailPost', [
            'post' => $post,
            'images' => $post->images,
            'comments' => $post->comments,
            'liked' => $post->liked,
            'likecount' => $post->like_count,
        ]);
    }

    public function comment(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'posts_id' => 'required|exists:posts,id',
        ]);

        $post = Posts::find($request->posts_id);
        $post->comments()->create([
            'content' => $request->input('content'),
            'users_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Komentar');
    }

    public function like(Request $request, $id)
    {
        $userId = auth()->id();
        $existingLike = Likes::where('posts_id', $id)->where('users_id', $userId)->first();

        if (!$existingLike) {
            Likes::create([
                'posts_id' => $id,
                'users_id' => $userId,
            ]);
        }

        return redirect()->back();
    }

    public function unlike(Request $request, $id)
    {
        $userId = auth()->id();
        $existingLike = Likes::where('posts_id', $id)->where('users_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
        }

        return redirect()->back();
    }
}
