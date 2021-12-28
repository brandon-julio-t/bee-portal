<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function download(string $filename)
    {
        return Storage::download($filename);
    }
}
