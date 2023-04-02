<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Pages\Services\ServicesCategoryPage;
use App\Http\Controllers\Pages\Services\ServicesPage;
use App\Http\Controllers\Pages\Services\ServicesSearchPage;
use App\Http\Controllers\ServiceController;
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

Route::get('/', IndexController::class)->name('home');

Route::prefix('services')
    ->name('services.')
    ->group(function () {
        Route::get('/', [ServiceController::class, 'categories'])->name('categories');
        //Route::get('/category/{categoryName}', [ServiceController::class, 'category'])->name('category');
        Route::get('/search', [ServiceController::class, 'search'])->name('search');
    });


Route::resource('companies', CompanyController::class)
    ->except('index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
});
