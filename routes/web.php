<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '^(?!admin).*$')->name('page.show');
