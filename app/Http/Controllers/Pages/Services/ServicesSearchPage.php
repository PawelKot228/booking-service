<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;

class ServicesSearchPage extends Controller
{
    public function __invoke()
    {
        return view('pages.services.search');
    }
}
