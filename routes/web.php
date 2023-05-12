<?php

namespace App\Http\Controllers;

use Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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
            Route::resource('companies', User\CompanyController::class);
            Route::get('reviews', [User\ReviewController::class, 'index'])->name('reviews.index');

            Route::resource('appointments', User\AppointmentController::class);
            Route::resource('appointments.reviews', User\ReviewController::class)
                ->except('index', 'show');

            Route::prefix('companies/{company}/')
                ->name('companies.')
                ->group(function () {
                    Route::resource('employees', User\Company\EmployeeController::class);
                    Route::resource('appointments', User\Company\AppointmentController::class);
                    Route::resource('categories', User\Company\CategoryController::class);
                    Route::resource('categories.services', User\Company\ServiceController::class);

                    Route::prefix('appointments/{appointment}/')
                        ->name('appointments.')
                        ->group(function () {
                            Route::patch('/change-status', [User\Company\AppointmentController::class, 'changeStatus'])
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

Route::resource('companies', CompanyController::class)
    ->only(['index', 'show']);

Route::prefix('/companies/{company}')
    ->name('companies.')
    ->group(function () {
        Route::resource('reviews', ReviewController::class);

        Route::resource('services.appointments', AppointmentController::class);
        Route::prefix('services/{service}/appointments')
            ->name('services.appointments.')
            ->group(function () {
                Route::get('/available', [AppointmentController::class, 'availableList'])->name('available-list');
            });
    });



