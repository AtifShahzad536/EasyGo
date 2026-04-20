<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Handle file uploads.
     */
    public function upload()
    {
        return response()->json(['message' => 'File upload endpoint']);
    }
}
