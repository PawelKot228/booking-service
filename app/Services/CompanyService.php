<?php

namespace App\Services;

use App\Enums\EmployeeRole;
use App\Models\Company;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CompanyService
{
    public function listQuery(Builder $query, Request $request): Builder
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        if ($lat !== null && $lng !== null) {
            $coordinatesQuery = "( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) )"
                . "* cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) )";

            $query->select([
                '*',
                DB::raw("ROUND($coordinatesQuery, 2) AS distance"),
            ]);
        }

        $categories = $request->get('categories');
        if (!empty($categories) && is_array($categories)) {
            $categories = implode(', ', array_map(fn($value) => "'$value'", $categories));
            $query->whereRaw("id IN (SELECT company_id FROM company_categories WHERE category IN ($categories))");
        }

        $subcategories = $request->get('subcategories');
        if (!empty($subcategories) && is_array($subcategories)) {
            $subcategories = implode(', ', array_map(fn($value) => "'$value'", $subcategories));
            $query->whereRaw("id IN (SELECT company_id FROM company_categories WHERE subcategory IN ($subcategories))");
        }

        $query->withCount('reviews');
        $query->withAvg('reviews', 'rating');

        $orderBy = $request->get('orderBy');

        if ($orderBy === 'distance' && $lat !== null && $lng !== null) {
            $query->orderBy('distance');
        } elseif ($orderBy === 'best') {
            $query->orderByDesc('reviews_avg_rating');
        } elseif ($orderBy === 'most_reviews') {
            $query->orderByDesc('reviews_count');
        }

        return $query;
    }

    /**
     * @throws \Throwable
     */
    public function save(array $fill, User $user): ?Company
    {
        DB::beginTransaction();
        try {
            $company = $user->ownedCompanies()->create($fill);
            $company->employees()->attach($user->id, ['type' => EmployeeRole::OWNER->value]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return null;
        }

        return $company;
    }

}
