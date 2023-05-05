<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Controllers\UserCompanyAppointmentController;
use App\Http\Controllers\UserCompanyCategoryController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\UserCompanyEmployeeController;
use App\Http\Controllers\UserCompanyServiceController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');

    Route::prefix('users')
        ->name('users.')
        ->group(function () {
            Route::resource('appointments', UserAppointmentController::class);

            Route::resource('companies', UserCompanyController::class);


            Route::prefix('companies/{company}/')
                ->name('companies.')
                ->group(function () {
                    Route::resource('employees', UserCompanyEmployeeController::class);
                    Route::resource('appointments', UserCompanyAppointmentController::class);
                    Route::resource('categories', UserCompanyCategoryController::class);
                    Route::resource('categories.services', UserCompanyServiceController::class);

                    Route::prefix('appointments/{appointment}/')
                        ->name('appointments.')
                        ->group(function () {
                            Route::patch('/change-status', [UserCompanyAppointmentController::class, 'changeStatus'])
                                ->name('change-status');
                        });
                });
        });
});

Route::prefix('services')
    ->name('services.')
    ->group(function () {
        Route::get('/', [ServiceController::class, 'categories'])->name('categories');
        //Route::get('/category/{categoryName}', [ServiceController::class, 'category'])->name('category');
        Route::get('/search', [ServiceController::class, 'search'])->name('search');
    });

Route::prefix('/companies/{company}/services/{service}/appointments')
    ->name('company.service.appointments.')
    ->group(function () {
        Route::get('/available', [AppointmentController::class, 'availableList'])->name('available-list');
    });


Route::resource('companies', CompanyController::class)
    ->only(['index', 'show']);
Route::resource('companies.reviews', ReviewController::class);
Route::resource('companies.services.appointments', AppointmentController::class);

