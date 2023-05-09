<?php

namespace App\Services;

use App\Enums\EmployeeRole;
use App\Http\Requests\Company\SearchRequest;
use App\Models\Company;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class CompanyService
{
    public function listQuery(Builder $query, SearchRequest $request): Builder
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
