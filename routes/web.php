<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeepController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

Route::resource('keeps', KeepController::class);

    // Additional routes for import/export
    Route::post('keeps/import', [KeepController::class, 'import'])->name('keeps.import');
    Route::get('keeps/export', [KeepController::class, 'export'])->name('keeps.export');

// Soft delete routes
    Route::get('keeps-trash', [KeepController::class, 'trash'])->name('keeps.trash');
    Route::get('keeps/restore/{id}', [KeepController::class, 'restore'])->name('keeps.restore');
    Route::delete('keeps/force-delete/{id}', [KeepController::class, 'forceDelete'])->name('keeps.forceDelete');