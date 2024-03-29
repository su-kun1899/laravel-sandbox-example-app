<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function show(): string
    {
        return 'Hello';
    }

    public function showId($id): string
    {
        return "Hello $id";
    }

}
