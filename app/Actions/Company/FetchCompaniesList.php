<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySearchRequest;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class FetchCompaniesList extends Controller
{
    public function handle(Builder $query, CompanySearchRequest $request): Builder
    {
        $query->select([
            'companies.*',
            DB::raw('AVG(reviews.rating) as reviews_avg_rating'),
            DB::raw('COUNT(reviews.rating) as reviews_count'),
        ]);

        $query->join(
            'company_categories',
            function (JoinClause $clause) use ($request) {
                $clause->on('companies.id', '=', 'company_categories.company_id');
                $clause->where(function (JoinClause $query) use ($request) {
                    if ($request->categoryNames) {
                        $query->orWhereIn('company_categories.category', $request->categoryNames);
                    }
                    if ($request->subcategoryNames) {
                        $query->orWhereIn('company_categories.subcategory', $request->subcategoryNames);
                    }
                });
            }
        );


        $query->leftJoin('reviews', function (JoinClause $clause) {
            $clause->on('reviews.company_id', '=', 'companies.id');
        });

        return $query
            ->groupBy('companies.id')
            ->limit(20);
    }
}
