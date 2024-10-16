<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class TempUploaderController extends Controller
{
    public function __invoke(Request $request)
    {
        \Log::info('Request received');

        $foto = $request->file('foto');
        if (!$foto) {
            \Log::error('No file found in the request');
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $extension = $foto->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $folder = uniqid() . '-' . now()->timestamp;

        try {
            $path = storage_path('app/public/images/tmp/' . $folder);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $foto->move($path, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'foto' => $filename,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error storing file: ' . $e->getMessage());
            return response()->json(['error' => 'File upload failed'], 500);
        }

        return response()->json(['folder' => $folder], 200);
    }

}
