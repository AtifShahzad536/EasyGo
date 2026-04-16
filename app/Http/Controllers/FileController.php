<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * Serve profile photo securely
     */
    public function serveProfilePhoto(Request $request, $path)
    {
        // Decode the path if it contains slashes
        $fullPath = 'profile_photos/' . $path;

        // Check if file exists in storage
        if (!Storage::disk('public')->exists($fullPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found'
            ], 404);
        }

        // Get file path
        $filePath = Storage::disk('public')->path($fullPath);

        // Serve the file
        return response()->file($filePath, [
            'Content-Type' => $this->getContentType($filePath),
            'Cache-Control' => 'public, max-age=86400'
        ]);
    }

    /**
     * Get content type based on file extension
     */
    private function getContentType($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}
