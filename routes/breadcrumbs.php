<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('Home'), '#');
});

Breadcrumbs::resource('companies', __('Company'));
Breadcrumbs::resource('companies.appointments', __('Appointments'));
Breadcrumbs::resource('companies.employees', __('Employees'));
Breadcrumbs::resource('companies.categories', __('Categories'));
Breadcrumbs::resource('companies.categories.services', __('Services'));
