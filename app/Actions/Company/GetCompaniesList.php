<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySearchRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetCompaniesList extends Controller
{
    public function __invoke(CompanySearchRequest $request): AnonymousResourceCollection
    {
        $query = Company::with(['categories']);
        $query->select([
            'companies.*',
            DB::raw('AVG(reviews.rating) as reviews_avg_rating')
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

        $companies = $query
            ->groupBy('companies.id')
            ->limit(20)
            ->get();

        return CompanyResource::collection($companies);
    }
}
