<?php

namespace App\Http\Controllers;

use App\Models\ImagesPosts;
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
        $post = Posts::find($id);
        // get all images from post with eloquent
        $images = $post->images;

        // Correct the relationship call
        $comments = $post->comments;

        // return inertia view with data
        return Inertia::render('DetailPost', [
            'post' => $post,
            'images' => $images,
            'comments' => $comments,
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
}
