<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Public Routes (accessible to everyone)
Route::get('/', [VehicleController::class, 'home'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'catalog'])->name('vehicles');
Route::get('/vehicles/{vehicle:slug}', [VehicleController::class, 'show'])->name('vehicle-detail');
Route::get('/about', [VehicleController::class, 'about'])->name('about');
Route::get('/contact', [VehicleController::class, 'contact'])->name('contact');

// Legacy catalog route redirect
Route::get('/catalog', fn () => redirect()->route('vehicles'))->name('catalog');
Route::get('/dashboard', function () {
    return redirect()->route('admin.vehicles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Vehicle Management Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Categories management
        Route::resource('categories', AdminCategoryController::class);

        // Vehicles management
        Route::resource('vehicles', AdminVehicleController::class);
        // Vehicle status update (AJAX)
        Route::post('vehicles/{vehicle}/update-status', [AdminVehicleController::class, 'updateStatus'])
            ->name('vehicles.update-status');
        // Delete vehicle image
        Route::delete('vehicle-images/{image}', [AdminVehicleController::class, 'deleteImage'])
            ->name('vehicle-images.destroy');
    });
});

require __DIR__.'/auth.php';
