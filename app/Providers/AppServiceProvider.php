<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.default');

        //Enforce morph map in form of model table names
        Relation::enforceMorphMap([
            'users' => User::class,
            'companies' => Company::class,
        ]);
    }
}
