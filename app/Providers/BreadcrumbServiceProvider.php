<?php

namespace App\Providers;

use App\Models\Appointment;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        Breadcrumbs::macro('renderCompany', function (Model ...$models) {
            $name = (string)str(\Route::currentRouteName())->ltrim('users.');

            return Breadcrumbs::render($name, ...$models);
        });

        Breadcrumbs::macro('resource', function (string $name, string $title) {
            Breadcrumbs::for("$name.index", function (BreadcrumbTrail $trail, Model ...$models) use ($name, $title) {
                $nameParts = str($name)->explode('.');

                if ($nameParts->count() > 1) {
                    $nameParts->pop();
                    $parentName = $nameParts->implode('.') . '.show';
                    $trail->parent($parentName, ...$models);
                }

                $trail->push($title, route("users.$name.index", [...$models]));
            });

            Breadcrumbs::for("$name.create", function (BreadcrumbTrail $trail, Model ...$models) use ($name) {
                $trail->parent("$name.index", ...$models);
                $trail->push(__('New'), route("users.$name.create", [...$models]));
            });

            Breadcrumbs::for("$name.show", function (BreadcrumbTrail $trail, Model $model, Model ...$models) use ($name) {
                if ($name !== 'companies') {
                    $trail->parent("$name.index", ...$models);
                }

                $title = $model->name;
                if ($model instanceof Appointment) {
                    $title = $model->customer->name;
                }

                $trail->push($title, route("users.$name.show", [...$models, $model]));
            });

            Breadcrumbs::for("$name.edit", function (BreadcrumbTrail $trail, Model $model, Model ...$models) use ($name) {
                $trail->parent("$name.show", $model, ...$models);
                $trail->push(__('Edit'), route("users.$name.edit", [...$models, $model]));
            });
        });

    }
}
