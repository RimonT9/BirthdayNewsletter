<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Guest\GuestResource;
use App\Models\Guest;

class IndexController extends Controller
{
    public function __invoke()
    {
        $guests = Guest::all();
        return GuestResource::collection($guests);
    }
}
