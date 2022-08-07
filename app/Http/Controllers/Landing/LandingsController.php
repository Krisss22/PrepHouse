<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

class LandingsController extends Controller
{
    public function show($landingName)
    {
        return $this->view("landings/{$landingName}/index", []);
    }
}
