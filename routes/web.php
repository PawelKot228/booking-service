<?php

use App\Http\Controllers\Pages\HomePage;
use App\Http\Controllers\Pages\Services\ServicesCategoryPage;
use App\Http\Controllers\Pages\Services\ServicesPage;
use App\Http\Controllers\Pages\Services\ServicesSearchPage;
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

Route::get('/', HomePage::class)->name('home');

Route::prefix('services')
    ->name('services.')
    ->group(function () {
        Route::get('/', ServicesPage::class)->name('index');
        Route::get('/category/{categoryName}', ServicesCategoryPage::class)->name('category');
        Route::get('/search', ServicesSearchPage::class)->name('search');

    });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
});
