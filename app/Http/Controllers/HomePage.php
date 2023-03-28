<?php

namespace App\Http\Controllers;

class HomePage extends Controller
{
    public function __invoke()
    {



        return view('home');
    }
}
