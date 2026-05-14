<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/inquiry', [HomeController::class, 'submitInquiry'])->name('inquiry.submit');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');

Route::get('/refer-a-friend', [PageController::class, 'referAFriend'])->name('refer.index');
Route::post('/refer-a-friend/submit', [PageController::class, 'submitReferral'])->name('refer.submit');

Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '^(?!admin).*$')->name('page.show');
