<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Throwable;

class DriverDocumentController extends Controller
{
    /**
     * Bulk upload all 6 driver documents at once.
     * - Images: compressed and resized for speed.
     * - PDFs: stored as-is for document integrity.
     */
    public function bulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cnic'          => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            'license'       => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            'driver_photo'  => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            'registration'  => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            'insurance'     => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            'vehicle_photo' => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
        ], [
            'cnic.required'          => 'Please upload your National ID Card (CNIC)',
            'license.required'       => 'Please upload your Driver License',
            'driver_photo.required'  => 'Please upload your Driver Photo',
            'registration.required'  => 'Please upload your Vehicle Registration',
            'insurance.required'     => 'Please upload your Insurance Document',
            'vehicle_photo.required' => 'Please upload your Vehicle Photo',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Some documents are missing or invalid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $driver = $request->user();

        // Check if user is a Driver, not a Rider
        if (!$driver instanceof \App\Models\Driver) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Only drivers can upload documents.',
            ], 403);
        }

        $types = ['cnic', 'license', 'driver_photo', 'registration', 'insurance', 'vehicle_photo'];
        $uploaded = [];
        $manager  = new ImageManager(new Driver());

        foreach ($types as $type) {
            try {
                $file      = $request->file($type);
                $extension = strtolower($file->getClientOriginalExtension());
                $filename  = $type . '_' . time() . '.' . $extension;
                $path      = "driver_documents/{$driver->id}/{$filename}";

                // Store file
                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $image = $manager->read($file->getPathname());
                    if ($image->width() > 1200) {
                        $image->scale(width: 1200);
                    }
                    $encoded = $extension === 'png' ? $image->toPng() : $image->toJpeg(80);
                    Storage::disk('public')->put($path, (string) $encoded);
                } else {
                    Storage::disk('public')->putFileAs("driver_documents/{$driver->id}", $file, $filename);
                }

                // Store in database
                $document = DriverDocument::updateOrCreate(
                    ['driver_id' => $driver->id, 'type' => $type],
                    ['file_path' => $path, 'status' => 'pending', 'rejection_reason' => null]
                );

                $uploaded[] = $document;
                Log::info('Document uploaded', ['driver_id' => $driver->id, 'type' => $type, 'path' => $path, 'document_id' => $document->id]);

            } catch (Throwable $e) {
                Log::error('Document upload failed for type: ' . $type, [
                    'driver_id' => $driver->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'All documents uploaded. Images were optimized automatically.',
            'documents' => $uploaded,
        ]);
    }
}
