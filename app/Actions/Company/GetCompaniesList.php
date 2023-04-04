<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use DB;
use Illuminate\Database\Query\JoinClause;

class GetCompaniesList extends Controller
{
    public function __invoke()
    {
        $post = request()->validate([
            'categoryNames' => ['present'],
            'subcategoryNames' => ['present'],
            'lat' => ['present'],
            'lng' => ['present'],
        ]);

        $categoryNames = json_decode(base64_decode($post['categoryNames']));
        $subcategoryNames = json_decode(base64_decode($post['subcategoryNames']));

        $query = Company::with(['categories']);
        $query->select([
            'companies.*',
            DB::raw('AVG(appointments.rating) as appointments_avg_rating')
        ]);

        $query->join(
            'company_categories',
            function (JoinClause $clause) use ($subcategoryNames, $categoryNames) {
                $clause->on('companies.id', '=', 'company_categories.company_id');
                $clause->where(function (JoinClause $query) use ($subcategoryNames, $categoryNames) {
                    if ($categoryNames) {
                        $query->orWhereIn('company_categories.category', $categoryNames);
                    }
                    if ($subcategoryNames) {
                        $query->orWhereIn('company_categories.subcategory', $subcategoryNames);
                    }
                });
            }
        );

        $query->leftJoin('appointments', function (JoinClause $clause) {
            $clause->on('appointments.company_id', '=', 'companies.id');
            $clause->whereDate('appointments.to', '<=', now());
            $clause->whereNotNull('appointments.rating');
        });

        $companies = $query
            ->groupBy('companies.id')
            ->limit(20)
            ->get();

        return CompanyResource::collection($companies);
    }
}
