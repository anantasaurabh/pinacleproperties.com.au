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

Route::get('/house-and-land-packages', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/house-and-land-packages/state/{country}', [PropertyController::class, 'index'])->name('properties.state');
Route::get('/house-and-land-packages/state/{country}/{suburb}', [PropertyController::class, 'index'])->name('properties.suburb');
Route::get('/house-and-land-packages/state/{country}/{suburb}/{estate}', [PropertyController::class, 'index'])->name('properties.estate');
Route::get('/house-and-land-packages/{slug}', [PropertyController::class, 'show'])->name('properties.show');

// Backward Compatibility Redirects (301)
Route::redirect('/properties', '/house-and-land-packages', 301);
Route::get('/properties/{slug}', function ($slug) {
    return redirect()->to("/house-and-land-packages/{slug}", 301);
});

Route::get('/refer-a-friend', [PageController::class, 'referAFriend'])->name('refer.index');
Route::post('/refer-a-friend/submit', [PageController::class, 'submitReferral'])->name('refer.submit');

Route::post('/submit-form', [App\Http\Controllers\FormController::class, 'submit'])->name('form.submit');

Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '^(?!admin).*$')->name('page.show');
