<?php

namespace App\Http\Controllers\Pages\Services;

use App\Enums\ServiceCategory;
use App\Http\Controllers\Controller;

class ServicesCategoryPage extends Controller
{
    public function __invoke(?string $categoryName)
    {
        $category = ServiceCategory::tryFrom($categoryName);

        abort_if(!$category, 404);

        $subcategories = ServiceCategory::getSubcategories($category);

        return view('pages.services.show-category', compact('category', 'subcategories'));
    }
}
