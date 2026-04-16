<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverDocument;
use Illuminate\Http\Request;

class AdminDocumentController extends Controller
{
    /**
     * Approve a driver document.
     */
    public function approve($id)
    {
        $document = DriverDocument::findOrFail($id);
        $document->update([
            'status' => 'verified', 
            'rejection_reason' => null
        ]);

        return back()->with('success', 'Document approved successfully.');
    }

    /**
     * Reject a driver document with a reason.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $document = DriverDocument::findOrFail($id);
        $document->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason
        ]);

        return back()->with('success', 'Document rejected.');
    }
}
