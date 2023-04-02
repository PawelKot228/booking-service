<?php

namespace App\Http\Controllers;

use App\Enums\ServiceCategory;

class ServiceController extends Controller
{
    public function search()
    {
        return view('pages.services.search');
    }

    public function categories()
    {
        return view('pages.services.index');
    }

    public function category(?string $categoryName)
    {
        $category = ServiceCategory::tryFrom($categoryName);

        abort_if(!$category, 404);

        $subcategories = ServiceCategory::getSubcategories($category);

        return view('pages.services.show-category', compact('category', 'subcategories'));

    }
}
