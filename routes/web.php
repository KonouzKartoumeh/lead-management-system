<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::get('/property_manager/dashboard', function () {
    return view('property_manager.dashboard');
})->middleware(['auth','role:property_manager'])->name('property_manager.dashboard');

Route::resource('/property_manager/schedule', ScheduledClassController::class)
->only(['index', 'create', 'store', 'destroy'])
->middleware(['auth','role:property_manager']);



/* sales_team routes */
Route::middleware(['auth','role:sales_team'])->group(function() {
    Route::get('/sales_team/dashboard', function () {
        return view('sales_team.dashboard');
    })->name('sales_team.dashboard');
    Route::get('/sales_team/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/sales_team/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/sales_team/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::delete('/sales_team/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth','role:admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
