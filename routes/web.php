<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ScientificPaperController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('check', ScientificPaperController::class);

    Route::prefix('check')->name('check.')->controller(ScientificPaperController::class)->group(function () {
        Route::post('/bulk-delete', 'bulkDelete')->name('bulkDelete');
        Route::post('/import', 'import')->name('import');
    });

    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::resource('superadmin', SuperAdminController::class);

    Route::prefix('superadmin')->name('superadmin.')->controller(SuperAdminController::class)->group(function () {
        Route::post('/bulk-delete', 'bulkDelete')->name('bulkDelete');
        Route::post('/import', 'import')->name('import');
        // Route::get('/export', 'exportPDF')->name('exportPDF');
    });
});

require __DIR__ . '/auth.php';
