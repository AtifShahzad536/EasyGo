<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LiveRideController;
use App\Http\Controllers\RideHistoryController;
use App\Http\Controllers\ScheduledRideController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DriverStatusController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\AdminDocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        // Check if user is admin
        
            return redirect('/dashboard');
        
        // Check if user is driver
      
    }
    return view('auth.login');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::patch('/driver-documents/{id}/approve', [AdminDocumentController::class, 'approve'])->name('admin.documents.approve');
    Route::patch('/driver-documents/{id}/reject', [AdminDocumentController::class, 'reject'])->name('admin.documents.reject');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/riders', [RiderController::class, 'index'])->name('riders.index');
    Route::patch('/riders/{rider}/status', [RiderController::class, 'updateStatus'])->name('riders.status');
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/live-rides', [LiveRideController::class, 'index'])->name('live-rides.index');
    Route::get('/ride-history', [RideHistoryController::class, 'index'])->name('ride-history.index');
    Route::get('/scheduled-rides', [ScheduledRideController::class, 'index'])->name('scheduled-rides.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/driver-status', [DriverStatusController::class, 'index'])->name('driver-status.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});

// Profile photo serving route (for mobile app)
Route::get('/storage/profile_photos/{path}', [FileController::class, 'serveProfilePhoto'])
    ->where('path', '.*')
    ->name('profile.photo.serve');

require __DIR__.'/auth.php';
