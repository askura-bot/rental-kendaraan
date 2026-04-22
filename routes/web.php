<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Public Routes (accessible to everyone)
Route::get('/', [VehicleController::class, 'home'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'catalog'])->name('vehicles');
Route::get('/vehicles/{vehicle:slug}', [VehicleController::class, 'show'])->name('vehicle-detail');
Route::get('/about', [VehicleController::class, 'about'])->name('about');
Route::get('/contact', [VehicleController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

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
        Route::delete('vehicle-images/{vehicleImage}', [AdminVehicleController::class, 'deleteImage'])
            ->name('vehicle-images.destroy');

        // Contact messages management
        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Contact settings management
        Route::get('settings/contact', [AdminSettingController::class, 'edit'])->name('settings.contact');
        Route::put('settings/contact', [AdminSettingController::class, 'update'])->name('settings.contact.update');
    });
});

require __DIR__.'/auth.php';
