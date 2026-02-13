<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SpeakerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| هنا تسجل كل Routes الخاصة بتطبيقك.
| جميع الـ Routes الحساسة محمية بـ auth.
|
*/

// الصفحة الرئيسية مفتوحة للجميع
Route::get('/', function () {
    return view('welcome');
});

// Dashboard محمي بـ auth + verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// كل الـ Routes الحساسة محمية بالميدلوير auth
Route::middleware(['auth'])->group(function () {

    // إدارة الأحداث، المتحدثين، المشاركين
    Route::resource('events', EventController::class);
    Route::resource('speakers', SpeakerController::class);
    Route::resource('participants', ParticipantController::class);

    // توليد PDF لأي حدث
    Route::get('events/{event}/pdf', [EventController::class,'generatePdf'])
          ->name('events.pdf');

    // إدارة بروفايل المستخدم
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ملفات Auth الخاصة بـ Breeze
require __DIR__.'/auth.php';