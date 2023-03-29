<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;

class ServicesPage extends Controller
{
    public function __invoke()
    {
        return view('pages.services.index');
    }
}
