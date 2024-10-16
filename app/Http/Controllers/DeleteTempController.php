<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteTempController extends Controller
{
    public function delete(Request $request)
    {

        $temporaryFiles = TemporaryFile::where('folder', $request->folder)->first();
        if ($temporaryFiles) {
            Storage::deleteDirectory('images/tmp/' . $temporaryFiles->folder);
            $temporaryFiles->delete();
        }
        return '';

    }
}
