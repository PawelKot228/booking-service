<?php


use App\Models\Company;

if (!function_exists('companyBreadcrumb')) {
    function companyBreadcrumb(Company $company, array $params = []): array
    {
        $route = 'users';
        $currentRoute = \Route::currentRouteName();

        $routeParts = str($currentRoute)
            ->ltrim('users.')
            ->explode('.');
        $lastPart = $routeParts->pop();

        $links = [];
        foreach ($routeParts as $routePart) {
            $route .= ".$routePart";

            if ($routePart === 'companies') {
                $links[$routePart] = route("$route.show", [$company, ...$params]);
            } else {
                $links[$routePart] = route("$route.index", [$company, ...$params]);
            }

        }

        if ($lastPart !== 'index') {
            $links[$lastPart] = route("$route.$lastPart", [$company, ...$params]);
        }

        return $links;
    }
}

if (!function_exists('companyFormattedStreet')) {
    function companyFormattedStreet(Company $company): string
    {
        $streetNumber = $company->street_number;

        if ($company->apartament_number) {
            $streetNumber .= "/$company->apartament_number";
        }

        return "$company->street_name $streetNumber";
    }
}
