<?php

namespace App\Http\Controllers;

use App\ENUM\CountryEnum;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['countries' => CountryEnum::listCollection()]);
    }
}
